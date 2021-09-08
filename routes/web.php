<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*gọi hàm index từ controller*/

use App\Http\Controllers\HomeController;
Route::get('/','App\Http\Controllers\HomeController@index');
Route::get('/trang-chu','App\Http\Controllers\HomeController@index');
Route::get('/dang-nhap','App\Http\Controllers\AdminController@index');
Route::get('/quan-tri-admin','App\Http\Controllers\AdminController@show_Admin');
Route::get('/log-out','App\Http\Controllers\AdminController@logout');
Route::post('/check-login','App\Http\Controllers\AdminController@check_login');
//category
Route::get('/add-category-product','App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/data-category-product','App\Http\Controllers\CategoryProduct@data_category_product');
Route::get('/show/{category_id}','App\Http\Controllers\CategoryProduct@show');
Route::get('/hide/{category_id}','App\Http\Controllers\CategoryProduct@hide');
Route::get('/update/{category_id}','App\Http\Controllers\CategoryProduct@show_update');
Route::get('/delete/{category_id}','App\Http\Controllers\CategoryProduct@delete');
Route::post('/save-category-product','App\Http\Controllers\CategoryProduct@saveData');
Route::post('/update-category/{category_id}','App\Http\Controllers\CategoryProduct@update');
//brand
Route::post('/save-brand','App\Http\Controllers\BrandProduct@saveData');
Route::get('/add-brand','App\Http\Controllers\BrandProduct@add_brand');
Route::get('/data-brand','App\Http\Controllers\BrandProduct@data_brand');
Route::get('/hienthi/{brand_id}','App\Http\Controllers\BrandProduct@hienthi');
Route::get('/an/{brand_id}','App\Http\Controllers\BrandProduct@an');
Route::get('/update-brand/{brand_id}','App\Http\Controllers\BrandProduct@show_update_brand');
Route::get('/delete-brand/{brand_id}','App\Http\Controllers\BrandProduct@delete_brand');
Route::post('/update-brand/{brand}','App\Http\Controllers\BrandProduct@update_brand');
//product
Route::get('/add-product','App\Http\Controllers\Product@add_product');
Route::post('/save-product','App\Http\Controllers\Product@saveData');
Route::get('/data-product','App\Http\Controllers\Product@data_product');
Route::get('/show-product/{product_id}','App\Http\Controllers\Product@show_product');
Route::get('/hide-product/{product_id}','App\Http\Controllers\Product@hide_product');
Route::get('/delete-product/{product_id}','App\Http\Controllers\Product@delete_product');
Route::get('/update-product/{product_id}','App\Http\Controllers\Product@show_update');
Route::post('/update-data-product/{product_id}','App\Http\Controllers\Product@update_data');
//home
Route::get('/danh-muc-san-pham/{category_id}','App\Http\Controllers\HomeController@show_category');
Route::get('/thuong-hieu/{brand_id}','App\Http\Controllers\HomeController@show_brand');
Route::get('/chi-tiet-san-pham/{product_id}','App\Http\Controllers\HomeController@detail_product');
 Route::post('/gio-hang','App\Http\Controllers\HomeController@cart');
 Route::get('/show-cart','App\Http\Controllers\HomeController@show_cart');
 Route::get('/delete-cart/{rowid}','App\Http\Controllers\HomeController@delete_cart');
 Route::post('/update-quantity','App\Http\Controllers\HomeController@update_quantity');
 Route::get('/login','App\Http\Controllers\HomeController@login');
 Route::get('/register','App\Http\Controllers\HomeController@register');
 Route::post('/register-data','App\Http\Controllers\HomeController@dangky');
Route::post('/login-system','App\Http\Controllers\HomeController@dangnhap');
Route::get('/logout','App\Http\Controllers\HomeController@logout');
Route::get('/payment','App\Http\Controllers\HomeController@payment');
Route::post('/tim-kiem','App\Http\Controllers\HomeController@search');

//Login facebook
Route::get('/login-facebook','App\Http\Controllers\HomeController@login_facebook');
Route::get('/login/callback','App\Http\Controllers\HomeController@callback_facebook');

//Login  google
Route::get('/login-google','App\Http\Controllers\HomeController@login_google');
Route::get('/login/google','App\Http\Controllers\HomeController@callback_google');


