@extends('login')
@section('content')
	<div class="c-layout-page">
  <!-- BEGIN: PAGE CONTENT -->
      <div class="login-box">

        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Đăng nhập vào hệ thống</p>
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
            <form action="{{URL::to('login-system')}}" method="POST">
                {{csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" value="" placeholder="Tài khoản">
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Mật khẩu">
                </div>

                <div class="row">
                    <div class="col-xs-6" style="text-align: left">
                        <a href="/quen-mat-khau.php" style="margin-top: 10px;margin-bottom: 10px;display: block;font-style: italic;">Quên mật khẩu?</a><br>
                    </div>
                </div>
                <div class="row">
                    <center><div>
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                        <br/>
                        @if($errors->has('g-recaptcha-response'))
                        <span class="invalid-feedback" style="display:block">
                            <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                        </span>
                        @endif
                    </div></center>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" style="margin: 0 auto;">Đăng nhập</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
             <div class="social-auth-links text-center">
                <p style="margin-top: 5px">- HOẶC -</p>
                
                    
                    
                <a href="{{URL::to('/login-facebook')}}" class="btn  btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Facebook</a>
                <a style="color: red;" href="{{URL::to('/login-google')}}"><i class="fab fa-google"></i> Google</a>
            </div>
            <div class="social-auth-links text-center">
                <p>Bạn chưa có tài khoản ?<a href="{{URL::to('/register')}}"> Tạo tài khoản</a></p>
            </div>
            <!-- /.social-auth-links -->
        </div>
        <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->

    <style>
        .login-box, .register-box {
            width: 400px;
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
