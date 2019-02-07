<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SportsMate | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/design/AdminLTE/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
            <img width="100" src="{{ Storage::url(setting()->icon) }}" alt="">
        <small class="pull-right">Date: {{ $Reservation->created_at->format('d - M - Y') }}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>{{$Reservation->resOwner}}</strong><br>
          {{-- 795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com --}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{$Reservation->club->name}}</strong><br>
          <b>Email: </b>{{$Reservation->club->email}}<br>
          <b>Phone: </b>{{$Reservation->club->clubProfile->c_phone}}<br>
          <b>Location: </b>
            {{$Reservation->club->clubProfile->country->c_en_name}} {{$Reservation->club->clubProfile->governorate->g_en_name}} {{$Reservation->club->clubProfile->area->a_en_name}}<br>
          <b>Adress: </b>{{$Reservation->club->clubProfile->c_address}}
          </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #{{$Reservation->id}}</b><br>
        <br>
        <b>Employee ID:</b> #{{$Reservation->creator->id}}<br>
        <b>Creator Employee:</b> {{$Reservation->creator->name}}<br>
        <b>Position:</b> {{$Reservation->creator->type == 2 ? 'Owner' : ($Reservation->creator->type == 3 ? 'Admin' : 'Manager') }}
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Qty</th>
            <th>Court</th>
            <th>Day</th>
            <th>Date</th>
            <th>From</th>
            <th>To</th>
            <th>Price/Hour</th>
            <th>Hours</th>
            <th>Total</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>1</td>
            <td>{{$Reservation->playground->c_b_p_name}}</td>
            <td>{{$Reservation->day->day_format}}</td>
            <td>{{$Reservation->R_date}}</td>
            <td>{{$Reservation->from->hour_format}}</td>
            <td>{{$Reservation->to->hour_format}}</td>
            <td>{{$Reservation->R_price_per_hour}} LE</td> 
            <td>{{$Reservation->R_hour_count}}</td>
            <td>{{$Reservation->R_total_price}} LE</td>
          </tr>
          
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      {{--<div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <img src="{{ url('/') }}/design/AdminLTE/dist/img/credit/visa.png" alt="Visa">
        <img src="{{ url('/') }}/design/AdminLTE/dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="{{ url('/') }}/design/AdminLTE/dist/img/credit/american-express.png" alt="American Express">
        <img src="{{ url('/') }}/design/AdminLTE/dist/img/credit/paypal2.png" alt="Paypal">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p>
      </div>
      <!-- /.col -->--}}
      <div class="col-xs-12">
        <p class="lead">Date: {{ $Reservation->created_at->format('d - M - Y') }}</p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">total:</th>
              <td>{{$Reservation->R_total_price}} LE</td>
            </tr>
            {{-- <tr>
              <th>Tax (9.3%)</th>
              <td>$10.34</td>
            </tr>
            <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr> --}}
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
