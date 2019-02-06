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
            <div class="col-md-2"></div>
            <div class="col-md-8">
              
              @if ($user->type == 3)
                <div id="editClubAdminForm">
                  @include('club.Persons.pageParts.editPerson.editClubAdminForm')
                </div>
              @elseif($user->type == 4)
                <div id="editClubManagerForm" style="">
                  @include('club.Persons.pageParts.editPerson.editClubManagerForm')
                </div>
              @endif
              
              
            </div><!-- col-md-8 -->
            <div class="col-md-2 text-center" style="background: #fff">
               <!--  <div class="form-group">
                 <label style="cursor: pointer;">
                   <input type="radio" name="changeForm" value="editClubAdminForm" class="flat-red" checked>
                   Admin
                 </label>
               </div>
               <div class="form-group">
                 <label style="cursor: pointer;">
                   <input type="radio" name="changeForm" value="editClubManagerForm" class="flat-red" >
                   Manager
                 </label>
               </div> -->
            </div><!-- col-md-4 -->
          </div>  
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    <br>
  </div>
<!-- /.box -->
</div>

<!--  end upload branch logo Model -->

@endsection