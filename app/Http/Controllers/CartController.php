<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\product_varian;
use App\Models\Products;
use App\Models\ProductVarian;
use App\Models\tiki;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function store(Request $request)
    {
        $variant_color = $request->id_variant_color;
        $variant_size = $request->id_variant_size;
        $product = Products::where('id', $request->id_productt)->first();
        $cart = cart::where([
            ['products_id', $request->id_product],
            ['user_id', $request->id_user],
            ['variant_size', $variant_size],
            ['variant_color', $variant_color],
        ])->get();

        if ($cart->count() == 0) {
            if ($request->total != 0) {
                $data = cart::create([
                    'user_id' => $request->id_user,
                    'products_id' => $request->id_product,
                    'variant_size' => $variant_size,
                    'variant_color' => $variant_color,
                    'total' => $request->total,
                ]);
            }
        } elseif ($cart->count() != 0) {
            $data = $cart->first()->update([
                'total' => $cart->first()->total + $request->total,
            ]);
        }

        $total = cart::where('user_id', $request->id_user)->count();

        return response()->json([
            'request' => $request->all(),
            'total' => $total,
            'message' => 'successful'
        ], 200);
    }
    
    public function readTotalCart(Request $request)
    {
        $total = cart::where('user_id', $request->user_id)->count();
        return response()->json([
            'total' => $total,
            'message' => 'successful'
        ], 200);
    }

    public function read()
    {
        $user = auth()->user()->id;
        $cart = cart::where('user_id', $user)->get();
        foreach ($cart as $key => $value) {
            $product = Products::where('id', $value->products_id)->first();
            $data[$key] = [
                'id_cart' => $value->id,
                'product_id' => $value->products_id,
                'name_produk' => $product->nama,
                'harga' => $product->harga,
                'berat' => $product->berat,
                'onsale' => $product->onsale,
                'gambar' => $product->gambar1,
                'jumlah' => $value->total,
                'user_id' => $user,
                'stock' => $product->stok,
                'variant_size' => ProductVarian::where('id', $value->variant_size)->first(),
                'variant_color' => ProductVarian::where('id', $value->variant_color)->first(),
            ];
            $harga[$key] = $value->total * $product->harga;
        }
        return view('modal.cart-modal', [
            'data' => $data,
            'harga' => array_sum($harga),
            'tax' => array_sum($harga) * (5 / 100),
            'total' => array_sum($harga) + (array_sum($harga) * (5 / 100)),
            'variant' => ProductVarian::all(),
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user_id;
        $cart = cart::where([['user_id', $user], ['id', $request->cart_id]])->first();
        $products = Products::where('id', $cart->products_id)->first();
        if ($request->code == "-") {
            $cart->update([
                'total' => $cart->total - 1
            ]);
            if ($cart->total == 0) {
                $cart->delete();
            }
        } elseif ($request->code == "+" && $cart->total < $products->stok) {
            $cart->update([
                'total' => $cart->total + 1
            ]);
        }

        $cart = cart::where('user_id', $user)->get();
        foreach ($cart as $key => $value) {
            $product = Products::where('id', $value->products_id)->first();
            $data[$key] = [
                'id_cart' => $value->id,
                'product_id' => $value->products_id,
                'name_produk' => $product->nama,
                'harga' => $product->harga,
                'berat' => $product->berat,
                'onsale' => $product->onsale,
                'gambar' => $product->gambar1,
                'jumlah' => $value->total,
                'user_id' => $user,
                'stock' => $product->stok,
                'variant_size' => ProductVarian::where('id', $value->variant_size)->first(),
                'variant_color' => ProductVarian::where('id', $value->variant_color)->first(),
            ];
            $harga[$key] = $value->total * $product->harga;
        }

        return view('modal.cart-modal', [
            'data' => $data,
            'harga' => array_sum($harga),
            'tax' => array_sum($harga) * (5 / 100),
            'total' => array_sum($harga) + (array_sum($harga) * (5 / 100)),
            'variant' => ProductVarian::all(),
        ]);
    }

    public function delet(Request $request)
    {
        $delete = cart::find($request->id_item);
        $delete->delete();

        $user = $request->user_id;

        $cart = cart::where('user_id', $user)->get();
        $data = [];
        $product = [];
        $harga = [];
        foreach ($cart as $key => $value) {
            $product = Products::where('id', $value->products_id)->first();
            $data[$key] = [
                'id_cart' => $value->id,
                'product_id' => $value->products_id,
                'name_produk' => $product->nama,
                'harga' => $product->harga,
                'berat' => $product->berat,
                'onsale' => $product->onsale,
                'gambar' => $product->gambar1,
                'jumlah' => $value->total,
                'user_id' => $user,
                'stock' => $product->stok,
            ];
            $harga[$key] = $value->total * $product->harga;
        }

        return view('modal.cart-modal', [
            'data' => $data,
            'harga' => array_sum($harga),
            'tax' => array_sum($harga) * (5 / 100),
            'total' => array_sum($harga) + (array_sum($harga) * (5 / 100)),
            'variant' => ProductVarian::all(),
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        $filterResult = tiki::where('nama_kota', 'LIKE', '%' . $query . '%')->get();
        foreach ($filterResult as $key => $value) {
            $data[$key] = $value->nama_kota;
            $reg_rate[$key] = $value->reg_rate;
            $reg_est[$key] = $value->reg_est;
            $ons_rate[$key] = $value->ons_rate;
            $ons_est[$key] = $value->ons_est;
        }
        return response()->json($data);
    }

    // public function data_kota(Request $request)
    // {
    //     $cart = cart::where('user_id', auth()->user()->id)->get();

    //     $nama_kota = tiki::where('nama_kota', $request->nama_kota)->first();
    //     $tiki = [
    //         'tiki_id' => $nama_kota->tiki_id,
    //         'kode_kota' => $nama_kota->kode_kota,
    //         'nama_kota' => $nama_kota->nama_kota,
    //         'reg_rate' => $nama_kota->reg_rate,
    //         'reg_est' => $nama_kota->reg_est,
    //         'ons_rate' => $nama_kota->ons_rate,
    //         'ons_est' => $nama_kota->ons_est,
    //     ];

    //     foreach ($cart as $key => $value) {
    //         $product = Products::where('id', $value->products_id)->first();
    //         $data[$key] = [
    //             'id_cart' => $value->id,
    //             'name_produk' => $product->nama,
    //             'harga' => $product->harga,
    //             'berat' => $product->berat,
    //             'onsale' => $product->onsale,
    //             'gambar' => $product->gambar1,
    //             'jumlah' => $value->total,
    //             'user_id' => $value->products_id,
    //             'stock' => $product->stok,
    //         ];
    //         $harga[$key] = $value->total * $product->harga;
    //         $berat[$key] = $product->berat;
    //     }

    //     return response([$tiki, $data, array_sum($harga), $berat]);
    // }

    public function get_data(Request $request)
    {
        $cart = cart::where('user_id', auth()->user()->id)->get();
        foreach ($cart as $key => $value) {
            $product = Products::where('id', $value->products_id)->first();
            $harga[$key] = $value->total * $product->harga;
        }
        $data_kota = tiki::where('nama_kota', $request->kota)->first();
        return response()->json([$data_kota, array_sum($harga), $product, $cart]);
    }

    public function get_item(Request $request)
    {
        $item = Products::where('id', $request->id_product)->first();
        $variant = ProductVarian::where('product_id', $request->id_product)->get();
        $cart = cart::where([['user_id', auth()->user()->id], ['products_id', $request->id_product]])->first();
        return view('modal.edit-product', [
            'product' => $item,
            'variant' => $variant,
            'cart' => $cart,
        ]);
    }

    public function update_variant(Request $request)
    {
        $cart = cart::where([['products_id', $request->id], ['user_id', auth()->user()->id]])->firstOrFail();
        $update = $cart->update([
            'variant_size' => $request->size,
            'variant_color' => $request->color,
        ]);

        return response()->json([
            'message' => 'successful',
        ], 200);
    }

    public function HomeCart(Request $request)
    {
        $product = Products::where('id', $request->id_product)->first();
        $variant = ProductVarian::where('product_id', $request->id_product)->get();

        return view('modal.add-cart-modal', [
            'product' => $product,
            'variant' => $variant,
        ]);
    }
}
