@extends('club.index')
@section('content')


<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Playground Data
      </h1>
      <p class="text-muted text-center breadcrumb">
	    Created since  @php  echo date('d-m-Y', strtotime($Playground->created_at)) ; @endphp
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
				   <span class="mainInfoLoader" style="position:absolute;bottom:50%;left:50%;
						transform:translate(-50%, -20%);
						-ms-transform:translate(-50%, -20%);
						color:white;font-size:16px;border:none;
						cursor:pointer;font-size:10px;color:#3c8dbc;
						z-index: 1;display: none"
			>
				<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
			</span>
          <div class="box box-primary mainBranchInfo">
            <div class="box-header with-border">
              <h3 class="box-title">
                About 
                <span style="color:#3c8dbc;font-weight: bold;">
                  {{$Playground->c_b_p_name}}
                </span> 
                Playground
              </h3>

              @if ($Playground->our_is_active == 1)
                <span class="btn btn-success btn-flat margin">activated by SportsMate</span>
              @elseif($Playground->our_is_active == 0)
                <span class="btn btn-danger btn-flat">deactivated by SportsMate</span>
              @endif
              <!-- span To display playground reservation model-->
              <span class="btn btn-success btn-flat" 
                    data-toggle="modal" 
                    data-target="#calendar{{ $Playground->id }}" 
                    id=""
              >
                {{ trans('club.reservations') }}
              </span>

              {!! Form::open(['url' => url('playground/changeActivationStatus'), 'method' => 'POST']) !!}
              {!! Form::hidden( 'target', $Playground->id ) !!}
                @if($Playground->is_active == 1)
                  {!! Form::hidden( 'status', 0 ) !!}
                  {!! Form::submit('Deactivate', ['class' => 'btn btn-danger btn-flat  pull-right']) !!}
                @elseif ($Playground->is_active == 0)
                  {!! Form::hidden( 'status', 1 ) !!}
                  {!! Form::submit('Activate', ['class' => 'btn btn-success btn-flat pull-right']) !!}
                @endif
              {!! Form::close() !!}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="list-group list-group-unbordered displayDetails">
                <li class="list-group-item">
                  	<b>Total Events Count</b>
                  	<a class="pull-right badge">{{ $Playground->playgroundEvents()->count() }}</a>
                </li>

                <li class="list-group-item">
                    <b>Total Challenges Count</b>
                    <a class="pull-right badge">{{ $Playground->playgroundEvents()->count() }}</a>
                </li>

                <li class="list-group-item">
                    <b>Playground Gallary</b>
                    @if ($Playground->Photos()->count() > 0)
                      <a class="pull-right badge">{{ $Playground->Photos()->count() }}</a>
                      <br>
                      <div>
                        @foreach ($Playground->Photos as $Photo)
                          <span style="margin: 10px">
                            <img class="img img-thumbnail" width="100" 
                                src="{{ Storage::url($Photo->path) }}" alt=""
                            >
                          </span>
                            
                        @endforeach
                      </div>
                      
                    @else
                      <b class="pull-right badge">No Photos for This Playground !!</b>
                    @endif
                </li>
              </ul>
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i>  Phone</strong>
  
              <p class="text-muted">
              	<span class="displayDetails">{{ $Playground->c_b_p_phone }}</span>
              </p>
              <hr>
              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> Location</strong>

              <p class="displayDetails text-muted">
              	{{ $Playground->country->c_en_name }}, {{ $Playground->city->g_en_name }} {{ $Playground->area->a_en_name }}, 
              </p>
              <p class="displayDetails text-muted">
                {{ $Playground->c_b_p_address }}, 
              </p>
              <!---->
              <hr>
			
            <div class="col-lg-2 editDetails" style="display:none;" >
              <div id="loader"
              class="text-center "
              style="display: none;z-index: 99999;font-size: 10px;color: #3c8dbc;"
              >
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
              </div>
            </div>
	        <div class="clearfix"></div>
          <!---->

            <strong>
              <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
              features
            </strong>
            <p class="displayDetails">
              @if($Playground->feature1 === 1)
                <span class="badge" style="background: #4CAF50;">feature1</span>
              @endif
              @if($Playground->feature2 === 1)
                <span class="badge" style="background: #4CAF50;">feature2</span>
              @endif
              @if($Playground->feature3 === 1)
                <span class="badge" style="background: #4CAF50;">feature3</span>
              @endif
              @if($Playground->feature4 === 1)
                <span class="badge" style="background: #4CAF50;">feature4</span>
              @endif
              @if($Playground->feature5 === 1)
                <span class="badge" style="background: #4CAF50;">feature5</span>
              @endif
              @if($Playground->feature6 === 1)
                <span class="badge" style="background: #4CAF50;">feature6</span>
              @endif
              @if($Playground->feature7 === 1)
                <span class="badge" style="background: #4CAF50;">feature7</span>
              @endif
              @if($Playground->feature8 === 1)
                <span class="badge" style="background: #4CAF50;">feature8</span>
              @endif
              @if($Playground->feature9 === 1)
                <span class="badge" style="background: #4CAF50;">feature9</span>
              @endif
              @if($Playground->feature10 === 1)
                <span class="badge" style="background: #4CAF50;">feature10</span>
              @endif

            </p>
            <div class="clearfix"></div>
            <!---->
            <hr>
            <div class="clearfix"></div>
            <!---->
            <strong>
              <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
              Price Per Hour
            </strong>
            <p class="displayDetails">{{$Playground->c_b_p_price_per_hour}}</p>
            <div class="clearfix"></div>
            <!---->
            <hr>
            <div class="clearfix"></div>
            <!---->

            <strong>
              <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
              Sport
            </strong>
            <p class="displayDetails">{{$Playground->Sport->en_sport_name}}</p>
            <div class="clearfix"></div>
            <!---->
            <hr>
            <!---->
            <div class="clearfix"></div>
            <!---->

            <strong>
              <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
              Description
            </strong>
            <p class="displayDetails">{{$Playground->c_b_p_desc}}</p>
            <div class="clearfix"></div>
            <!---->
            <hr>
            <!---->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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

        <!-- Modal -->
            <div class="modal fade" id="calendar{{ $Playground->id }}" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $Playground->c_b_p_name }}</h4>
                  </div>
                  <div class="box box-primary">
                    <div class="box-body no-padding">
                      <div class="modal-body">
                        <p>
                          <span class="btn btn-flat" style="color:#fff; background: #00a65a">by Player</span>
                          <span class="btn btn-flat" style="color:#fff; background: #dd4b39">by Owner</span>
                          <span class="btn btn-flat" style="color:#fff; background: #ff851b">by Admin</span>
                          <span class="btn btn-flat" style="color:#fff; background: #0073b7">by Manager</span>
                        </p>
                        <div class="row">
                          <div class="col-md-7">
                            <div id="Reservations{{$Playground->id}}"></div>
                          </div>
                         <div class="col-md-4" style="background: #EEE; border: 1px solid #ddd;">
                            <h3>New Reservation</h3><br><br>

                            <p id="{{$Playground->id}}_err" class="alert"></p>
                            <!-- start add reservation form -->
                            <form class="form-horizontal our-form"
                              action="{{url('Reservation')}}/{{$Playground->id}}/Add"
                              method="post"
                              role="form"
                            >
                                {{ csrf_field() }}
                              <input type="hidden" name="playgroundId" value="{{$Playground->id}}">
                              <div class="form-group">
                                <label class="col-lg-3 control-label">Date</label>
                                <div class="col-lg-8">
                                  <input 
                                    id="{{$Playground->id}}_date" 
                                    type="date" class="date" 
                                    name="{{$Playground->id}}_date" 
                                    min="@php
                                          echo date("Y-m-d") ;
                                        @endphp" class="date form-control input-xs">
                                </div>
                              </div>
                              <div class="hours" style="">
                                @php
                                  $hours = DB::table('hours')->get();
                                @endphp
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">From</label>
                                  <div class="col-lg-8">
                                      <select id="{{$Playground->id}}_from" name="{{$Playground->id}}_from" class="date form-control input-xs">
                                          <option value="">{{ trans('club.starts_at') }}</option>
                                        @foreach ($hours as $hour)
                                          <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                                        @endforeach

                                      </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-3 control-label">To</label>
                                  <div class="col-lg-8">
                                      <select id="{{$Playground->id}}_to" name="{{$Playground->id}}_to" class="date form-control input-xs">
                                          <option value="">{{ trans('club.ends_at') }}</option>
                                        @foreach ($hours as $hour)
                                          <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                                        @endforeach

                                      </select>
                                  </div>
                                </div>

                                <div id="{{$Playground->id}}_nameDiv" class="form-group" style="display: none">
                                  <label class="col-lg-3 control-label">Name</label>
                                  <div class="col-lg-8">
                                      <input  id="{{$Playground->id}}_name"
                                              name="{{$Playground->id}}_name" 
                                              type="text" 
                                              class="form-control input-xs" 
                                              required="required"
                                      >
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                      <input 
                                        type="submit" 
                                        class="submit btn btn-md btn-flat btn-primary" 
                                        style="display: none;"
                                        value="Add"
                                        name ="{{$Playground->id}}_add"
                                        id ="{{$Playground->id}}_add" 
                                      >
                                      <span class="reCheckLoader pull-right" style="display:none;color: #367fa9 ;">
                                        <i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>
                                      </span>
                                  </div>
                                </div>
                          
                              
                              </div>
                            </form>
                            <!-- start add reservation form -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
        <!-- endModel -->

    </section>

  <!------ End Profile Content ------------->
@endsection
