@if ( $challenge->C_YesOrNo == 1 ) {{-- if event candidate accept the challenge --}}

	@if ( $challenge->C_JQueryTo > date("Y-m-d H:i:s") ) {{-- if event date is in past --}}

		@if ( empty($challenge->C_reservation) ) {{-- if event reservation not exist --}}

			@if (Auth::user()->id == $challenge->C_creator_id || Auth::user()->id == $challenge->C_candidate_id)		


<div>
	<div class="panel panel-default shade top-bottom-border">
      <!--------------------->
        <div class="panel-heading text-center shade bottom-border">
            <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Suggested_Playgrounds') }}</h4>
            {{ trans('player.Desc_All_Suggested_Sport_Playgrounds') }}
        </div>
{{------------------------------------------------------------}}
<!--------------->
	    <div class="panel-body scrollable" style="height:250px !important;">
			<div class="row">
@if ($challenge->expectedPlaygrounds->count() > 0) {{-- start if suggested palay ground is > 0--}}

	@foreach ($challenge->expectedPlaygrounds as $playground)<!-- for loop throw each Playground for golf -->

     <!--if for know if play Playground in suggested-->

        @php
            $ReservationCase_1 = DB::table('reservations')->where('R_playground_id', '=' , $playground->id)
                                ->where('R_date', '=' , $challenge->C_date)
                                ->whereBetween('R_from', [$challenge->C_from, (($challenge->C_to) - 1)])->get();

            $ReservationCase_2 = DB::table('reservations')->where('R_playground_id', '=' , $playground->id)
                                ->where('R_date', '=' , $challenge->C_date)
                                ->whereBetween('R_to', [(($challenge->C_from) + 1), $challenge->C_to, ])->get();

            $ReservationCase_3 = DB::table('reservations')->where('R_playground_id', '=' , $playground->id)
                                ->where('R_date', '=' , $challenge->C_date)
                                ->where('R_to', '>', $challenge->C_to)
                                ->where('R_from', '<', $challenge->C_from)->get();
        @endphp


        @if ($ReservationCase_1->count() != 0 || $ReservationCase_2->count() != 0 || $ReservationCase_3->count() != 0)

        @else
        	<div class="col-md-6">
        
              <div class=" shade-2 text-center" 
                   style="border: 1px solid #ddd;
                          background: #ececec;
                          margin:5px 5px 5px 5px;"
              >
                <a href="{{url('/')}}/Playground/{{sm_crypt($playground->id)}}" class="a-holding-divs" >
                  <div class="" style="padding:5px 0px 0px 0px;">
                    <div class="">
                      <div class="">
                        <!-- <div class="green_icon"></div> -->
                        <div class="" style="height: 100px;width: 100%;overflow-y: hidden;">
                          <img class="shade"
                                style="width:100%;"
                                @if (empty($challenge->playground->user_img))
                                  src="{{ url('/') }}/player/img/football-playground.jpg"
                                  
                                @else
                                  src="{{ Storage::url($playground->user_img) }}"
                                @endif class="user-image" alt="User Image" alt="" 
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
                <h3 style="color:#06774a;font-size:13px !important;padding-top: 0px !important;">
                  <span>{{ $playground->c_b_p_name }}</span>
                  <!--if for know if Playground near Event creator address-->
                  @if ($playground->c_b_p_city == Auth::user()->playerProfile->p_city && $playground->c_b_p_area == Auth::user()->playerProfile->p_area)
                  <span>
                    <i class="fa fa-map-marker" style="color:#ffb300;"></i>
                  </span>
                  @endif
                </h3>
                  {{-- used to if Auth is creator --}}
                    {{-- now will check if no candidate and event date still in future --}}

				{{----------------------------------------}}
				@php
					if ($ReservationCase_1->count() != 0 || $ReservationCase_2->count() != 0 || $ReservationCase_3->count() != 0) {
                            $PlaygroundReservationStatus = 1 ;
                        }else {
                            $PlaygroundReservationStatus = 0 ;
                        }
				@endphp
				

				 <li class="list-group-item "
                @if ($PlaygroundReservationStatus == 1 && $playground->id != $challenge->C_playground_id)
                    style="background:#fdcccc;"
                @elseif ($PlaygroundReservationStatus == 1 && $playground->id == $challenge->C_playground_id)
                    style="background:#cddc397d;"
                @endif
        >
                    <div class="" style="min-height: 45px;">
                        <p class="" style="color: #ff5522;font-size: 80%;">
                        	by:
                            @php
                                if($playground->expectedEvents->chosenBy == $challenge->C_creator_id){
                                    $chooser = $challenge->creator ;
                                }elseif ($playground->expectedEvents->chosenBy == $challenge->C_candidate_id) {
                                    $chooser = $challenge->candidate ;
                                }
                            @endphp
                             {{ $chooser->name }}
                        </p>

                            @if ( $chooser->id != Auth::id() )
                              <p>
                                   @if ($playground->expectedEvents->yesOrno == 0)

                    								<span class="a-holding-divs AcceptRejectPlayground" 
              			            	      style="color:#ffb300;font-size:10px;cursor:pointer;"
              			            	      id="{{ $challenge->id }}_{{ $playground->id }}_1_playground" 
              				            	>
            				                    <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
            				                </span>
                    								<span id="{{ $challenge->id }}_{{ $playground->id }}_ARPlaygroundLoader" 
                    								      style="display:none">
            				                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:15px"></i>
            				                </span>
            				                <span class="a-holding-divs AcceptRejectPlayground" 
                			            	      style="color:#ffb300;font-size:10px;cursor:pointer;"
                			            	      id="{{ $challenge->id }}_{{ $playground->id }}_2_playground" 
                				            >
            				                    <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
            				                </span>
                                                       
                                  @elseif ($playground->expectedEvents->yesOrno == 1)
                                    <span class="a-holding-divs" 
              				            	      style="color:#00C853;font-size:10px;" 
              				            	>
                    				            <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
                    				        </span>
                                  @elseif ($playground->expectedEvents->yesOrno == 2)
                                  	<span class="a-holding-divs" 
			            	                       style="color:#D50000;font-size:10px;" 
              				            	>
                    				            <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
                    				        </span>
                                  @endif
                              </p>
                            @elseif ( $chooser->id == Auth::id() )
					                    <p>
                                @if ($playground->expectedEvents->yesOrno == 0)
                                    <p style="font-size:95%;color:#06774a;">
                                        No decision Yet
                                    </p>
                                @elseif ($playground->expectedEvents->yesOrno == 1)
							                      <span class="a-holding-divs" 
			            	                      style="color:#00C853;font-size:10px;" 
			            	                >
			                                <i class="fa fa-thumbs-up fa-2x" aria-hidden="true"></i>
			                            </span>
                                @elseif ($playground->expectedEvents->yesOrno == 2)
                                  <span class="a-holding-divs" 
			            	                    style="color:#D50000;font-size:10px;" 
			            	              >
			                              <i class="fa fa-thumbs-up fa-rotate-180 fa-2x" ></i>
			                            </span>
                                @endif
					                    </p>
                            @endif
                         	
                             @if (Auth::id() == $challenge->C_creator_id && $challenge->C_playground_id == 0 && $playground->expectedEvents->yesOrno == 1 && $PlaygroundReservationStatus == 0)
                                 <form method="POST" action="{{url('Reservation')}}/{{$playground->id}}/Add">
                                     {{ csrf_field() }}
                                     <input type="hidden" name="R_event_id" value="{{ $challenge->id }}">
                                     <input type="hidden" name="R_creator_id" value="{{ $challenge->C_creator_id }}">
                                     <input type="hidden" name="R_date" value="{{ $challenge->C_date }}">
                                     <input type="hidden" name="R_day" value="{{ $challenge->C_day }}">
                                     <input type="hidden" name="R_from" value="{{ $challenge->C_from }}">
                                     <input type="hidden" name="R_to" value="{{ $challenge->C_to }}">
                                     <input type="hidden" name="R_JQueryFrom" value="{{ $challenge->C_JQueryFrom }}">
                                     <input type="hidden" name="R_JQueryTo" value="{{ $challenge->C_JQueryTo }}">

                                    <input type="submit" class="btn btn-primary btn-xs" value="GO">

                                 </form>

                             @endif
                       

                    </div>
                </li>

				{{------------------------------------------}}


              </div>
          </div>
                
        @endif





    

	@endforeach<!-- for loop throw each Playground for golf -->
@else
	<div class="text-center">
	    <div class="col-md-12" style="padding: 70px 0px;">
	        <span class="shade" style="font-size: 15px;color:#000;padding:40px;background:#eee">
                {{ trans('player.no_Suggested_Playground') }}
	        </span>
	    </div>
	</div>
@endif{{-- end if suggested playground is > 0--}}
		    </div> <!-- /.row-->
		</div>
	<!---------------->
{{------------------------------------------------------------}}
	</div> <!---/.panel--->
</div> <!--- /div --->







 




		
			@endif {{-- end if Auth == E_creator or E_candidate --}}

		@endif {{-- here if  end if reservation is empty --}}

	@endif{{-- if event date is in past --}}

@endif {{-- end if !empty($challenge->C_candidate) --}}

