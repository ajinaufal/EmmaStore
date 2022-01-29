<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Products;
use App\Models\ProductVarian;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id){
        /*** must have in every page ***/
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        /*** end of must have in every page ***/
        
        $data['product'] =  DB::table('products')->leftJoin('product_varian', 'products.id', '=', 'product_varian.product_id')->select('products.*','product_varian.varian_id')->where('products.id', '=', $id)->get()->toArray();
        if(!empty($data['product'][0]->varian_id))
        {
            $data['product_varian'] =  DB::table('product_varian')->where('product_id', '=', $data['product'][0]->id)->get()->toArray();
            foreach($data['product_varian'] as $var) {
                if(empty($data['product'][0]->min_price) && empty($data['product'][0]->max_price))
                {
                    $data['product'][0]->min_price = $var->harga;
                    $data['product'][0]->max_price = $var->harga;
                }
                if($var->onsale > 0)
                {
                    if($var->onsale > $data['product'][0]->max_price) $data['product'][0]->max_price = $var->onsale;
                    if($var->onsale < $data['product'][0]->min_price) $data['product'][0]->min_price = $var->onsale;
                }
                else
                {
                    if($var->harga > $data['product'][0]->max_price) $data['product'][0]->max_price = $var->harga;
                    if($var->harga < $data['product'][0]->min_price) $data['product'][0]->min_price = $var->harga;
                }
            }
        }
    	return view('detail')->with($data);
    }
    
    public function quickview($id){
    
        $data['product'] =  DB::table('products')->leftJoin('product_varian', 'products.id', '=', 'product_varian.product_id')->select('products.*','product_varian.varian_id')->where('products.id', '=', $id)->get()->toArray();
        if(!empty($data['product'][0]->varian_id))
        {
            $data['product_varian'] =  DB::table('product_varian')->where('product_id', '=', $data['product'][0]->id)->get()->toArray();
            foreach($data['product_varian'] as $var) {
                if(empty($data['product'][0]->min_price) && empty($data['product'][0]->max_price))
                {
                    $data['product'][0]->min_price = $var->harga;
                    $data['product'][0]->max_price = $var->harga;
                }
                if($var->onsale > 0)
                {
                    if($var->onsale > $data['product'][0]->max_price) $data['product'][0]->max_price = $var->onsale;
                    if($var->onsale < $data['product'][0]->min_price) $data['product'][0]->min_price = $var->onsale;
                }
                else
                {
                    if($var->harga > $data['product'][0]->max_price) $data['product'][0]->max_price = $var->harga;
                    if($var->harga < $data['product'][0]->min_price) $data['product'][0]->min_price = $var->harga;
                }
            }
        }
        echo json_encode($data);
    }
    
    public function etalase($name, $page){
        /*** must have in every page ***/
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        /*** end of must have in every page ***/
        
        $data['total_products'] =  DB::table('products')->where('products.etalase', '=', $name)->get()->count();

        $limit = 24;
        $data['products'] =  DB::table('products')->where('products.etalase', '=', $name)->limit($limit)->offset(($page - 1) * $limit)->get()->toArray();
        
        $data['total_pages'] = ceil($data['total_products']/24);
        
        if($page == $data['total_pages'])
            $data['last_offset'] = $data['total_products'];
        else
            $data['last_offset'] = (($page - 1) * $limit) + $limit;
            
        $data['first_offset'] = (($page - 1) * $limit) + 1;
        
        $data['etalase_name'] = $name;
        
        $data['cur_page'] = $page;
        
        return view('etalase')->with($data);
    }
}
