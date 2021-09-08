<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class Product extends Controller
{
	public function checklogin()
    {
           $admin=Session('admin_id');
           if($admin)
           {
               return Redirect::to('admin.dashboard');
           }
           else{
               return Redirect::to('dang-nhap')->send();
           }
    }
    public function add_product()
    {
    	$this->checklogin();
    	$cate=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$brand=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
    	return view('admin.add_product')->with('cate_product',$cate)->with('brand_product',$brand);
    }
    public function saveData(Request $request)
    {
    	$this->checklogin();
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$getimage=$request->file('product_image');
    	$data['product_price']=$request->product_price;
    	$data['category_id']=$request->cate;
    	$data['brand_id']=$request->brand;
    	$data['product_desc']=$request->product_desc;
    	$data['product_status']=$request->status;
    	$data['product_content']=$request->product_content;
    	if($getimage)
    	{
    		$getnameImage=$getimage->getClientOriginalName();//lấy cái name của hình
    		$nameImage=current(explode('.', $getnameImage));
    		$image=$nameImage.rand(0,99).'.'.$getimage->getClientOriginalExtension();
    		$getimage->move('public/upload/product',$image);
    		$data['product_image']=$image;
    		$result=DB::table('tbl_product')->insert($data);
    		if($result)
    		{
    			Session(['message'=>'Thêm sản phẩm thành công']);
    			return Redirect::to('/add-product');
    		}
    	}
    	$data['product_image']='';
    	DB::table('tbl_product')->insert($data);
    	Session(['message'=>'Thêm sản phẩm thành công']);
    	return Redirect::to('/add-product');
    }
    public function data_product()
    {
    	$this->checklogin();
    	$result=DB::table('tbl_product')
    	->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
    	->orderby('tbl_product.product_id','desc')->get();
    	$data=view('admin.data_product')->with('data_product',$result);
    	return view('adminIndex')->with('admin.date_product',$data);
    }
    public function show_product($id)
    {
    	$this->checklogin();
    	DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>0]);
    	return Redirect::to('/data-product');
    }
    public function hide_product($id)
    {
    	DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>1]);
    	return Redirect::to('/data-product');
    }
    public function delete_product($id)
   	{
   		$this->checklogin();
   		$result=DB::table('tbl_product')->where('product_id',$id)->delete();
   		if($result)
   		{
   			Session(['message'=>'Xóa sản phẩm thành công']);
    		return Redirect::to('/data-product');
   		}
   	}
   	public function show_update($id)
   	{
   		$this->checklogin();
   		$cate=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$brand=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
   		$update=DB::table('tbl_product')->where('product_id',$id)->get();
   		$manager=view('admin.update_product')->with('show_update',$update)->with('cate_product',$cate)->with('brand_product',$brand);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.update_product',$manager);//trang index chứa luôn data mỗi khi load
   	}
   	public function update_data(Request $request,$id)
   	{
   		$this->checklogin();
   		$data=array();
    	$data['product_name']=$request->product_name;
    	$getimage=$request->file('product_image');
    	$data['product_price']=$request->product_price;
    	$data['category_id']=$request->cate;
    	$data['brand_id']=$request->brand;
    	$data['product_desc']=$request->product_desc;
    	$data['product_content']=$request->product_content;
    	if($getimage)
    	{
    		$getnameImage=$getimage->getClientOriginalName();//lấy cái name của hình
    		$nameImage=current(explode('.', $getnameImage));
    		$image=$nameImage.rand(0,99).'.'.$getimage->getClientOriginalExtension();
    		$getimage->move('public/upload/product',$image);
    		$data['product_image']=$image;
    		$result=DB::table('tbl_product')->where('product_id',$id)->update($data);
    		if($result)
    		{
    			Session(['message'=>'Cập nhập sản phẩm thành công']);
    			return Redirect::to('/data-product');
    		}
    	}
    	DB::table('tbl_product')->where('product_id',$id)->update($data);
        Session(['message'=>'Cập nhập sản phẩm thành công']);
        return Redirect::to('/data-product');
   	}
}
