<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
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
    public function add_brand()
   	{
         $this->checklogin();
   		return view('admin.add_brand');
   	}
   	public function data_brand()
   	{
         $this->checklogin();
   		$showdata=DB::table('tbl_brand_product')->get();//lấy dữ liệu từ table
   		$manager=view('admin.data_brand')->with('showdata',$showdata);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.data_brand',$manager);//trang index chứa luôn data mỗi khi load
   	}
   	public function saveData(Request $request)
   	{
         $this->checklogin();
   		$data=array();
   		$data['brand_name']=$request->brand_name;
   		$data['brand_desc']=$request->brand_desc;
   		$data['brand_status']=$request->status;
   		$result=DB::table('tbl_brand_product')->insert($data);
   		if($result)
   		{
   			Session(['message'=>'Thêm thương hiệu phẩm thành công']);
    		return Redirect::to('/add-brand');
   		}
   	}
   	public function hienthi($id)
   	{
         $this->checklogin();
   		DB::table('tbl_brand_product')->where('brand_id',$id)->update(['brand_status'=>0]);
   		return Redirect::to('/data-brand');
   	}
   	public function an($id)
   	{
         $this->checklogin();
   		DB::table('tbl_brand_product')->where('brand_id',$id)->update(['brand_status'=>1]);
   		return Redirect::to('/data-brand');
   	}
   	public function show_update_brand($id)
   	{
   		$update=DB::table('tbl_brand_product')->where('brand_id',$id)->get();
   		$manager=view('admin.update_brand')->with('show_update',$update);//hiển thị dữ liệu lên form data
   		return view('adminIndex')->with('admin.update_brand',$manager);//trang index chứa luôn data mỗi khi load
   	}
   	public function update_brand(Request $request,$id)
   	{
         $this->checklogin();
   		$data=array();
   		$data['brand_name']=$request->product_name;
   		$data['brand_desc']=$request->product_desc;
   		$result=DB::table('tbl_brand_product')->where('brand_id',$id)->update($data);
   		if($result)
   		{
   			Session(['message'=>'Cập nhập thương hiệu thành công']);
    		return Redirect::to('/data-brand');
   		}
   	}
   	public function delete_brand($id)
   	{
         $this->checklogin();
   		$result=DB::table('tbl_brand_product')->where('brand_id',$id)->delete();
   		if($result)
   		{
   			Session(['message'=>'Xóa thương hiệu thành công']);
    		return Redirect::to('/data-brand');
   		}
   	}
}
