<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Products;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index(){
        $data['etalase'] =  DB::table('products')->select('products.etalase')->groupBy('etalase')->orderBy('etalase')->get();
    	return view('faqs')->with($data);
    }
}
