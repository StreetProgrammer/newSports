@extends('site.themeIndex')
@section('content')

@yield('content')
    {{--------------------------------------------------------------------}}
<section class="courts-main players-main">
  {{ csrf_field() }}
  <div class="container" style="font-size:80%;">

{{--     <div class="row">
      
      <!----------- start challenge result section -------------->
      <div class="col-md-9" id="countdown">

        @include('player.challenge.pageParts.challenge.countdown')

      </div> <!-- end challenge result-->

    </div><!-- .row--> --}}

    <div class="row">
      
      <!----------- start challenge result section -------------->
      <div class="col-md-9" id="challenge-result">

        @include('player.challenge.pageParts.challenge.challenge-result')

      </div> <!-- end challenge result-->
        
       <!----------- start  challenge-winner section -------------->
      <div class="col-md-3" id="challenge-winner">

        @include('player.challenge.pageParts.challenge.challenge-winner')

      </div>
      <!----------- end  challenge-winner section -------------->


      </div><!-- .row-->


{{-- /////////////////////////// start hide playgrounds for now /////////////////// --}}
    {{-- <div class="row">
       <!----------- start challenge creator section -------------->
      <div class="col-md-7" id="challenge-sport-playgrounds">

        @include('player.challenge.pageParts.challenge.challenge-sport-playgrounds')

      </div>
      <!----------- end challenge creator section -------------->

      <!----------- start challenge-details section -------------->
      <div class="col-md-5" id="expected-playgrounds">

        @include('player.challenge.pageParts.challenge.expected-playgrounds')

      </div> <!-- end challenge details-->
        
    </div><!-- .row--> --}}
{{-- /////////////////////////// ends hide playgrounds for now /////////////////// --}}
    
    <div class="row">
       <!----------- start challenge creator section -------------->
      <div class="col-md-3" id="creator">

        @include('player.challenge.pageParts.challenge.creator')

      </div>
      <!----------- end challenge creator section -------------->

      <!----------- start challenge-details section -------------->
      <div class="col-md-6" id="challenge-details">

        @include('player.challenge.pageParts.challenge.challenge-details')

      </div>
        

      </div><!-- end challenge details-->
      <!----------- end challenge-details section -------------->

      <!----------- start candidate players -------------->
      <div class="col-md-3" id="candidate">
         
        @include('player.challenge.pageParts.challenge.candidate')

      </div><!-- end challenge details-->
      <!----------- end candidate players -------------->

    </div><!--end row--->

     <div class="row">
      
      <!----------- start candidate players -------------->
      {{-- <div class="col-md-4" id="candidate-1">
         
        @include('player.challenge.pageParts.challenge.candidate')

      </div> --}}<!-- end challenge details-->
      <!----------- end candidate players -------------->

       <!----------- start challenge applicants section -------------->
      {{-- <div class="col-md-8" id="applicants">

        @include('player.challenge.pageParts.challenge.applicants')

      </div> --}} <!-- col-md-8 -->
      <!----------- end challenge applicants section -------------->

    </div><!--end row--->

    
  </div><!--end container--->
</section>
    {{--------------------------------------------------------------------}}
        @include('player.challenge.pageParts.challenge.Models')
    {{------------------------------------------------------------------------}}

        {{----------------------------- chat part---------------------------------------}}
@if (Auth::id() == $challenge->C_candidate_id || Auth::id() == $challenge->C_creator_id)
  @if ($challenge->C_YesOrNo == 1)
  <div class="chat-widget-wrapper">
    <div class="chat-widget-container">
      <div class="chat-widget-text">
        <p class="heading">{{trans('player.live_chat')}}</p>
        <p>{{trans('player.chat_with')}}</p>
      </div>
      <div class="chat-widget-avatar">

        <img 
          @if(Auth::id() == $challenge->C_creator_id)
            @if (empty($challenge->candidate->user_img))
              src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
            @else
              src="{{ Storage::url($challenge->candidate->user_img) }}"
            @endif class="user-image"
          @elseif(Auth::id() == $challenge->C_candidate_id)
            @if (empty($challenge->creator->user_img))
              src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
            @else
              src="{{ Storage::url($challenge->creator->user_img) }}"
            @endif class="user-image"
          @endif
        />

      </div>
    </div>
    <div class="chat-box-container">
      {{-- <div class="chat-box-nav">
      </div> --}}
      <div class="chat-box-content">
        <iframe style="height:300px;"
            @if(Auth::id() == $challenge->C_creator_id)
              src="https://dry-harbor-39693.herokuapp.com/chat.html?ser=&type=d&user={{$challenge->creator->name}}&match=challenge_{{$challenge->id}}"
            @elseif(Auth::id() == $challenge->C_candidate_id)
              src="https://dry-harbor-39693.herokuapp.com/chat.html?ser=&type=d&user={{$challenge->candidate->name}}&match=challenge_{{$challenge->id}}"
            @endif
        >
        </iframe>
      </div>
    </div>
  </div>
  @endif
@endif



    {{----------------------------- chat part---------------------------------------}}


@endsection

@section('page_specific_scripts')
    <!-- challenge cripts-->
    <script src="{{ url('/') }}/player/js/challenge.js"></script>
    <!-- challenge cripts-->
@stop