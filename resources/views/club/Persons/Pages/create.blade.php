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
              {!! Form::open(['url' => url('club/users/store'), 'method' => 'POST']) !!}
              <div id="addClubAdminForm">
                @include('club.Persons.pageParts.createPerson.addClubAdminForm')
              </div>
              <div id="addClubManagerForm" style="display: none">
                @include('club.Persons.pageParts.createPerson.addClubManagerForm')
              </div>
               {!! Form::submit(trans('admin.saveCountryBtn'),['class'=>'btn btn-primary', 'id' => 'createAdmin']) !!}
               {!! Form::close() !!}
            </div><!-- col-md-8 -->

            <div class="col-md-4 text-center" style="background: #fff">
                <div class="form-group">
                  <label style="cursor: pointer;">
                    <input type="radio" name="changeForm" value="addClubAdminForm" class="flat-red" checked>
                    {{trans('club.admin')}}
                  </label>
                </div>
                <div class="form-group">
                  <label style="cursor: pointer;">
                    <input type="radio" name="changeForm" value="addClubManagerForm" class="flat-red" >
                    {{trans('club.manager')}}
                  </label>
                </div>
            </div><!-- col-md-4 -->


          </div><!-- /.row -->
        </div><!-- /.box-body -->
        
      </div><!-- /.box -->
      
    <br>
  </div>

<!--  end upload branch logo Model -->

@endsection

@section('page_specific_scripts')
<script>
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////// start change between forms to [ add / edit ] club users [ admin, manager ]//////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
$('input[type=radio][name=changeForm]').on('change', function() {
    switch($(this).val()) {
        case 'addClubAdminForm':
            //alert("addClubAdminForm");
            $('#addClubManagerForm').hide() ;
            $('#formTitle').text('{!! trans('club.adminName') !!}') ;
            $('input[type=hidden][name=type]').val(3) ;
            break;
        case 'addClubManagerForm':
            //alert("addClubManagerForm");
            //$('#addClubAdminForm').hide() ;
            $('#addClubManagerForm').fadeIn() ;
            $('#formTitle').text('{!! trans('club.managerName') !!}') ;
            $('input[type=hidden][name=type]').val(4) ;
            break;
          case 'editClubAdminForm':
            //alert("editClubAdminForm");
            $('#editClubManagerForm').hide() ;
            $('#editClubAdminForm').fadeIn() ;
            break;
        case 'editClubManagerForm':
            //alert("editClubManagerForm");
            $('#editClubAdminForm').hide() ;
            $('#editClubManagerForm').fadeIn() ;
            break;
    }
});
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////// end change between forms to [ add / edit ] club users [ admin, manager ]//////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

</script>
    
@stop
