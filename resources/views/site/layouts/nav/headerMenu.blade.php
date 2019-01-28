<nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
      <div class="container">
        <div class="navbar-header">
          <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>
          <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ Storage::url(setting()->logo) }}" width="150px ;height:auto">
          </a>
        </div>
       <div id="navbarCollapse" class="collapse navbar-collapse"> 
      @auth
        <!-- Collection of nav links, forms, and other content for toggling -->
        <div id="notiPlace">
          @include('site.layouts.nav.noti')
        </div>
         

      @endauth
            <ul class="nav navbar-nav navbar-right">
              {{-- <li class="active"><a href="{{ url('/') }}">{{ trans('player.Home') }}</a></li> --}}
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ trans('player.Sports') }}<b class="caret"></b></a>   

                <div class="row dropdown-menu mega-menu" ">
                  @php
                    $sports = \App\Model\Sport::all() ;
                  @endphp
                  
                  @foreach ($sports as $sport)
                <a class="a-holding-divs" href="{{ url('/') }}/Sport/{{ sm_crypt($sport->id) }}" style="color:#fff;">
                    <div class="col-xs-12 text-center">
                      <div class="sport-menu" style="padding: 5px 0px;">
                        @if ( direction() == 'ltr' )
                            {{$sport->en_sport_name}}
                        @else
                            {{$sport->ar_sport_name}}
                        @endif
                        
                      </div>
                    </div>
                  </a>
                  @endforeach
              </li>
              <li><a href="{{url('/')}}/search/player">{{ trans('player.Players') }}  </a></li>
              {{-- <li><a  href="{{url('/')}}/search/playground">{{ trans('player.Courts') }}</a></li> --}}
              <li>
                <a href="{{ url('/') }}/lang/{{direction() == 'ltr' ? 'ar' : 'en'}}">
                <i class="fa fa-globe"> {{direction() == 'ltr' ? 'ع' : 'EN'}}</i>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    {{direction() == 'ltr' ? 'How To..' : 'كيف يمكن ...'}}
                  <b class="caret"></b>
                </a>   

                <div class="row dropdown-menu mega-menu" ">
                  <a class="a-holding-divs" href="{{ url('/') }}/faq" style="color:#fff;">
                    <div class="col-xs-12 text-center">
                      <div class="sport-menu" style="padding: 5px 0px;">
                        {{direction() == 'ltr' ? 'FAQ' : 'الاسئله الشائعه'}}
                      </div>
                    </div>
                  </a>
                  <a class="a-holding-divs" href="{{ url('/') }}/contactus" style="color:#fff;">
                    <div class="col-xs-12 text-center">
                      <div class="sport-menu" style="padding: 5px 0px;">
                        {{direction() == 'ltr' ? 'Contact Us' : 'تواصل معنا'}}
                      </div>
                    </div>
                  </a>
                  {{--
                  <a class="a-holding-divs" href="{{ url('/') }}/Sport/{{ sm_crypt($sport->id) }}" style="color:#fff;">
                    <div class="col-xs-12 text-center">
                      <div class="sport-menu" style="padding: 5px 0px;">
                        {{direction() == 'ltr' ? 'Videos' : 'فيديو'}}
                      </div>
                    </div>
                  </a>
                  --}}
              </li>
            </ul>
    
        </div>
      </div>
    
  </nav>