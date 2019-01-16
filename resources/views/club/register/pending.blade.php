<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('club.pendingClubProfile') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE') }}/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ url('design/AdminLTE') }}/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <img src="{{ Storage::url(setting()->icon) }}" width="150px ;height:auto">
    <br>
    {{-- <a href="{{ url('/') }}"><b>Sports </b>Mate</a> --}}
  </div>
  <!-- User name -->
  <div class="lockscreen-name">Pending Club Account</div>
  
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img 
          @if ( empty(Auth::user()->user_img) )
            src="http://via.placeholder.com/200x200?text=Club%20Logo
          @else
            src="{{ Storage::url(Auth::user()->user_img) }}"
          @endif
           
          alt="User Image"
      >
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials">
      <div class="input-group">
        <!-- <input type="password" class="form-control" placeholder="password"> -->
        <span class="form-control">{{ Auth::user()->name }}</span>
        <div class="input-group-btn">
          <button type="button" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center" style="background: #fff;padding: 10px;border: 1px solid;font-size: 15px;font-weight: bold;">
    your Account is now a pending Account, please wait for our review
  </div>
  <div class="text-center">
    <a href="{{ url('/') }}">Home</a>
  </div>
  <div class="lockscreen-footer text-center">
    Copyright © {{\Illuminate\Support\Carbon::now()->year}} <b><a href="{{url('/')}}" class="text-black">SportsMate</a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="{{ url('design/AdminLTE') }}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('design/AdminLTE') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{ url('design/AdminLTE') }}/plugins/iCheck/icheck.min.js"></script>
<script>
  /*$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });*/
</script>
</body>
</html>
