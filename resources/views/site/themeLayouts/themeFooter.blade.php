<!-- End Content -->
	<footer id="footer" style="background: #fafcfc !important;color:#000;border-top: 1px solid #ddd;">
		<div class="footer3" style="background: #dddddd3d;">
			<div class="footer-top3">
				<div class="container">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="footer-box3">
								<h2 class="title30 font-bold" style="color: #06774a;">{{ trans('player.Follow_us') }}</h2>
								<div class="social-network">
									<a href="https://www.facebook.com/SportsmateEgypt/" class="float-shadow">
										<img src="{{ url('/') }}/themeFiles/images/icon/icon-fb.png" alt="">
									</a>
									{{--<a href="#" class="float-shadow">
										<img src="{{ url('/') }}/themeFiles/images/icon/icon-tw.png" alt="">
									</a>--}}
									<a href="https://www.instagram.com/sports.mate/" class="float-shadow">
										<img src="{{ url('/') }}/themeFiles/images/icon/icon-ig.png" alt="">
									</a>
									{{-- <a href="#" class="float-shadow"><img src="{{ url('/') }}/themeFiles/images/icon/icon-gp.png" alt=""></a>
									<a href="#" class="float-shadow"><img src="{{ url('/') }}/themeFiles/images/icon/icon-pt.png" alt=""></a> --}}
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="footer-box3">
								<h2 class="title30 font-bold" style="color: #06774a;">{{ trans('player.About_SportsMate') }}</h2>
								<p class="desc">
									{{ trans('player.about_sm') }}
								</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="footer-box3">
								<h2 class="title30 font-bold" style="color: #06774a;">{{ trans('player.Contact_Us') }}</h2>
								<div class="row">
									<form action="">
										{{ csrf_field() }}
									<div class="col-md-6">
										
										<div class="form-group">
										{{-- <label for="name">{{ trans('player.Name') }} :</label> --}}
										<input type="text" 
												name="message_name" 
												class="sm-inputs form-control"
												style="padding: 0 5px 0 5px;"
												placeholder="{{ trans('player.Name') }}" 
												id="name" 
												value=""
										>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											{{-- <label for="email">{{ trans('player.Email_address') }} :</label> --}}
											<input type="email" 
													name="message_email" 
													class="sm-inputs form-control"
													style="padding: 0 5px 0 5px;"
													placeholder="{{ trans('player.Email_address') }}"  
													value=""
										>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											{{-- <label for="subject">{{ trans('player.subject') }} :</label> --}}
											<input type="text" 
													name="message_subject" 
													class="sm-inputs form-control"
													style="padding: 0 5px 0 5px;"
													placeholder="{{ trans('player.subject') }}" 
													id="subject" 
													value=""
										>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											{{-- <label for="message">{{ trans('player.message') }} :</label> --}}
											<textarea id="message_message"
													class="sm-inputs form-control"
													style="padding: 0 5px 0 5px;"
													rows="5"
													placeholder="{{ trans('player.message') }}" 
													value=""
											></textarea>
										</div>
									</div>
								</div>

									<button 
										type="button"
										style="background:orange"
										class="btn btn-success sm-round-btn orange"
										id="sendemail" 
									>
									{{ trans('player.Send') }}
									<span id="sendemailLoader" style="display:none;">
										<i class="fa fa-circle-o-notch fa-spin"></i>
									</span>
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Footer Top -->
			<div class="footer-bottom3">
				<div class="container">
					{{--<div class="brand-slider brand-slider3">
						<div class="wrap-item" data-pagination="false" data-autoplay="true" data-itemscustom="[[0,2],[480,3],[768,4],[990,5]]">
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br1.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br2.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br3.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br4.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br5.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br1.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br2.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br3.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br4.png" alt="" /></a>
							</div>
							<div class="item-brand">
								<a href="#" class="pulse-grow"><img src="{{ url('/') }}/themeFiles/images/home/home1/br5.png" alt="" /></a>
							</div>
						</div>
					</div>--}}
					<!-- End List Brand -->
					<div class="policy-payment3">
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<ul class="text-left text-uppercase list-inline-block term-policy">
									<li><a href="{{url('/')}}/privacy_policy" class="color">Privacy Policy</a></li>
									<li><a href="{{url('/')}}/social_media_disclosure" class="color">Social Media Disclosure</a></li>
									<li><a href="{{url('/')}}/terms_of_service" class="color">Term and Conditions</a></li>
								</ul>
								
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<p class="desc copyright3 text-right">
									Copyright © {{\Illuminate\Support\Carbon::now()->year}} 
									<a href="{{url('/')}}" style="color:#06774a;"> SportsMate.net</a>
									 - All Rights Reserved.
								</p>

								<div class="payment-method ">
									{{--<a href="#" class="wobble-top"><img src="{{ url('/') }}/themeFiles/images/icon/pay1.png" alt=""></a>
									<a href="#" class="wobble-top"><img src="{{ url('/') }}/themeFiles/images/icon/pay2.png" alt=""></a>
									<a href="#" class="wobble-top"><img src="{{ url('/') }}/themeFiles/images/icon/pay3.png" alt=""></a>
									<a href="#" class="wobble-top"><img src="{{ url('/') }}/themeFiles/images/icon/pay4.png" alt=""></a>--}}
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->
	<div class="wishlist-mask">
		<div class="wishlist-popup">
			<span class="popup-icon color"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
			<p class="wishlist-alert">"Fruit Product" was added to wishlist</p>
			<div class="wishlist-button">
				<a href="#">Continue Shopping (<span class="wishlist-countdown">10</span>)</a>
				<a href="#">Go To Shopping Cart</a>
			</div>
		</div>
	</div>
	<!-- End Wishlist Mask -->
	<a href="#" class="scroll-top round"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a>
	<div id="loading">
		<div id="loading-center">
			<div id="loading-center-absolute">
				<div class="object" id="object_four"></div>
				<div class="object" id="object_three"></div>
				<div class="object" id="object_two"></div>
				<div class="object" id="object_one"></div>
			</div>
		</div>
	</div>
	<!-- End Preload -->
	<div class="col-md-4" style="position: fixed;bottom: 30px;">
		<div class="text-center alert alert-danger" id="contactError" style="display: none;">
			{{ trans('player.message_sent_error') }}
		</div>
		<div class="text-center alert alert-success" id="contactSuccess" style="display: none;">
			{{ trans('player.message_sent_successfully') }}
		</div>
	</div>
