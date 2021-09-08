<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
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
    public function index()
    {
    	return view('adminLogin');
    }
    public function show_Admin()
    {
        $this->checklogin();
    	return view('admin.dashboard');
    }
    public function check_login(Request $request)
    {
    	$user=$request->username;
    	$pass=md5($request->password);
    	$result=DB::table('tbl_admin')->where('admin_username',$user)->where('admin_password',$pass)->first();//first là giới hạn 1
    	if($user==""||$pass=="")
    	{
    		Session(['check_empty'=>'Chưa điền đầy đủ thông tin']);
    	}
    	if($result)
    	{
    		Session(['admin_id'=>$result->admin_id]);
    		Session(['admin_name'=>$result->admin_name]);
    		return Redirect::to('/quan-tri-admin');
    	}else{
    		Session(['message'=>'Tài khoản hoặc mật khẩu không chính xác']);
    		return Redirect::to('/dang-nhap');
    	}
    	
    }
    public function logout()
    {
            $this->checklogin();
    		Session(['admin_id'=>NULL]);
    		Session(['admin_name'=>NULL]);
    		return Redirect::to('/dang-nhap');
    }
}
