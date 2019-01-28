<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sport Mate | Club Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="{{ Storage::url(setting()->icon) }}"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/adminMainStyle.css">
  <link rel="stylesheet" href="{{ url('/') }}/css/club.css">
  {!! Charts::assets() !!}
  <!-- Theme style -->
  @if (direction() == 'ltr')
      <style>
        .my-fa-angle-left{margin-top: -15px !important;margin-left: .3em;}
      </style>
        
          <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/AdminLTE.min.css">
  @else
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/AdminLTE.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/bootstrap.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/bootstrap-rtl.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/rtl.css">
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/rtl/profile-rtl.css">
      <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
      <style media="screen">
          html,body,h1,h2,h3,h4,h5,.modal {font-family: 'Cairo', sans-serif;}
          .pull-right{float: left!important;} 
          .my-fa-angle-left{margin-top: 0px !important;margin-left: .3em;}
      </style>
  @endif
  <link rel="stylesheet" href="{{ url('/') }}/css/croppie.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
<script src="{{ url('/') }}/design/AdminLTE/dist/js/admin.js"></script>
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- jQuery 3 -->
<script src="{{ url('/') }}/design/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
