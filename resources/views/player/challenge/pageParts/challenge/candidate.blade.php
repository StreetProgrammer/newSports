<div>
  
  <div class="panel panel-default shade top-bottom-border">

    <!--------------------->
    <div class="panel-heading text-center shade bottom-border"
          style=""
    >
      <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Challenge_Candidate') }}</h4>
    </div>
    <a href="{{url('/')}}/profile/{{sm_crypt($challenge->candidate->id)}}" >
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
    </a>
    <!--------------------->
    <div class="text-center">
      <h4>
          {{$challenge->candidate->name}} 
      </h4>
      {{--start candidate desien part--}}

      @if ( $challenge->creator->id != Auth::id() && $challenge->candidate->id == Auth::id() )
        <p>
           @if ($challenge->C_YesOrNo == 0)

            <span class="a-holding-divs AcceptRejectchallenge" 
                style="color:#ffb300;font-size:10px;cursor:pointer;"
                id="{{ $challenge->id }}_1_challenge" 
            >
                <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
            </span>
            <span id="{{ $challenge->id }}_ARChallengeLoader" 
                  style="display:none">
                <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
            </span>
            <span class="a-holding-divs AcceptRejectchallenge" 
                  style="color:#ffb300;font-size:10px;cursor:pointer;"
                  id="{{ $challenge->id }}_2_challenge" 
            >
                <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
            </span>
                               
          @elseif ($challenge->C_YesOrNo == 1)
            <span class="a-holding-divs" 
                  style="color:#00C853;font-size:10px;" 
            >
                <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
            </span>
          @elseif ($challenge->C_YesOrNo == 2)
            <span class="a-holding-divs" 
                   style="color:#D50000;font-size:10px;" 
            >
                <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
            </span>
          @endif
        </p>
      @elseif ( $challenge->creator->id == Auth::id() )
        <p>
          @if ($challenge->C_YesOrNo == 0)
              <p style="font-size:95%;color:#06774a;">
                  {{ trans('player.No_decision_Yet') }}
              </p>
          @elseif ($challenge->C_YesOrNo == 1)
              <span class="a-holding-divs" 
                    style="color:#00C853;font-size:10px;" 
              >
                <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
            </span>
          @elseif ($challenge->C_YesOrNo == 2)
            <span class="a-holding-divs" 
                  style="color:#D50000;font-size:10px;" 
            >
              <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
            </span>
          @endif
        </p>
      @endif

      {{--start candidate desien part--}}
      {{-- start rating part --}}
      <span>
					@if ( $challenge->C_YesOrNo == 1 ) {{-- if event candidate exist --}}

						@if ( $challenge->C_JQueryTo < date("Y-m-d H:i:s") ) {{-- if event date is in past --}}
							@php 
								$candidateRateCount=willvincent\Rateable\Rating::where('user_id', $challenge->creator->id)
																															->where('rateable_id', $challenge->candidate->playerProfile->id)
																															->where('rateablein_id', $challenge->id)
																															->where('rateablein_type', 'App\Model\Challenge')
																															->count() 
							@endphp
								
								@if ($candidateRateCount > 0)
									@php 
										$candidateRate=willvincent\Rateable\Rating::where('user_id', $challenge->creator->id)
																																	->where('rateable_id', $challenge->candidate->playerProfile->id)
																																	->where('rateablein_id', $challenge->id)
																																	->where('rateablein_type', 'App\Model\Challenge')
																																	->first() 
									@endphp	
									<span>
										@for ($i = 0; $i < 5; $i++)
											@if (round($candidateRate->rating) > $i)
												<i style="color:#ffb300" class="fa fa-star"  aria-hidden="true"></i>
											@else
												<i style="color:#9e9e9e" class="fa fa-star"  aria-hidden="true"></i>
											@endif
										@endfor
									</span>

								@else
									@if ( Auth::id() == $challenge->creator->id)
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
      {{-- start rating part --}}
    </div>
  </div>

</div>