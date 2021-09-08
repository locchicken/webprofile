<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
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
      public function add_category_product()
   	{
         $this->checklogin();
   		return view('admin.add_category_product');
   	}
   	public function data_category_product()
   	{
         $this->checklogin();
   		$showdata=DB::table('tbl_category_product')->get();//lấy dữ liệu từ table
   		$manager=view('admin.data_category_product')->with('showdata',$showdata);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.data_category_product',$manager);//trang index chứa luôn data mỗi khi load
   	}
   	public function saveData(Request $request)
   	{
   		$data=array();
   		$data['category_name']=$request->product_name;
   		$data['category_desc']=$request->product_desc;
   		$data['category_status']=$request->status;
   		$result=DB::table('tbl_category_product')->insert($data);
   		if($result)
   		{
   			Session(['message'=>'Thêm danh mục sản phẩm thành công']);
    		return Redirect::to('/add-category-product');
   		}
   	}
   	public function show($id)
   	{
         $this->checklogin();
   		DB::table('tbl_category_product')->where('category_id',$id)->update(['category_status'=>0]);
   		$showdata=DB::table('tbl_category_product')->get();//lấy dữ liệu từ table
   		$manager=view('admin.data_category_product')->with('showdata',$showdata);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.data_category_product',$manager);//trang
   	}
   	public function hide($id)
   	{
         $this->checklogin();
   		DB::table('tbl_category_product')->where('category_id',$id)->update(['category_status'=>1]);
   		$showdata=DB::table('tbl_category_product')->get();//lấy dữ liệu từ table
   		$manager=view('admin.data_category_product')->with('showdata',$showdata);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.data_category_product',$manager);//trang
   	}
   	public function show_update($id)
   	{
   		$update=DB::table('tbl_category_product')->where('category_id',$id)->get();
   		$manager=view('admin.update_category_product')->with('show_update',$update);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.update_category_product',$manager);//trang index chứa luôn data mỗi khi load
   	}
   	public function update(Request $request,$id)
   	{
         $this->checklogin();
   		$data=array();
   		$data['category_name']=$request->product_name;
   		$data['category_desc']=$request->product_desc;
   		$result=DB::table('tbl_category_product')->where('category_id',$id)->update($data);
   		if($result)
   		{
   			Session(['message'=>'Cập nhập danh mục sản phẩm thành công']);
    		return Redirect::to('/data-category-product');
   		}
   	}
   	public function delete($id)
   	{
         $this->checklogin();
   		$result=DB::table('tbl_category_product')->where('category_id',$id)->delete();
   		if($result)
   		{
   			Session(['message'=>'Xóa danh mục sản phẩm thành công']);
    		return Redirect::to('/data-category-product');
   		}
   	}
    public function category_home($id)
    {
        $cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')
      ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
      ->where('tbl_product.category_id',$id)->get();
        return view('pages.category')->with('cate_data',$cate)->with('brand_data',$brand)->with('cate_data_id',$result);
    }
}
