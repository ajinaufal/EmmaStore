<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        /*** must have in every page ***/
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
        /*** end of must have in every page ***/
        
        $slide_dir = glob( public_path().'/assets/slideshow/*.*' );
        
        array_multisort(
                $slide_dir,
                SORT_ASC
        );

        $slideImage = array();
        if(!empty($slide_dir)) {
            $k=0;
			foreach($slide_dir as $filename) {
		        if($filename != "." && $filename != ".." && $filename != "thumbs.db" && $filename != "Thumbs.db")
				{
                    $slideImage[$k] = str_replace(public_path(),"", $filename);
                    $k++;
				}
			}
        }
        $data['slide_image'] = $slideImage;
        
        
        $data['onsale'] = DB::table('products')->select('id', 'nama', 'harga', 'etalase', 'onsale', 'gambar1')->where('onsale', '>', 0)->where('status', '=', '1')->get()->toArray();
        if(count((array)$data['onsale'])> 5) $data['total_column_onsale'] = 5;
        else $data['total_column_onsale'] = count((array)$data['onsale']);
        $data['total_row_onsale'] = ceil(count((array)$data['onsale'])/5);
        $data['newstuff'] = DB::table('products')->select('id', 'nama', 'harga', 'etalase', 'onsale', 'gambar1')->where('newstuff', '=', '1')->where('status', '=', '1')->get()->toArray();
        if(count((array)$data['newstuff'])> 5) $data['total_column_newstuff'] = 5;
        else $data['total_column_newstuff'] = count((array)$data['newstuff']);
        $data['total_row_newstuff'] = ceil(count((array)$data['newstuff'])/5);
        
        foreach($data['etalase'] as $etalase) {
            $curEtalase = DB::table('products')->select('products.id', 'products.nama', 'products.harga', 'products.etalase', 'products.onsale', 'products.gambar1')->where('products.status', '=', '1')->where('products.etalase', '=', $etalase->etalase)->limit(5)->get()->toArray();
            foreach($curEtalase as &$prod) {
                if(empty($prod->harga))
                {
                    $product_varian =  DB::table('product_varian')->where('product_id', '=', $prod->id)->get()->toArray();
                    foreach($product_varian as $var) {
                        if(empty($prod->min_price) && empty($prod->max_price))
                        {
                            $prod->min_price = $var->harga;
                            $prod->max_price = $var->harga;
                        }
                        if($var->onsale > 0)
                        {
                            if($var->onsale > $prod->max_price) $prod->max_price = $var->onsale;
                            if($var->onsale < $prod->min_price) $prod->min_price = $var->onsale;
                        }
                        else
                        {
                            if($var->harga > $prod->max_price) $prod->max_price = $var->harga;
                            if($var->harga < $prod->min_price) $prod->min_price = $var->harga;
                        }
                    }
                }
            }
            $top_5_etalase[$etalase->etalase] = $curEtalase;
        }
        $data['top_5_etalase'] = $top_5_etalase;
    	return view('home')->with($data);
    }

}
