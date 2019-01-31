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
                            <article id="post-138" class="post-138 page type-page status-publish hentry">
                                <div class="post-wrap">
                                    <h1 class="entry-title">{{ $title }}</h1>
                                    <div class="post-content entry-content">
                                        <p class="question">{{ trans('player.q1') }}</p>
                                        <p class="answer">
                                            {{ trans('player.a1') }}
                                        </p>
                                        <br>
                                        <p class="question">{{ trans('player.q2') }}</p>
                                        <p class="answer">
                                            {{ trans('player.a1') }}                                        
                                        </p>
                                        <br>
                                        <p class="question">{{ trans('player.q3') }}</p>
                                        <p class="answer">
                                            {{ trans('player.a3') }}                                        
                                        </p>
                                        <br>
                                        <p class="question">{{ trans('player.q4') }}</p>
                                        <p class="answer">
                                            {{ trans('player.q4') }}                                        
                                        </p>
                                        <br>
                                        <p class="question">{{ trans('player.q5') }}</p>
                                        <p class="answer">
                                            {{ trans('player.a5') }}                                       
                                        </p>
                                        <br>
                                        <p class="question">{{ trans('player.q6') }}</p>
                                        <p class="answer">
                                            {{ trans('player.a6') }}
                                        </p>
                                        <br>
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