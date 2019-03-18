@extends('admin.index')
@section('content')

<!------ start Profile Content---------->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Club Profile
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Club profile</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
							<img class="profile-user-img img-responsive img-circle" 
										@if (empty($User->user_img))
											src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
										@else
											src="{{ Storage::url($User->user_img) }}"
										@endif 
										alt="{{ $User->name }}"
							>
              <h3 class="profile-username text-center">{{ $User->name }}</h3>

              <p class="text-muted text-center">User - Club</p>
              <p class="text-muted text-center">
	              Member since  @php  echo date('d-m-Y', strtotime($User->created_at)) ; @endphp
	          </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Branches</b> <a class="pull-right">{{ $User->clubBranches()->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Playgrounds</b> <a class="pull-right">{{ $User->clubPlaygrounds()->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Reservations</b> <a class="pull-right">{{ $User->clubReservation()->count() }}</a>
								</li>
								<li class="list-group-item">
                  <b>Users</b> <a class="pull-right">{{ $User->clubProfile->users()->count() }}</a>
                </li>
              </ul>

                    {!! Form::open(['url' => aurl('Club/changeActivationStatus/'), 'method' => 'POST']) !!}
                    {!! Form::hidden( 'target', $User->id ) !!}
                    @if($User->our_is_active == 1)
                        {!! Form::hidden( 'status', 0 ) !!}
                        {!! Form::submit('Deactivate', ['class' => 'btn btn-danger btn-block']) !!}
                    @elseif ($User->our_is_active == 0)
                        {!! Form::hidden( 'status', 1 ) !!}
                        {!! Form::submit('Activate', ['class' => 'btn btn-success btn-block']) !!}
                    @elseif ($User->our_is_active == 2)
                    	<div class="text-center">
                    		{!! Form::hidden( 'status', 1 ) !!}
	                        {!! Form::submit('Accept', ['class' => 'btn btn-success']) !!}
	                        <span class="btn btn-danger" 
	                        		data-toggle="modal" 
	                        		data-target="#RejectMessage"
	                        >
	                    		Reject
	                    	</span>
                    	</div>
                    @elseif ($User->our_is_active == 3)
                    	<div class="text-center">
	                    	<span class="badge" style="padding: 10px 10px;font-size: 13px;">
	                    		<i class="fa fa-warning margin-r-5" ></i>
	                    		rejected Account
	                    	</span> 
	                    	<span class="btn btn-danger" 
		                        		data-toggle="modal" 
		                        		data-target="#DeleteRejectedAccountModal"
		                        >
		                    		Delete
		                    </span>
		                </div>
                    @endif

                    {!! Form::close() !!}

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


        </div>

		 <div class="col-md-8">
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">About {{$User->name}} Club</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-phone custom"></i></i>  Phone</strong>

              <p class="text-muted">
              {{ $User->clubProfile->c_phone }}
              </p>

              <hr>

              <strong><i class="fa fa-envelope custom"></i></i>  Eamil</strong>

              <p class="text-muted">
								{{ $User->email }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

              <p class="text-muted">
              	{{ $User->clubProfile->country->c_en_name }},
                {{ $User->clubProfile->governorate->g_en_name }}
                {{ $User->clubProfile->area->a_en_name }}
              </p>

              <hr>

              <strong><i class="fa fa-sitemap margin-r-5"></i> Branches</strong>

              <p>
              	@foreach ($User->clubBranches as $branch)

									<span class="label {{ randomClasses() }}">
										<a href="{{ aurl('/') }}/branch/{{$branch->id}}" style="color:#fff">
											{{$branch->c_b_name}}
										</a>
									</span>   
									<span class="label label-success badge label-warning pull-right">{{$branch->branchPlaygrounds->count()}}</span>
									<ul>
										@forelse ($branch->branchPlaygrounds as $court)

											<span class="label label-success ">
												<a href="{{ aurl('/') }}/playgrounds/{{$court->id}}" style="color:#fff">
													{{$court->c_b_p_name}}
												</a>
											</span>
										@empty
											<span class="label" style="background-color: #2c3b41 !important">
												No Courts Found
											</span>
										@endforelse
									</ul>
									
			     			@endforeach

              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>

              <p>{{ $User->clubProfile->c_desc }}</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

      </div>
      <!-- /.row -->

    </section>

  <!------ End Profile Content ------------->

  <!-- start Reject club Modal -->
	<div id="RejectMessage" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="background: #d9534f;color: #fff;">
	        <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
	        <h4 class="modal-title">reject reason</h4>
	      </div>
	      <div class="modal-body">
	        <p>please write the reason of reject the club account in details </p>
	        {!! Form::open(['url' => aurl('Club/changeActivationStatus/'), 'method' => 'POST']) !!}
            {!! Form::hidden( 'target', $User->id ) !!}
            {!! Form::textarea('rejectReason',null,['class'=>'form-control', 'rows' => 4, 'cols' => 40]) !!}
	      </div>
	      <div class="modal-footer">
	      	{!! Form::hidden( 'status', 3 ) !!}
	        {!! Form::submit('Send', ['class' => 'btn btn-danger']) !!}
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        {!! Form::close() !!}
	      </div>
	    </div>

	  </div>
	</div>
 <!-- end Reject club Modal -->
 <!-- start Delete Rejected club Modal -->
	<div id="DeleteRejectedAccountModal" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header" style="background: #d9534f;color: #fff;">
	        <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
	        <h4 class="modal-title">reject reason</h4>
	      </div>
	      <div class="modal-body">
	        <p>please write the reason of reject the club account in details </p>
	        {!! Form::open(['url' => aurl('Club/changeActivationStatus/'), 'method' => 'POST']) !!}
            {!! Form::hidden( 'target', $User->id ) !!}
	      </div>
	      <div class="modal-footer">
	      	{!! Form::hidden( 'status', 3 ) !!}
	        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        {!! Form::close() !!}
	      </div>
	    </div>

	  </div>
	</div>
 <!-- end Delete Rejected club Modal -->
@endsection
