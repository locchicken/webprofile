<?php

namespace App\Http\Controllers;
use Cart;
use Illuminate\Http\Request;
use DB;
use App\Models\Social; //sử dụng model Social
use Socialite; //sử dụng Socialite
use App\Models\Login; //sử dụng model Login
use App\Http\Requests;
use App\Rules\Captcha;
use Validator;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index()
    {
    	$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	$product=DB::table('tbl_product')->where('product_status','1')->limit(6)->orderby('product_id','desc')->get();
    	return view('pages.home')->with('cate',$cate)->with('brand',$brand)->with('product',$product);
    }
    public function show_category($id)
    {
    	$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')
      ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
      ->where('tbl_product.category_id',$id)->get();
        return view('pages.category')->with('cate',$cate)->with('brand',$brand)->with('cate_data_id',$result);
    }
    public function show_brand($id)
    {
    	$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')
      ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
      ->where('tbl_product.brand_id',$id)->get();
        return view('pages.brand')->with('cate',$cate)->with('brand',$brand)->with('cate_data_id',$result);
    }
    public function detail_product($id)
    {
    	$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')
    	->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
    	->where('tbl_product.product_id',$id)->get();

    	//sản phẩm liên quan
    	foreach($result as $key=>$value)
    	{
    		$brand_id=$value->brand_id;
    	}
    	$related=DB::table('tbl_product')
    	->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
    	->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
    	->where('tbl_brand_product.brand_id',$brand_id)->whereNotIn('tbl_product.product_id',[$id])->get();
        return view('pages.detail')->with('cate',$cate)->with('brand',$brand)->with('detail',$result)->with('related',$related);
    }
    public function cart(Request $request)
	{
		$product_id=$request->product_id;
		$qty=$request->quantity;
		$product=DB::table('tbl_product')->where('product_id',$product_id)->first();
       $data['id']=$product->product_id;//lấy id sản phẩm
       $data['qty']=$qty;//lấy số lượng
       $data['name']=$product->product_name;
       $data['price']=$product->product_price;
       $data['weight']=$product->product_price;
       $data['options']['image']=$product->product_image;
       Cart::add($data);
       return Redirect::to('/show-cart');
        
	}
	public function show_cart()
	{
		$cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
		return view('cart.order_cart')->with('cate',$cate)->with('brand',$brand);
	}
  public function delete_cart($rowid)
  {
      Cart::update($rowid,0);
      return Redirect::to('/show-cart');
  }
  public function update_quantity(Request $request)
  {
      $qty=$request->quantity;
      $row=$request->rowid;
      Cart::update($row,$qty);
      return Redirect::to('/show-cart');
  }

  public function login()
  {
    return view('customer.login_system');
  }
  public function register()
  {
    return view('customer.register');
  }
  public function dangky(Request $request)
  {
    if($request->name=="" ||$request->username==""||$request->email==""||$request->address==""||$request->phone==""||$request->password=="")
    {
      Session(['notify'=>'Chưa điền đầy đủ thông tin']);
      Session(['icon'=>'error']);
      return Redirect::to('register'); 
    }
    $result=DB::table('tbl_customer')->where('customer_username',$request->username)->first();
    if($result)
    {
      Session(['notify'=>'Tài khoản đã tồn tại trong hệ thống']);
      Session(['icon'=>'error']);
      return Redirect::to('register'); 
    }
    $data=array();
    $data['customer_name']=$request->name;
    $data['customer_username']=$request->username;
    $data['customer_password']=md5($request->password);
    $data['customer_email']=$request->email;
    $data['customer_address']=$request->address;
    $data['customer_phone']=$request->phone;
    $customer=DB::table('tbl_customer')->insertGetId($data);//thêm và lấy id đã thêm
    Session(['customer_id'=>$customer]);
    Session(['customer_name'=>$request->name]);
    Session(['notify'=>'Đăng ký tài khoản thành công']);
    Session(['icon'=>'success']);
    return Redirect::to('register');
  }
  public function dangnhap(Request $request)
  {
    if($request->username==""||$request->password=="")
    {
      Session(['notify'=>'Chưa điền đầy đủ thông tin']);
      Session(['icon'=>'error']);
      return Redirect::to('/login'); 
    }
    // $request->validate([
    //        'g-recaptcha-response' => new Captcha(),   //dòng kiểm tra Captcha
    //     ]);
      $user=$request->username;
      $pass=md5($request->password);
      $result=DB::table('tbl_customer')->where('customer_username',$user)->where('customer_password',$pass)->first();//first là giới hạn 1
      if($result)
      {
        Session(['customer_id'=>$result->customer_id]);
        Session(['customer_name'=>$result->customer_name]);
         Session(['level'=>$result->level]);
        return Redirect::to('/trang-chu');
      }else{
        Session(['notify'=>'Tài khoản hoặc mật khẩu không chính xác']);
        Session(['icon'=>'error']);
        return Redirect::to('/login');
      }
  }
   public function logout()
    {
        
        Session(['customer_id'=>NULL]);
        Session(['customer_name'=>NULL]);
        return Redirect::to('/login');
    }
    public function payment()
    {
        $check=Session('customer_id');
        if($check)
        {

        }
        else{
          Session(['notify'=>'Vui lòng đăng nhập để thanh toán đơn hàng']);
          Session(['icon'=>'error']);
          return Redirect::to('/show-cart');
        }
    }
    public function search(Request $request)
    {
        $keywords=$request->search;
        $cate=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $result=DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.search')->with('cate',$cate)->with('brand',$brand)->with('search',$result);
    }

    //facebook
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in vao trang quan tri  
            $account_name = Login::where('customer_id',$account->user)->first();
            Session(['customer_name'=>$account_name->customer_name]);
            Session(['customer_id'=>$account_name->customer_id]);
            return redirect('/trang-chu');
        }
        else
        {

            $chicken = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('customer_email',$provider->getEmail())->first();

            if(!$orang)
            {
                $orang = Login::create([
                    'customer_name' => $provider->getName(),
                    'customer_username' =>'',
                    'customer_password' =>'',
                    'customer_email' => $provider->getEmail(),
                    'customer_address' => '',
                    'customer_phone' => ''

                ]);
            }
            $chicken->login()->associate($orang);
            $chicken->save();

            $account_name = Login::where('customer_id',$chicken->user)->first();
            Session(['customer_name'=>$account_name->customer_name]);
            Session(['customer_id'=>$account_name->customer_id]);
            return redirect('/trang-chu');
        } 
    }


    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
    public function callback_google(){
            $users = Socialite::driver('google')->stateless()->user(); 
            // return $users->id;
            $authUser = $this->findOrCreateUser($users,'google');
            if($authUser)
            {
                $account_name = Login::where('customer_id',$authUser->user)->first();
                Session(['customer_name'=>$account_name->customer_name]);
                Session(['customer_id'=>$account_name->customer_id]);
            }elseif ($chicken) {
              $account_name = Login::where('customer_id',$authUser->user)->first();
              Session(['customer_name'=>$account_name->customer_name]);
              Session(['customer_id'=>$account_name->customer_id]);
            }  
            return redirect('/trang-chu');
           
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }
        else{
            $chicken = new Social([
            'provider_user_id' => $users->id,
            'provider' => strtoupper($provider)
        ]);

        $orang = Login::where('customer_email',$users->email)->first();

            if(!$orang){
                $orang = Login::create([
                    'customer_name' => $users->name,
                    'customer_username' =>'',
                    'customer_password' =>'',
                    'customer_email' => $users->email,
                    'customer_address' => '',
                    'customer_phone' => ''
                ]);
            }
        $chicken->login()->associate($orang);
        $chicken->save();
        return $chicken;
        }
    }


}
