@extends('club.index')
@section('content')
<div class="box box-primary mainInfo">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <span class="mainInfoLoader" style="position:absolute;bottom:50%;left:50%;
          transform:translate(-50%, -20%);
          -ms-transform:translate(-50%, -20%);
          color:white;font-size:16px;border:none;
          cursor:pointer;font-size:10px;color:#3c8dbc;
          z-index: 1;display: none"
    >
        <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
    </span>
          <!-- About Me Box -->

          <div class="row" style="margin: auto">
            <div class="col-md-8">
              {!! Form::open(['url' => url('displayReport'), 'method' => 'POST']) !!}
              <div id="changable">
                @include('club.Reports.pageParts.createReportOf.Users')
              </div>
               {!! Form::submit(trans('admin.saveCountryBtn'),['class'=>'btn btn-primary', 'id' => 'createAdmin']) !!}
               {!! Form::close() !!}
            </div><!-- col-md-8 -->

            <div class="col-md-4 text-center" style="background: #fff">
              
              <div class="form-group">
                <div class="radio">
                  <label>
                    <div class="col-md-4 pull-left">
                      <input type="radio" name="changeForm" id="optionsRadios1" value="Reservations" checked="checked">
                    </div>
                    <div class="col-md-8">
                      <span >{{trans('club.Reservations')}}</span>
                    </div>
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <div class="col-md-4 pull-left">
                      <input type="radio" name="changeForm" id="optionsRadios1" value="Courts">
                    </div>
                    <div class="col-md-8">
                      <span >{{trans('club.Courts')}}</span>
                    </div>
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <div class="col-md-4 pull-left">
                      <input type="radio" name="changeForm" id="optionsRadios1" value="Branches" checked="checked">
                    </div>
                    <div class="col-md-8">
                      <span >{{trans('club.Branches')}}</span>
                    </div>
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <div class="col-md-4 pull-left">
                      <input type="radio" name="changeForm" id="optionsRadios1" value="Users" checked="checked">
                    </div>
                    <div class="col-md-8">
                      <span >{{trans('club.Users')}}</span>
                    </div>
                  </label>
                </div>
              </div>
              
            </div><!-- col-md-4 -->

          </div>
  </div>
        <!-- /.box-body -->
</div>
      <!-- /.box -->
    <br>
</div>


<!--  end upload branch logo Model -->

@endsection

@section('page_specific_scripts')
<script>
///////////////////////////////////////////////////////////////////////////////////////////////////
////////// start change between forms to [ add / edit ] club users [ admin, manager ]//////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
$('input[type=radio][name=changeForm]').on('change', function() {

    var model = $(this).val()
    $('.mainInfoLoader').show();
    switch(model) {
        case 'Users':
            $('#changable').load('/getReportOf/users').fadeIn('slow');
            break;
        case 'Branches':
            $('#changable').load('/getReportOf/branches').fadeIn('slow');
            break;
        case 'Courts':
            $('#changable').load('/getReportOf/courts').fadeIn('slow');
            break;
        case 'Reservations':
            $('#changable').load('/getReportOf/reservations').fadeIn('slow');
            break;
    }
    $('.mainInfoLoader').hide();
});
///////////////////////////////////////////////////////////////////////////////////////////////////
/////////// end change between forms to [ add / edit ] club users [ admin, manager ]///////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

</script>
    
@stop
