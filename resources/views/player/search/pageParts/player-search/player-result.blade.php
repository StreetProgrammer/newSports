{{-- <div class="panel panel-default shade"> --}}
	<div class="panel panel-default shade top-bottom-border">
		<div class="panel-heading text-center shade bottom-border">
		  <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Player_search_result') }}</h4>
		</div>
		<div class="scroll" style="background-color: #fff; height: 500px;overflow-y: scroll;margin-bottom: 20px">
		@if ($players->count() > 0)
			@foreach ($players as $player)
				<div class="col-sm-3 col-xs-6 text-center">
					<a class="a-holding-divs" href="{{ url('/') }}/profile/{{sm_crypt($player->id)}}">
						<div class="Player shade border-20" style="border: 1px solid #ffa500;margin: 5px 0px;">
							<div class="row">
								<div class="col-md-4">
									<div class="profile-img-container text-center" style="padding: 5px 0px 0px 0px;">
										<div class="d-flex justify-content-center h-100">
											<div class="image_outer_container">
											<!-- <div class="green_icon"></div> -->
												<div class="image_inner_container">
													<img class="shade" 
														style="height: 50px;
																width: 50px;
																border: 2px solid #f89406;" 
														@if (empty($player->user_img))
														src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
														@else
														src="{{ Storage::url($player->user_img) }}"
														@endif
													>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-8">
									<div style="margin-bottom: 10px">
										<h3 style="padding-top: 5px !important;
												margin-bottom: 5px !important;
												font-size: 12px"
										>
											{{$player->name}}
										</h3>
										<p style="font-family: 'Roboto', sans-serif;font-size: 12px;">
											{{-- <span>Intermediate</span> / 
											<span>19 Matches</span> --}}
										</p>
										<p style="font-size:11px;">
											<i class="fa fa-map-marker"></i>
											@if (!empty( $player->playerProfile->p_country ))
											  @if (direction() == 'ltr')
												{{$player->playerProfile->country->c_en_name}} 
											  @else
												{{$player->playerProfile->country->c_ar_name}} 
											  @endif
											@endif
									
											@if (!empty( $player->playerProfile->p_city ))
											  @if (direction() == 'ltr')
												, {{$player->playerProfile->governorate->g_en_name}} 
											  @else
												, {{$player->playerProfile->governorate->g_ar_name}} 
											  @endif
											@endif
									
											
											@if (!empty( $player->playerProfile->p_area ))
											  @if (direction() == 'ltr')
												, {{$player->playerProfile->area->a_en_name}}
											  @else
												, {{$player->playerProfile->area->a_ar_name}}
											  @endif
											@endif
											
										  </p>
										<span>
											@for ($i = 0; $i < 5; $i++)
												@if (round($player->playerProfile->averageRating) > $i)
													<i style="color:#ffb300" class="fa fa-star"  aria-hidden="true"></i>
												@else
													<i style="color:#9e9e9e" class="fa fa-star"  aria-hidden="true"></i>
												@endif
											@endfor
										</span>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			@endforeach
		@else
			<div class="row text-center">
				<div class="col-md-12 text-center" style="padding: 70px;">
					<span class="shade" style="font-size: 20px;color:#06774a;padding: 40px;">
						{{ trans('player.no_result_match_your_search') }}
					</span>
				</div>
			</div>
		@endif
		
		</div>
	</div>
			