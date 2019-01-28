@extends('site.themeIndex')
@section('content')

@yield('content')
<style>

/*

HOW TO CREATE AN VIDEO PLAYER [TUTORIAL]

"How to create an Video Player [Tutorial]" was specially made for DesignModo by our friend Valeriu Timbuc.

Links:
http://vtimbuc.net/
https://twitter.com/vtimbuc
http://designmodo.com
http://vladimirkudinov.com

*/

/* Reset CSS */
.mejs-inner,
.mejs-inner div,
.mejs-inner a,
.mejs-inner span,
.mejs-inner button {
	margin: 0;
	padding: 0;
	border: none;
	outline: none;
}

/* Video Container / General Styles */
.mejs-container {
	position: relative;
	background: #000000;
}

.mejs-inner {
	position: relative;
	width: inherit;
	height: inherit;
}

.me-plugin { position: absolute; }

.mejs-container-fullscreen .mejs-mediaelement,
.mejs-container-fullscreen video,
.mejs-embed,
.mejs-embed body,
.mejs-mediaelement {
	width: 100%;
	height: 100%;
}

.mejs-embed,
.mejs-embed body {
	margin: 0;
	padding: 0;
	overflow: hidden;
}

.mejs-container-fullscreen {
	position: fixed;
	left: 0;
	top: 0;
	right: 0;
	bottom: 0;
	overflow: hidden;
	z-index: 1000;
}

.mejs-poster img { display: block; }

.mejs-background,
.mejs-mediaelement,
.mejs-poster,
.mejs-overlay {
	position: absolute;
	top: 0;
	left: 0;
}

.mejs-overlay-play { cursor: pointer; }

.mejs-inner .mejs-overlay-button {
	position: absolute;
	top: 50%;
	left: 50%;
	width: 50px;
	height: 50px;
	margin: -25px 0 0 -25px;
	background: url(/storage/media/imgs/play.png) no-repeat;
}

/* Controls Container */
.mejs-container .mejs-controls {
	position: absolute;
	width: 100%;
	height: 34px;
	left: 0;
	bottom: 0;
	background: rgb(0,0,0); /* IE8- */
	background: rgba(0,0,0, .7);
}

/* Controls Buttons */
.mejs-controls .mejs-button button {
	display: block;
	cursor: pointer;
	width: 16px;
	height: 16px;
	background: transparent url(/storage/media/imgs/controls.png);
}

/* Play & Pause Button */
.mejs-controls div.mejs-playpause-button {
	position: absolute;
	top: 12px;
	left: 15px;
}

.mejs-controls .mejs-play button,
.mejs-controls .mejs-pause button {
	width: 12px;
	height: 12px;
	background-position: 0 0;
}

.mejs-controls .mejs-pause button { background-position: 0 -12px; }

/* Mute & Unmute */
.mejs-controls div.mejs-volume-button {
	position: absolute;
	top: 12px;
	left: 45px;
}

.mejs-controls .mejs-mute button,
.mejs-controls .mejs-unmute button {
	width: 14px;
	height: 12px;
	background-position: -12px 0;
}

.mejs-controls .mejs-unmute button { background-position: -12px -12px; }

/* Full-Screen Button */
.mejs-controls div.mejs-fullscreen-button {
	position: absolute;
	top: 7px;
	right: 7px;
}

.mejs-controls .mejs-fullscreen-button button,
.mejs-controls .mejs-unfullscreen button {
	width: 27px;
	height: 22px;
	background-position: -26px 0;
}

.mejs-controls .mejs-unfullscreen button { background-position: -26px -22px; }

/* Volume Slider */
.mejs-controls div.mejs-horizontal-volume-slider {
	position: absolute;
	cursor: pointer;
	top: 15px;
	left: 65px;
}

.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
	width: 60px;
	background: #d6d6d6;
}

.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	position: absolute;
	width: 0;
	top: 0;
	left: 0;
}

.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	height: 4px;

	-webkit-border-radius: 2px;
	-moz-border-radius: 2px;
	border-radius: 2px;
}

/* Progress Bar */
.mejs-controls div.mejs-time-rail {
	position: absolute;
	width: 100%;
	left: 0;
	top: -10px;
}

.mejs-controls .mejs-time-rail span {
	position: absolute;
	display: block;
	cursor: pointer;
	width: 100%;
	height: 10px;
	top: 0;
	left: 0;
}

.mejs-controls .mejs-time-rail .mejs-time-total {
	background: rgb(152,152,152); /* IE8- */
	background: rgba(152,152,152, .5);
}

.mejs-controls .mejs-time-rail .mejs-time-loaded {
	background: rgb(0,0,0); /* IE8- */
	background: rgba(0,0,0, .3);
}

.mejs-controls .mejs-time-rail .mejs-time-current { width: 0; }

/* Progress Bar Handle */
.mejs-controls .mejs-time-rail .mejs-time-handle {
	position: absolute;
	cursor: pointer;
	width: 16px;
	height: 18px;
	top: -3px;
	background: url(/storage/media/imgs/handle.png);
}

