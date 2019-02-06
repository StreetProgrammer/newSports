@extends('club.index')
@section('content')

<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Branch Data
      </h1>
      <p class="text-muted text-center breadcrumb">
	    Created since  @php  echo date('d-m-Y', strtotime($clubBranche->created_at)) ; @endphp
	  </p>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Club profile</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

	    <div class="row">
	        <div class="mainBranchInfo col-md-12">
				    @include('club.Branches.pageParts.branchdisplay.mainBranchInfo')
	        </div>

    			{{--<div class="mainInfo col-md-4">
             @include('club.Branches.pageParts.branchdisplay.BranchImageDiv')  
          </div> --}} 
      </div>

        <div class="row">
	        <div class="BranchPlaygroundsDiv col-md-8">
				@include('club.Branches.pageParts.branchdisplay.BranchPlaygroundsDiv')
	        </div>

			<div class="mainInfo col-md-4">
				@include('club.Branches.pageParts.branchdisplay.BranchImageDiv')
	        </div>
        </div>

    </section>

  <!------ End Profile Content ------------->
<!--  start upload branch logo Model -->
<div id="uploadBranchLogoModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload & Crop Image</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="logo_crop" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_BranchLogoImage">Crop</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->
<!--  start upload branch logo Model -->
<div id="uploadBranchBannerModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload & Crop Image</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="BannerImage" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-success crop_BranchBannerImage">Crop</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->
@endsection
