<span class="mainInfoLoader" style="position:absolute;bottom:50%;left:50%;
						transform:translate(-50%, -20%);
						-ms-transform:translate(-50%, -20%);
						color:white;font-size:16px;border:none;
						cursor:pointer;font-size:10px;color:#3c8dbc;
						z-index: 1;display: none"
>
	<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
</span>
          <!-- plygrounds Box -->
<div class="box box-primary mainBranchInfo">
  <div class="box-header with-border">
		<h3 class="box-title"> 
			<span style="color:#3c8dbc;font-weight: bold;">
				{{$clubBranche->c_b_name}}
			</span> 
			Playgrounds
		</h3>
		<span id="showHidePlaygrounds-ooo" class=" pull-right" style="font-size: 15px; color: #3c8dbc;cursor: pointer;position: relative;">
			{{$clubBranche->branchPlaygrounds->count()}} Playground Till Now
			<i class="fa fa-plus-square" aria-hidden="true"></i>
		</span>
		<div class="displayAble" style="display:none;font-size: 15px; color: #fff;position: absolute;left: 25px;bottom: 25px; background: #0e0e0e82;border-radius: 5px;padding: 1px 5px;">
				<span style="font-size: 10px;">Add New Playground</span>
		</div>
  </div><!-- /.box-header -->
  <div class="box-body">

		<div class="displayPlaygroundsDetails">
			<!-- start filpable div -->
			<div class="row">

				<ul id="playlist-1" style="list-style-type: none;">
				@foreach ($clubBranche->branchPlaygrounds as $playground)

					<div class="sura text-center col-md-3 col-sm-4 col-xs-6 " >
								<div class="panel panel-default" style="border: 2px solid #3c8dbc;">
										<div class="back"> 
												<p>
												<a class="play sura_link" href="{{url('/playground/club/')}}/{{$playground->id}}">
														name
														{{ $playground->c_b_p_name }}
													</a>
												</p>
												<p>
													<a class="sura_link" href="#">
														
														sport {{ $playground->sport->en_sport_name }}
													</a>
												</p>
										</div>
										<div class="front">
											<img id="branchLogoPlaceholder" class="displayCamIcon img img-rounded" width="100"
														src="{{empty($playground->c_b_p_logo) ?  url('/') . '/player/img/counter.png' :  Storage::url($playground->c_b_p_logo) }}"
														alt="Court Photo"
											>
												<i class=""></i>
										</div>
								</div>
						</div>

				@endforeach   
				</ul>

			</div><!-- end filpable div -->
		</div>   
	</div><!-- /.box-body -->
</div><!-- /.box -->