/* Progress Bar Time Tooltip */
.mejs-controls .mejs-time-rail .mejs-time-float {
	position: absolute;
	display: none;
	width: 33px;
	height: 23px;
	top: -26px;
	margin-left: -17px;
	background: url(/storage/media/imgs/tooltip.png);
}

.mejs-controls .mejs-time-rail .mejs-time-float-current {
	position: absolute;
	display: block;
	left: 0;
	top: 4px;

	font-family: Helvetica, Arial, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #666666;
	text-align: center;
}

.mejs-controls .mejs-time-rail .mejs-time-float-corner { display: none; }

/* Green Gradient (for progress and volume bar) */
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
	background: #82d344;
	background: -webkit-linear-gradient(top, #82d344 0%, #51af34 100%);
	background: -moz-linear-gradient(top, #82d344 0%, #51af34 100%);
	background: -o-linear-gradient(top, #82d344 0%, #51af34 100%);
	background: -ms-linear-gradient(top, #82d344 0%, #51af34 100%);
	background: linear-gradient(top, #82d344 0%, #51af34 100%);
}


</style>
<section id="content">
    <section class="players-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="separator" style="height: auto;margin:3px ">
                        <div class="shade" style="background:#ffffff;padding: 20px;">
                            <article id="post-138" class="post-138 page type-page status-publish hentry">
                                <div class="post-wrap">
                                    <h1 class="entry-title">Privacy Policy</h1>
                                    <div class="post-content entry-content">
                                        <p>Privacy Policy</p>
                                        {{--------------}}
                                        <div id="mep_0" class="mejs-container mejs-video" style="width: 640px; height: 267px;">
                                            <div class="mejs-inner">
                                                <div class="mejs-mediaelement">
                                                    <video poster="{{ Storage::url('media/imgs/cars.png') }}" src="{{ Storage::url('media/videos/cars.mp4') }}" width="640" height="267">
                                                        <source src="{{ Storage::url('media/videos/cars.mp4') }}" type="video/mp4">
                                                    </video>
                                                </div>
                                            <div class="mejs-layers">
                                                <div class="mejs-poster mejs-layer" style="width: 640px; height: 267px;">
                                                    <img src="{{ Storage::url('media/imgs/cars.png') }}" width="100%" height="100%">
                                                </div>
                                                <div class="mejs-overlay mejs-layer" style="display: none; width: 640px; height: 267px;">
                                                    <div class="mejs-overlay-loading">
                                                        <span></span>
                                                    </div></div>
                                                    <div class="mejs-overlay mejs-layer" style="display: none; width: 640px; height: 267px;">
                                                        <div class="mejs-overlay-error"></div>
                                                    </div>
                                                    <div class="mejs-overlay mejs-layer mejs-overlay-play" style="width: 640px; height: 267px;">
                                                        <div class="mejs-overlay-button"></div>
                                                    </div>
                                                </div>
                                                <div class="mejs-controls" style="display: block; visibility: visible;">
                                                    <div class="mejs-button mejs-playpause-button mejs-play">
                                                        <button type="button" aria-controls="mep_0" title="Play/Pause"></button>
                                                    </div>
                                                    <div class="mejs-time-rail" style="width: 640px;">
                                                        <span class="mejs-time-total" style="width: 640px;">
                                                            <span class="mejs-time-loaded" style="width: 639.723px;">
                                                            </span>
                                                            <span class="mejs-time-current" style="width: 0px;"></span>
                                                            <span class="mejs-time-handle" style="left: -8px;"></span>
                                                            <span class="mejs-time-float" style="display: none;">
                                                                <span class="mejs-time-float-current">00:00</span>
                                                                <span class="mejs-time-float-corner"></span>
                                                            </span>
                                                        </span>
                                                    </div>
                                                    <div class="mejs-button mejs-volume-button mejs-mute">
                                                        <button type="button" aria-controls="mep_0" title="Mute Toggle"></button>
                                                    </div><div class="mejs-horizontal-volume-slider mejs-mute">
                                                        <div class="mejs-horizontal-volume-total"></div>
                                                        <div class="mejs-horizontal-volume-current" style="width: 48px;"></div>
                                                        <div class="mejs-horizontal-volume-handle" style="left: 18px;"></div>
                                                    </div>
                                                    <div class="mejs-button mejs-fullscreen-button">
                                                        <button type="button" aria-controls="mep_0" title="Fullscreen"></button>
                                                    </div>
                                                </div>
                                                <div class="mejs-clear"></div>
                                            </div>
                                        </div>
  
                                        {{--------------}}
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
{{----------}}

{{----------}}
@endsection

@section('page_specific_scripts')
	<!-- search cripts-->
    <script type="text/javascript" src="{{ url('/') }}/themeFiles/js/libs/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="{{ url('/') }}/js/video_player.js"></script>
    <!-- search cripts-->
@stop