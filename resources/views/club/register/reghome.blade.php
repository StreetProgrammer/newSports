@extends('club.register.regindex')
@section('content')

	{{-- @include('admin.layouts.messages') --}}
  @yield('content')
  <div id="pageTop">
    @if (!Auth::check())

      @include('club.register.pageParts.mainRegisterAdvice')

    @else
    <!--  -->
      @include('club.register.pageParts.rejectedMessage')
    <!--  -->
    @endif
  </div>
      <div class="row">
        <span class="Loader" style="position:absolute;bottom:50%;left:50%;
              transform:translate(-50%, -20%);
              -ms-transform:translate(-50%, -20%);
              color:white;font-size:16px;border:none;
              cursor:pointer;font-size:10px;color:#3c8dbc;
              z-index: 1;display: none;"
          ><i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
        </span>
          <div id="contentChangable">
            @if (Auth::check())

              @php
                $club = Auth::user();
              @endphp
              @include('club.register.pageParts.editMainRegisterInfo')

            @else

              @include('club.register.pageParts.mainRegisterInfo')
              
            @endif
            
          </div>
          
       </div>

@endsection

<!--  start upload branch logo Model -->
<div id="newPlaygroundImageFileModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ trans('club.Add_Photo') }}</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="newPlaygroundImgDiv" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_newPlaygroundImage">{{ trans('club.save') }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('club.close') }}</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->

<!--  start upload branch logo Model -->
<div id="addPlaygroundImageFileModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ trans('club.Add_Photo') }}</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="playgroundImgDiv" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_playgroundImage">{{ trans('club.save') }}</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('club.close') }}</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->


@section('page_specific_scripts')
    <!-- flot charts scripts-->
    <script src="{{ url('/') }}/club/club/js/clubRegister.js"></script>
@stop