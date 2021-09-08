<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class CartProduct extends Controller
{
	public function Cart()
	{
		$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')
      ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
      ->get();
        return view('cart')->with('cate',$cate)->with('brand',$brand)->with('cate_data_id',$result);
	}
	
    
}
