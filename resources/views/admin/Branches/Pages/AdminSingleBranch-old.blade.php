@extends('admin.index')
@section('content')


<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          {{ trans('admin.single_branch.Playground_Data') }}
          <span class="text-muted" style="font-size: 11px;">
              {{ trans('admin.single_branch.Created_since') }}  {{ date('d-m-Y', strtotime($Branch->created_at)) }}
              </span>
        </h1>
        
        <ol class="breadcrumb">
          <li><a href="{{ aurl('/') }}"><i class="fa fa-dashboard"></i> {{ trans('admin.single_branch.dashboard') }}</a></li>
          <li><a href="{{ aurl('/') }}/branches">{{ trans('admin.single_branch.branches') }}</a></li>
          <li class="active">{{ $Branch->c_b_name }}</li>
        </ol>
      </section>

    <!-- Main content -->
    <section class="content">

	    <div class="row">
	        <div class="mainBranchInfo col-md-12">
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
          {!! Form::open(['url' => aurl(''), 'method' => 'POST']) !!}
          {!! Form::hidden( 'clubId', Auth::id() ) !!}
          {!! Form::hidden( 'BranchId', $Branch->id ) !!}
          <div class="box box-primary mainBranchInfo">
            <div class="box-header with-border">
              <h3 class="box-title">
                About 
                <span style="color:#3c8dbc;font-weight: bold;">
                  {{ $Branch->c_b_name }}
                </span> 
                Branch
              </h3>
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="list-group list-group-unbordered displayDetails">
               {{--
               		<li class="list-group-item">
                    	<b>Branches</b> <a class="pull-right">{{ $Branch->BranchPlaygrounds()->count() }}</a>
                    </li>
                  	<li class="list-group-item">
                    	<b>Playgrounds</b> <a class="pull-right">{{ $Branch->BranchPlaygrounds()->count() }}</a>
                  	</li>
                --}}
                <li class="list-group-item">
                  	<b>Playgronds</b>
                  	<a class="pull-right badge">{{ $Branch->BranchPlaygrounds()->count() }}</a>
					        @if ($Branch->BranchPlaygrounds()->count() > 0)
	                  	@foreach ($Branch->BranchPlaygrounds as $playground)
	                  		<span class="badge label-warning pull-right">
	                  			{{$playground->c_b_p_name}}
	                  		</span>
	                  	@endforeach
	                @endif                  
                </li>
              </ul>
              <strong class="editDetails" style="display:none;">
                <i class="fa fa-building custom" style="color: #3c8dbc;"></i>  
                Branch Name
              </strong>
              <p class="text-muted">
                <input type="text" name="c_b_name" class="editDetails form-control" style="display:none;" value="{{ $Branch->c_b_name }}">
              </p>

              <hr class="editDetails" style="display:none;">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i>  Phone</strong>

              <p class="text-muted">
              	<span class="displayDetails">{{ $Branch->c_b_phone }}</span>
              	<input type="text" name="c_b_phone" class="editDetails form-control" style="display:none;" value="{{ $Branch->c_b_phone }}">
              </p>

              <hr class="displayDetails">

              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> Location</strong>

              <p class="displayDetails text-muted">
              	{{ $Branch->c_b_Country->c_en_name }}, {{ $Branch->c_b_City->g_en_name }} {{ $Branch->c_b_Area->a_en_name }}, 
              </p>
              <p class="displayDetails text-muted">
                {{ $Branch->c_b_address }}, 
              </p>
              <!---->

			<div class="col-lg-5 editDetails" style="display:none;">

              <select class="form-control input-xs" name="c_b_city" id="governorate">

                  <option value="">Select Governorate</option>

                @foreach ($governorate as $gov)

                    <option
                      value="{{ $gov->id }}"
                      @php
                        echo ($Branch->c_b_city == $gov->id ? ' selected="selected" ' : '');
                      @endphp
                    >
                        {{ $gov->g_en_name }}
                    </option>

                @endforeach


              </select>

            </div>
            <div class="col-lg-5 editDetails" style="display:none;">
	              <select class="form-control input-xs" name="c_b_area" id="area">

	                <option value="">Select Area</option>
	                @foreach ($governorate as $goov) <!--loop throw each city -->

	                    @foreach ($goov->areas as $area) <!--loop throw each city->area -->

	                      <!--check if we are in Branch city -->
	                      @if ($area->a_governorate_id == $Branch->c_b_city)

	                        <option
	                          value="{{ $area->id }}"
	                        @php
	                          echo ($Branch->c_b_area == $area->id ? ' selected="selected" ' : '');
	                        @endphp
	                        >
	                          {{ $area->a_en_name }}
	                        </option>

	                      @endif


	                    @endforeach
	              @endforeach

	            </select>
	        </div>
	        <div class="col-lg-2 editDetails" style="display:none;" >
				<div id="loader"
	                 class="text-center "
	                 style="display: none;z-index: 99999;font-size: 10px;color: #3c8dbc;"
	            >
	              <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
	            </div>
	        </div>
	        <div class="clearfix"></div>
           <br class="editDetails" style="display:none;"> 
            <strong class="editDetails" style="display:none;">
              <i class="editDetails fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> Detail Adreess
            </strong>
            <p class="text-muted">
              <input type="text" name="c_b_address" class="editDetails form-control" style="display:none;" value="{{ $Branch->c_b_address }}">
            </p>
          <!---->
            <hr>

              <strong><i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> Description</strong>

              <p class="displayDetails">{{$Branch->c_b_desc}}</p>
              <textarea class="editDetails form-control" name="c_desc" id="c_desc" cols="30" rows="8" style="display: none">
              	{{$Branch->c_b_desc}}
              </textarea>
              <hr style="display: none;" class="editDetails">
              {!! Form::submit('Update', ['class' => 'editDetails btn btn-success', 'style' => 'display: none;', 'id' => 'EditclubBrancheMainInfo']) !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      	{!! Form::close() !!}
	        </div>

    			{{--<div class="mainInfo col-md-4">
             @include('club.Branches.pageParts.Branchdisplay.BranchImageDiv')  
          </div> --}} 
      </div>

        <div class="row">
	       {{-- <div class="BranchPlaygroundsDiv col-md-8">
	       	       				@include('club.Branches.pageParts.Branchdisplay.BranchPlaygroundsDiv')
	       	       	        </div> --}}

			{{-- <div class="mainInfo col-md-4">
										@include('club.Branches.pageParts.Branchdisplay.BranchImageDiv')
							        </div> --}}
        </div>

    </section>

  <!------ End Profile Content ------------->
@endsection
