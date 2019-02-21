@if ( $challenge->C_YesOrNo == 1 ) {{-- if challenge candidate accept challenge --}}

	@if ( $challenge->C_date < date("Y-m-d") ) {{-- if challenge date is in past --}}

		{{-- @if ( empty($challenge->C_reservation) ) --}} {{-- if challenge reservation not exist --}}

		    {{-- @if (Auth::user()->id == $challenge->C_creator_id || Auth::user()->id == $challenge->C_candidate_id) --}}		

<div>
	<div class="panel panel-default shade top-bottom-border">

      <!--------------------->
	    <div class="panel-heading text-center shade bottom-border">
	        <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Challenge_winner') }}</h4>
		</div>

		<div class="panel-body">
			@if ( !empty($challenge->C_winer_id) )
				@if ($challenge->C_winer_id == $challenge->C_creator_id)
						<a href="#">
						<div class="profile-img-container text-center" style="padding: 25px 0px 0px 0px;">
							<div class="d-flex justify-content-center h-100">
								<div class="image_outer_container">
									<!-- <div class="green_icon"></div> -->
									<div class="image_inner_container">
										<img class="shade"
													style="height: 100px;width: 100px;border:5px solid #06774ad4;"
													@if (empty($challenge->creator->user_img))
														src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
													@else
														src="{{ Storage::url($challenge->creator->user_img) }}"
													@endif class="user-image" alt="User Image" alt=""
										>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center" 
							 style="color: #ffc107;
							        font-size: 50px;
							        position: relative;
							        bottom: 50px;
							        height: 10px;"
						>
							<i class="fa fa-trophy" aria-hidden="true"></i>
						</div>
					</a>
					<div class="text-center">
						<h4>{{ $challenge->creator->name }}</h4>
					</div>
				@elseif($challenge->C_winer_id == $challenge->C_candidate_id)
					<a href="#">
						<div class="profile-img-container text-center" style="padding: 25px 0px 0px 0px;">
							<div class="d-flex justify-content-center h-100">
								<div class="image_outer_container">
									<!-- <div class="green_icon"></div> -->
									<div class="image_inner_container">
										<img class="shade"
													style="height: 100px;width: 100px;border:5px solid #06774ad4;"
													@if (empty($challenge->candidate->user_img))
														src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
													@else
														src="{{ Storage::url($challenge->candidate->user_img) }}"
													@endif class="user-image" alt="User Image" alt=""
										>
									</div>
								</div>
							</div>
						</div>
						<div class="text-center" 
							 style="color: #ffc107;
							        font-size: 50px;
							        position: relative;
							        bottom: 50px;
							        height: 10px;"
						>
							<i class="fa fa-trophy" aria-hidden="true"></i>
						</div>
					</a>
					<div class="text-center">
						<h4>{{ $challenge->creator->name }}</h4>
					</div>
				@elseif($challenge->C_winer_id == -10)
					<a href="#">
						<div class="profile-img-container text-center" style="padding: 25px 0px 0px 0px;">
							<div class="d-flex justify-content-center h-100">
								<div class="image_outer_container">
									<!-- <div class="green_icon"></div> -->
									<div class="image_inner_container">
										<img class="shade"
											style="height: 100px;width: 100px;border:5px solid #06774ad4;"
											src="{{ url('/') }}/player/img/qMark.jpeg"
											class="user-image" alt="Winner Image" alt=""
										>
									</div>
								</div>
							</div>
						</div>
					</a>
				@endif
			@else
				<a href="#">
					<div class="profile-img-container text-center" style="padding: 25px 0px 0px 0px;">
						<div class="d-flex justify-content-center h-100">
							<div class="image_outer_container">
								<!-- <div class="green_icon"></div> -->
								<div class="image_inner_container">
									<img class="shade"
										style="height: 100px;width: 100px;border:5px solid #06774ad4;"
										src="{{ url('/') }}/player/img/qMark.jpeg"
										class="user-image" alt="Winner Image" alt=""
									>
								</div>
							</div>
						</div>
					</div>
				</a>
			@endif
			
			
		</div>
        
    </div> <!-- .panel -->
</div> 



		
			{{--@endif--}}  {{-- end if Auth == E_creator or E_candidate --}}

		{{-- @endif --}} {{-- here if  end if reservation is empty --}}

	@endif{{-- if challenge date is in past --}}

@endif {{-- end if challenge candidate accept challenge --}}