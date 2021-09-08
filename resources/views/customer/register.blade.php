@extends('login')
@section('content')
	<div class="c-layout-page">
      <div class="login-box">
        <div class="login-box-body">
            <p class="login-box-msg">Đăng Ký Tài Khoản</p>
            <p style="font-size: 15px;font-weight: bold;">- Nhập đúng Email thật, tránh tình trạng quên mật khẩu</p>
            <p style="font-size: 15px;font-weight: bold;">- Điền địa và số điện thoại đúng, để giao hàng chính xác</p>
            <form action="{{URL::to('/register-data')}}" method="POST" id="check">
                {{csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Tài khoản">
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="name" placeholder="Họ tên">
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="address" placeholder="Địa chỉ">
                </div>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                </div>

                <?php
                     $notify=Session('notify');
                     $icon=Session('icon');
                    if($notify){
                    ?> 
                                <script type="text/javascript">
                                    Swal.fire({
                                      icon: '{{$icon}}',
                                      title: '{{$notify}}',  
                                    })
                                 </script>
                    <?php
                     Session::put('notify',null);
                     }
                 ?>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">Đăng Ký</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
             <div class="social-auth-links text-center">
                <p style="margin-top: 5px">- HOẶC -</p>
                
                    
                    
                <a href="{{URL::to('/login')}}" class="btn  btn-social btn-facebook btn-flat"> Đăng Nhập</a>
            </div>
            
        </div>
        
    </div>
  

    <style>
        .login-box, .register-box {
            width: 500px;
            margin: 7% auto;
            border: 1px solid #cccccc;
            padding: 20px;;
        }

        .login-box-msg, .register-box-msg {
            margin: 0;
            text-align: center;
            padding: 0 20px 20px 20px;
            text-align: center;
            font-size: 20px;;
        }
    </style>
      <!-- END: PAGE CONTENT -->
 </div>

@endsection
