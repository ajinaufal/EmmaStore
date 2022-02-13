<?php

namespace App\Http\Controllers;

use App\Mail\CheckoutEmail;
use App\Models\cart;
use App\Models\online_payment_items;
use App\Models\online_payment_transaction;
use App\Models\Products;
use App\Models\ProductVarian;
use App\Models\tiki;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function index()
    {
        /*** must have in every page ***/
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        /*** end of must have in every page ***/

        $user = auth()->user()->id;
        $cart = cart::where('user_id', $user)->get();
        $data_cart = [];
        $harga = [];
        $berat = [];
        foreach ($cart as $key => $value) {
            $product = Products::where('id', $value->products_id)->first();
            $variant_size = ProductVarian::where('id', $value->variant_size);
            $variant_color = ProductVarian::where('id', $value->variant_color);
            if ($variant_size->count() != 0) {
                $variant_size = $variant_size->first()->nama;
            } else {
                $variant_size = null;
            }
            if ($variant_color->count() != 0) {
                $variant_color = $variant_color->first()->nama;
            } else {
                $variant_color = null;
            }
            $data_cart[$key] = [
                'id_cart' => $value->id,
                'name_produk' => $product->nama,
                'harga' => $product->harga,
                'berat' => $product->berat,
                'onsale' => $product->onsale,
                'gambar' => $product->gambar1,
                'jumlah' => $value->total,
                'user_id' => $value->user_id,
                'stock' => $product->stok,
                'variant_size' => $variant_size,
                'variant_color' => $variant_color,
            ];
            $harga[$key] = $value->total * $product->harga;
            $berat[$key] = $value->total * $product->berat;
        }

        if (auth()->user()->kota) {
            $pengiriman = tiki::where('nama_kota', 'LIKE', '%' . auth()->user()->kota . '%')->first();
        } else {
            $pengiriman = null;
        }

        return view('checkout', [
            'user_id' => $user,
            'data_cart' => $data_cart,
            'harga' => array_sum($harga),
            'tax' => array_sum($harga) * (5 / 100),
            'total' => array_sum($harga) + (array_sum($harga) * (5 / 100)),
            'total_berat' => array_sum($berat),
            'pengiriman' => $pengiriman,
            'variant' => ProductVarian::all(),
        ])->with($data);
    }

    public function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos   = array_keys($words);
            $text  = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    public function checkout(Request $request)
    {
        // For test input if failed
        // dd([$request->all(), 
        //     $request->payment_group,
        //     $request->NamaDepanPemesan,
        //     $request->NamaBelakangPemesan,
        //     $request->EmailPemesan,
        //     $request->TelephonePemesan,
        //     $request->AlamatPemesan,
        //     $request->KodePosPemesan,
        //     $request->KotaPemesan,
        //     $request->shipping,
        //     $request->tujuan_pengiriman,
        //     $request->NamaDepanPenerima,
        //     $request->NamaBelakangPenerima,
        //     $request->TelephonePenerima,
        //     $request->AlamatPenerima,
        //     $request->KodePosPenerima,
        //     $request->KotaPenerima,
        //     $request->total_bayar,
        //     $request->total_berat_barang,
        // ]);

        $rules = [
            'payment_group' => 'required',
            'NamaDepanPemesan' => 'required',
            'NamaBelakangPemesan' => 'required',
            'EmailPemesan' => 'required',
            'TelephonePemesan' => 'required',
            'AlamatPemesan' => 'required',
            'KodePosPemesan' => 'required',
            'KotaPemesan' => 'required',
            'shipping' => 'required',
        ];
    
        $customMessages = [
            'payment_group.required' => 'Pemilihan Payment Kosong, pastikan anda mengisi form checkout dengan benar!',
            'NamaDepanPemesan.required' => 'Nama depan pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'NamaBelakangPemesan.required' => 'Nama belakang pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'EmailPemesan.required' => 'Email pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'TelephonePemesan.required' => 'Telephone pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'AlamatPemesan.required' => 'Alamat pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'KodePosPemesan.required' => 'Kode pos pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'KotaPemesan.required' => 'Kota pemesan kosong, pastikan anda mengisi form checkout dengan benar!',
            'shippingg.required' => 'Pemilihan Layanan pengiriman kosong, pastikan anda mengisi form checkout dengan benar!',
        ];

        $this->validate($request, $rules, $customMessages);

        if (online_payment_transaction::latest('online_payment_transaction_id')->get()->count() != 0) {
            $trans_no = online_payment_transaction::latest('online_payment_transaction_id')->first()->online_payment_transaction_id + 1;
        } else {
            $trans_no = 1;
        }

        if ($request->has('shipping')) {
            $layanan = $request->shipping;
        } elseif ($request->has('shippingg')) {
            $layanan = $request->shippingg;
        }

        if ($trans_no < 10)
            $trans_no = "000";
        elseif ($trans_no < 100)
            $trans_no = "00" . $trans_no;
        elseif ($trans_no < 1000)
            $trans_no = "0" . $trans_no;
        if ($request->tujuan_pengiriman == 0) {
            $create_payment_transaction = online_payment_transaction::create([
                'transaction_no' => $trans_no,
                'metode_pembayaran' => $request->payment_group,
                'firstname' => $request->NamaDepanPemesan,
                'lastname' => $request->NamaBelakangPemesan,
                'email' => $request->EmailPemesan,
                'hp' => $request->TelephonePemesan,
                'address' => $request->AlamatPemesan,
                'postal_code' => $request->KodePosPemesan,
                'recipient_firstname' => $request->NamaDepanPemesan,
                'recipient_lastname' => $request->NamaBelakangPemesan,
                'recipient_hp' => $request->TelephonePemesan,
                'recipient_address' => $request->AlamatPemesan,
                'recipient_postal_code' => $request->KodePosPemesan,
                'layanan' => $layanan,
                'weight' => $request->total_berat_barang,
                'delivery_charges' => $request->biaya_kirim * $request->total_berat_barang,
                'administration_fee' => 0,
                'price' => $request->total_bayar,
                'checkout_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'counter' => $request->tujuan_pengiriman,
            ]);
        } elseif ($request->tujuan_pengiriman == 1) {
            $create_payment_transaction = online_payment_transaction::create([
                'transaction_no' => $trans_no,
                'metode_pembayaran' => $request->payment_group,
                'firstname' => $request->NamaDepanPemesan,
                'lastname' => $request->NamaBelakangPemesan,
                'email' => $request->EmailPemesan,
                'hp' => $request->TelephonePemesan,
                'address' => $request->AlamatPemesan,
                'postal_code' => $request->KodePosPemesan,
                'recipient_firstname' => $request->NamaDepanPenerima,
                'recipient_lastname' => $request->NamaBelakangPenerima,
                'recipient_hp' => $request->TelephonePenerima,
                'recipient_address' => $request->AlamatPenerima,
                'recipient_postal_code' => $request->KodePosPenerima,
                'layanan' => $layanan,
                'weight' => $request->total_berat_barang,
                'delivery_charges' => $request->biaya_kirim * $request->total_berat_barang,
                'administration_fee' => 0,
                'price' => $request->total_bayar,
                'checkout_date' => Carbon::now()->format('Y-m-d H:i:s'),
                'counter' => $request->tujuan_pengiriman,
            ]);
        }
        
        

        $cart = cart::where('user_id', auth()->user()->id)->get();

        if ($cart) {
            foreach ($cart as $key => $value) {
                $variant_size = ProductVarian::where('id', $value->variant_size);
                $variant_color = ProductVarian::where('id', $value->variant_color);

                if ($variant_size->count() != 0) {
                    $variant_size = $variant_size->first()->nama;
                } else {
                    $variant_size = null;
                }

                if ($variant_color->count() != 0) {
                    $variant_color = $variant_color->first()->nama;
                } else {
                    $variant_color = null;
                }

                $stok = Products::where('id', $value->products_id)->first();

                if ($stok->count() != 0) {
                    $create_payment_items = online_payment_items::create([
                        'online_payment_transaction_id' => $create_payment_transaction->id,
                        'product_id' => $value->products_id,
                        'variant_size' => $value->variant_size,
                        'variant_color' => $value->variant_color,
                        'qty' => $value->total,
                        'price' => $stok->harga,
                    ]);

                    $data[$key] = [
                        'id_cart' => $value->id,
                        'name_produk' => $stok->nama,
                        'harga' => $stok->harga,
                        'berat' => $stok->berat,
                        'onsale' => $stok->onsale,
                        'gambar' => $stok->gambar1,
                        'jumlah' => $value->total,
                        'user_id' => $value->products_id,
                        'stock' => $stok->stok,
                        'variant_size' => $variant_size,
                        'variant_color' => $variant_color,
                    ];

                    $harga[$key] = $value->total * $stok->harga;
                    $berat[$key] = $stok->berat;

                    $hapus_stok = $stok->update([
                        'stok' => $stok->stok - $value->total,
                    ]);

                    $hapus_cart = cart::find($value->id);
                    $hapus_cart->delete();
                }
            }

            if ($request->tujuan_pengiriman == 0) {
                $kota = $request->KotaPemesan;
            } elseif ($request->tujuan_pengiriman == 1) {
                $kota = $request->KotaPenerima;
            }

            $data_email = [
                'email' => $request->EmailPemesan,
                'name'  => $request->NamaDepanPemesan . " " . $request->NamaBelakangPemesan,
                'item_order'  => $data,
                'payment_transaction' => $create_payment_transaction,
                'payment_items' => $create_payment_items,
                'kota' => $kota,
                'biaya_kirim' => $request->biaya_kirim,
                'total_harga_barang' => $request->total_harga_barang,
                'harga_total' => $harga,
                'berat_total' => $berat,
            ];
            
            Mail::to([$request->EmailPemesan, 'emma.darmawan1@gmail.com'])->send(new CheckoutEmail($data_email));
            
            return redirect('/');
        }
    }
}
