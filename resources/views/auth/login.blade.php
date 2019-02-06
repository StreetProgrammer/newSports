<html>
  <head>
    
     <title>{{ trans('player.loginTitle') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/flexslider.min.css">
    <!--===============================================================================================-->  
    <link rel="shortcut icon" type="image/png" href="{{ Storage::url(setting()->icon) }}"/>
     @if (direction() == 'ltr')
      <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/player/css/style.css">

    @else
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
      <link rel="stylesheet" href="{{ url('/') }}/player/css/rtl.css">
      <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
      <style>
        body{
          font-family: 'Cairo', sans-serif;
        }
      </style>
    @endif  
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/vendor/animate/animate.css">
  <!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/css/util.css">
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/player/css/main.css">
  <!--===============================================================================================-->
    <style type="text/css">
      .input100, .login100-form-btn{
          height: 45px;
      }
    </style> 
  </head>
  <body>

  @include('site.layouts.nav.headerMenu')

    <!----Slider ----->

 
    <!-- #endregion Jssor Slider End -->
<div class="limiter" style="font-family: 'Cairo', sans-serif; !important">
    <div class="container-login100">
      <div class="wrap-login100 p-l-50 p-r-50 p-t-77 p-b-30" style="padding-top: 20px;">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          {!! csrf_field() !!}
          <span class="login100-form-title">
            {{ trans('player.loginTitle') }}
          </span>

          <div class="alert">
            @if (session('status'))
              <div class="alert alert-success text-center">
                  {{ session('status') }}
              </div>
            @endif
            @if (session('warning'))
              <div class="alert alert-danger text-center">
                  {{ session('warning') }}
              </div>
            @endif
            @if ($errors->has('email'))
              <div class="alert alert-danger text-center">
                  {{ $errors->first('email') }}
              </div>
            @endif
            @if ($errors->has('password'))
              <div class="alert alert-danger text-center">
                  {{ $errors->first('email') }}
              </div>
            @endif
          </div>

          <div class="wrap-input100 validate-input m-b-16 @if ($errors->has('email')) alert-validate @endif" 
                data-validate = "{{------------------------}}
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @else
                                    {{ trans('player.email_Field_is_required') }}
                                @endif

                                {{------------------------}}"
          >
            <input type="email" name="email" value="{{ old('email') }}" placeholder="{{ trans('player.Email') }}" class="input100">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-envelope"></span>
            </span>
          </div>

          <div class="wrap-input100 validate-input m-b-16 @if ($errors->has('password')) alert-validate @endif" 
                data-validate = "{{------------------------}}
                                @if ($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @else
                                    {{ trans('player.password_Field_is_required') }}
                                @endif

                                {{------------------------}}"
          >

          <input class="input100" type="password" name="password" placeholder="{{ trans('player.Password') }}">
            <span class="focus-input100"></span>
            <span class="symbol-input100">
              <span class="lnr lnr-lock"></span>
            </span>
          </div>

           @if ( $errors->has('password') || $errors->has('email') )
              {{-- start forget password --}}

            <div class="contact100-form-checkbox m-l-4">
              <a href="{{ url('/') }}/password/reset">
                <label class="" style="color:#c80000;cursor:pointer">
                  {{ trans('player.forget_password') }}
                </label>
              </a>
            </div>
              {{-- end forget password --}}
          @else
            <div class="contact100-form-checkbox m-l-4">
              <input class="input-checkbox100" 
                    id="ckb1" type="checkbox" 
                    name="remember" 
                    {{ old('remember') ? 'checked' : '' }}
              >
              <label class="label-checkbox100" for="ckb1">
                {{ trans('player.Remember_me') }}
              </label>
            </div>
          @endif
          
          <div class="container-login100-form-btn p-t-25">
            <button type="submit" class="login100-form-btn">
              {{ trans('player.SignIn') }}
            </button>
          </div>

          <div class="text-center w-full p-t-42 p-b-22">
            <span class="txt1">
              {{ trans('player.Or_login_with') }}
            </span>
          </div>

          <a href="{{ url('/') }}/login/facebook" class="m-b-10" style="margin: 0px 60px !important">
            <img width="50px" src="{{ url('/') }}/player/img/facebook.png" alt="GOOGLE"> 
             
          </a>

          <!-- <a href="{{ url('/') }}/login/linkedin" class=" m-b-10">
            <img width="40px" src="{{ url('/') }}/player/img/linkedin.png" alt="GOOGLE"> 
             
          </a> -->

          {{-- <a href="{{ url('/') }}/login/twitter" class=" m-b-10">
            <img width="40px" src="{{ url('/') }}/player/img/twitter.png" alt="GOOGLE"> 
             
          </a> --}}

          <a href="{{ url('/') }}/login/google" class="m-b-10" style="margin: 0px 60px !important">
            <img width="50px" src="{{ url('/') }}/player/img/google.png" alt="GOOGLE"> 
             
          </a>

          <div class="text-center w-full p-t-115" style="padding-top:50px;">
            <span class="txt1">
              {{ trans('player.Not_a_member?') }}
            </span>

            <a class="txt1 bo1 hov1" href="{{ url('/') }}/register">
              {{ trans('player.Sign_up_now') }}             
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>
    
     <script type="https://code.jquery.com/jquery-3.2.1.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script type="text/javascript">
        $(window).on('scroll', function(){
            if( $(window).scrollTop() >= 200 ){

                $('.notify-nav').addClass('stickyNavIcon');
                $('.navbar-default').addClass('navbar-fixed-top');
                $('.navbar-default').fadeIn();

            }else{
                
                $('.notify-nav').removeClass('stickyNavIcon');
                $('.navbar-default').removeClass('navbar-fixed-top');

            }
        });
    </script>


<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>  
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="{{ url('/') }}/player/js/main.js"></script>
    </body>
</html>