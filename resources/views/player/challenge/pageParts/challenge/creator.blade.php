<div>
	<div class="panel panel-default shade top-bottom-border">

      <!--------------------->
      <div class="panel-heading text-center shade bottom-border">
        <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Challenge_Creator') }}</h4>
      </div>
        <a href="{{url('/')}}/profile/{{sm_crypt($challenge->creator->id)}}">
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
	    </a>
      <!--------------------->
      <div class="text-center">
				<h4>{{ $challenge->creator->name }}</h4>
				<span>
					@if ( $challenge->C_YesOrNo == 1 ) {{-- if event candidate exist --}}

						@if ( $challenge->C_JQueryTo < date("Y-m-d H:i:s") ) {{-- if event date is in past --}}
							@php 
								$creatorRateCount=willvincent\Rateable\Rating::where('user_id', $challenge->candidate->id)
																															->where('rateable_id', $challenge->creator->playerProfile->id)
																															->where('rateablein_id', $challenge->id)
																															->where('rateablein_type', 'App\Model\Challenge')
																															->count() 
							@endphp
								
								@if ($creatorRateCount > 0)
									@php 
										$creatorRate=willvincent\Rateable\Rating::where('user_id', $challenge->candidate->id)
																																	->where('rateable_id', $challenge->creator->playerProfile->id)
																																	->where('rateablein_id', $challenge->id)
																																	->where('rateablein_type', 'App\Model\Challenge')
																																	->first() 
									@endphp	
									<span>
										@for ($i = 0; $i < 5; $i++)
											@if (round($creatorRate->rating) > $i)
												<i style="color:#ffb300" class="fa fa-star"  aria-hidden="true"></i>
											@else
												<i style="color:#9e9e9e" class="fa fa-star"  aria-hidden="true"></i>
											@endif
										@endfor
									</span>

								@else
									@if ( Auth::id() == $challenge->candidate->id)
										<span style="font-size:15px;cursor:pointer" data-toggle="modal" data-target="#RatePlayerModal">
											<img src="{{ url('/') }}/player/icons/review.png" width="30px" >
										</span>
									@else
										{{trans('player.no_rate_given')}}
									@endif {{-- if Auth::id is cretor->id --}}
								@endif
							
						@endif {{-- if event date is in past --}}
					@endif {{-- if event candidate exist --}}
      	</span>
      </div>

    </div> <!-- .panel -->
</div> 