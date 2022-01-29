<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Products;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getCity($keyword){
        $kota = DB::table('tiki')->where('nama_kota', 'like', '%'.$keyword.'%')->get()->toArray();
        $citylist = json_decode(json_encode($kota), true);
        if(!empty($citylist))
        {
            $data=array();
            $i=0;
            foreach($citylist as $kt)
            {
                $data[$i] = $kt['nama_kota'];
	            $i++;
            }
        }
        echo json_encode($data);
    }
}
