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
                                    <h1 class="entry-title">Contact Us</h1>
                                    <div class="post-content entry-content">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="" style="">
                                                    <div class="text-center alert alert-danger" id="contactError_page" style="display: none;">
                                                        {{ trans('player.message_sent_error') }}
                                                    </div>
                                                    <div class="text-center alert alert-success" id="contactSuccess_page" style="display: none;">
                                                        {{ trans('player.message_sent_successfully') }}
                                                    </div>
                                                </div>
                                                <br>
                                                <form action="">
                                                    {{ csrf_field() }}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" id="name" name="message_name_page" class="sm-inputs form-control"style="padding: 0 5px 0 5px;" placeholder="{{ trans('player.Name') }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="message_email_page" class="sm-inputs form-control" style="padding: 0 5px 0 5px;" placeholder="{{ trans('player.Email_address') }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <input type="text" name="message_subject_page" id="subject" class="sm-inputs form-control" style="padding: 0 5px 0 5px;" placeholder="{{ trans('player.subject') }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea id="message_message_pages" class="sm-inputs form-control" style="padding: 0 5px 0 5px;" rows="5" placeholder="{{ trans('player.message') }}" ></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" style="background:orange" class="btn btn-success sm-round-btn orange" id="sendemail_page" >
                                                            {{ trans('player.Send') }}
                                                            <span id="sendemailLoader_page" style="display:none;">
                                                                <i class="fa fa-circle-o-notch fa-spin"></i>
                                                            </span>
                                                        </button>
                                                    </div>
                                                </form>
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