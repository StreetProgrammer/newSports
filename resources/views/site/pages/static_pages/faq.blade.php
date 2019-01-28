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
                                    <h1 class="entry-title">FAQ</h1>
                                    <div class="post-content entry-content">
                                        <p class="question">Is SportsMate an online game ?</p>
                                        <p class="answer">
                                            No. SportsMate is a website that you can join to help you find friends who play the same sports as you.
                                        </p>
                                        <br>
                                        <p class="question">Is SportsMate a club ?</p>
                                        <p class="answer">
                                            No. SportsMate is an online website for you to make new friends to play your favorite sports                                        </p>
                                        <br>
                                        <p class="question">How do I sign up ?</p>
                                        <p class="answer">
                                            Its free . You sign in online through the link on the main page.                                        </p>
                                        <br>
                                        <p class="question">Is there any membership fees ?</p>
                                        <p class="answer">
                                            No. SportsMate is free.                                        </p>
                                        <br>
                                        <p class="question">Is SportsMate a tournament ?</p>
                                        <p class="answer">
                                            no SportsMate is an online website to help you make friends to play tournaments in real life                                        </p>
                                        <br>
                                        <p class="question">How do I make friends/add friends ?</p>
                                        <p class="answer">
                                            Once you have filled out your profile the next step is to search Players. Click on the Players icon you will get a list of all Players. When you click on a name, you will see their profile. Under their name and picture is the icon for Create challenge. This will show that person that you are inviting them to play a match. You will then get diverted to a screen where you can chose the date and time. Your new friend will receive this invitation in their inbox and can accept or decline this Challenge (Match). Once accepted , a chat box will appear where you can communicate further any details .                                        </p>
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