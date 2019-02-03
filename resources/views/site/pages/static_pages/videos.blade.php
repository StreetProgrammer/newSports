@extends('site.themeIndex')
@section('content')

@yield('content')

<section id="content">
    <section class="players-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="separator" style="height: auto;margin:3px ">
                        <div class="shade" style="background:#ffffff;padding: 20px;">
                            <article id="post-122" class="post-122 page type-page status-publish hentry">
                                <div class="post-wrap">
                                    <h1 class="entry-title">{{ trans('player.Visual_Information') }}</h1>
                                    <div class="post-content entry-content">
										<h3 class="entry-title">{{ trans('player.how_to_register') }}</h3>
										<div class="row">
											<div class="col-md-8 col-md-offset-2 text-center">
												<video style="width:100%" controls >
													<source src="{{ Storage::url('/media/videos/RegisterVideo.mp4')}}" type="video/mp4">
													Your browser does not support the video tag.
												</video>  
											</div>
										</div>
                                    </div>
                                </div><!-- /.post-wrap -->
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>


@endsection

@section('page_specific_scripts')
	<!-- search cripts-->
    <script src="{{ url('/') }}/player/js/playerSearch.js"></script>
    <script src="{{ url('/') }}/player/js/playgroundSearch.js"></script>
    <script src="{{ url('/') }}/player/js/inputRange.js"></script>
    <!-- search cripts-->
@stop