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
        $request->validate([
            'payment_group' => 'required',
            'NamaDepan' => 'required',
            'NamaBelakang' => 'required',
            'Email' => 'required',
            'Telephone' => 'required',
            'Alamat' => 'required',
            'KodePos' => 'required',
            'total_harga_barang' => 'required',
            'biaya_kirim' => 'required', #
            'total_berat_barang' => 'required',
            'total_bayar' => 'required',
        ]);

        // dd($request->all());
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

        $create_payment_transaction = online_payment_transaction::create([
            'transaction_no' => $trans_no,
            'metode_pembayaran' => $request->payment_group,
            'firstname' => auth()->user()->firstname,
            'lastname' => auth()->user()->lastname,
            'email' => auth()->user()->email,
            'hp' => auth()->user()->telephone,
            'address' => auth()->user()->address,
            'postal_code' => auth()->user()->postal_code,
            'recipient_firstname' => $request->NamaDepan,
            'recipient_lastname' => $request->NamaBelakang,
            'recipient_hp' => $request->Telephone,
            'recipient_address' => $request->Alamat,
            'recipient_postal_code' => $request->KodePos,
            'layanan' => $layanan,
            'weight' => $request->total_berat_barang,
            'delivery_charges' => $request->biaya_kirim * $request->total_berat_barang,
            'administration_fee' => 0,
            'price' => $request->total_bayar,
            'checkout_date' => Carbon::now()->format('Y-m-d H:i:s'),
            'counter' => 0,
        ]);

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

            $data_email = [
                'email' => $request->Email,
                'name'  => $request->NamaDepan . " " . $request->NamaBelakang,
                'item_order'  => $data,
                'payment_transaction' => $create_payment_transaction,
                'payment_items' => $create_payment_items,
                'kota' => $request->Kota,
                'biaya_kirim' => $request->biaya_kirim,
                'total_harga_barang' => $request->total_harga_barang,
                'harga_total' => $harga,
                'berat_total' => $berat,
            ];

            Mail::to([$request->Email /*, 'emma.darmawan1@gmail.com'*/])->send(new CheckoutEmail($data_email));

            return redirect('/');
        }
    }
}
