<!DOCTYPE HTML>
<html lang="en-US">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" type="image/png" href="{{ Storage::url(setting()->icon) }}"/>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="dash" content="@auth{{ Auth::id() }}@endauth">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<meta name="description" content="The ultimate online sports world where you can search for players in your community, find a partner to play your favourite sport and make new friends! Join challenges, compete with professionals, acquire points and know your rank amongst your competitors" />
	<meta name="keywords" content="sports,sport,play online,find players" />
	<meta name="robots" content="noodp,index,follow" />
	<meta name='revisit-after' content='1 days' />
	<title>SportsMate | {{ $title }}</title>
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/font-awesome.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/ionicons.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/bootstrap.min.css"/>
	{{-- <link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/bootstrap-theme.min.css"/> --}}
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/jquery.fancybox.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/jquery-ui.min.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/owl.carousel.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/owl.transitions.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/jquery.mCustomScrollbar.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/owl.theme.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/slick.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/animate.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/libs/hover.css"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/color3.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/theme.css" media="all"/>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/responsive.css" media="all"/>
    <link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/browser.css" media="all"/>
    @if ( direction() == 'rtl' )
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/themeFiles/css/rtl.css" media="all"/>
	@endif
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
   @if (direction() == 'ltr')
      <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
      <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ url('/') }}/player/css/style.css">
			<link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
			<style>
				body{
          font-family: 'Changa', sans-serif;
				}
			</style>
    @else
      <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
      <link rel="stylesheet" href="{{ url('/') }}/player/css/rtl.css">
      <link href="https://fonts.googleapis.com/css?family=Changa" rel="stylesheet">
      <style>
        .pull-right{
          float: left !important;
        }
        body{
          font-family: 'Changa', sans-serif;
        }
      </style>
		@endif
    <link rel="stylesheet" href="{{ url('/') }}/css/croppie.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
	<link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
	

	<!-- <link rel="stylesheet" type="text/css" href="css/rtl.css" media="all"/> -->
</head>
<body class="preload">
	<div class="wrap">