</div>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/bootstrap.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery.fancybox.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery-ui.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/owl.carousel.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery.jcarousellite.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery.elevatezoom.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/slick.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/modernizr.custom.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery.hoverdir.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/popup.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/timecircles.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/wow.js"></script>
<script type="text/javascript" src="{{ url('/') }}/themeFiles/js/theme.js"></script>
<script type="text/javascript" src="{{ url('/') }}/player/js/sendEmail.js"></script>
</body>

{{-- start old footer scripts --}}
<!----end--------->
    {{-- <script src="{{ url('/') }}/player/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.3/jquery.flexslider-min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="{{ url('/') }}/player/js/custom.js"></script>
    <script src="{{ asset('js/croppie.js') }}"></script>
    @auth
     <script src="{{ asset('js/noti.js') }}"></script>   
    @endauth
    <!-- fullCalendar -->
    <script src="{{ url('/') }}/design/AdminLTE/bower_components/moment/moment.js"></script>
    <script src="{{ url('/') }}/design/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>

    @include('player.layouts.SM-player-fullCalender.playground-calender')

    {{-- // start for load js file only for this page --}}
    @yield('page_specific_scripts') 
	{{-- // end for load js file only for this page --}}
	{{-- end old footer scripts --}}

<!-- Mirrored from demo.7uptheme.com/html/fruitshop/home-03.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Nov 2018 12:44:40 GMT -->
</html>