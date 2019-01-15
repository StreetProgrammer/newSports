<nav class="notify-nav" >
@auth
    {{-- auth player nav --}}
  <div class="container">

    <ul>
      {{-- <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-globe"></i>
        </a>
        <div class="dropdown-menu" style="display: none;right:1px;">                
          <div class="text-center">
            <a class="a-holding-divs" style="color:#06774a !important" href="{{url('/')}}/lang/en">EN</a>
          </div>
          <div class="text-center">
            <a class="a-holding-divs" style="color:#06774a !important" href="{{url('/')}}/lang/ar">AR</a>
          </div>
        </div>
      </li> --}}
      {{-- <li>
        <a href="{{ url('/') }}/lang/{{direction() == 'ltr' ? 'ar' : 'en'}}">
        <i class="fa fa-globe"> {{direction() == 'ltr' ? 'ع' : 'EN'}}</i>
        </a>
      </li> --}}
      {{-- <li> | </li> --}}
      <li><a href="{{ url('/') }}/search"><i class="fa fa-search"></i></a></li> 
      <li> | </li>
      <li>
        <a href="{{ url('/') }}/profile/{{sm_crypt(Auth::id())}}">
          <!-- <i class="fa fa-user"></i> -->
          <img style="width: 25px;"
            @if (empty(Auth::user()->user_img))
              src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
            @else
              src="{{ Storage::url(Auth::user()->user_img) }}"
            @endif class="user-image" alt="User Image" alt=""
          >
        </a>
      </li> 
      <li> | </li>
      <li><a href="{{ url('/') }}/logout"><i class="fa fa-sign-out"></i> {{ trans('player.logout') }}</a></li>
    </ul>
  </div>
{{-- auth player nav --}}
@else
{{-- visitor nav --}}
  <div class="container">
    <ul>
      {{-- <li><i class="fa fa-search"></i></li>  --}}
      {{-- <li> | </li> --}}
      <li>
        <a href="{{ url('/') }}/login"
            class="sm-inputs"
            style="border: 1px solid #ddd;
                    border-radius:25px;
                    background: orange !important;
                    box-shadow: 1px 0px 1px #eee;
                    font-size: 15px;
                    color: #fff !important;
                    padding: 0 5px 0 5px;"
        >
        {{ trans('player.login') }} <i class="fa fa-sign-in"></i>
      </a>
      </li>
      <li>
        <a href="register" 
          class="sm-inputs"
          style="border: 1px solid #ddd;
                  border-radius:25px;
                  background: orange !important;
                  box-shadow: 1px 0px 1px #eee;
                  font-size: 15px;
                  color: #fff !important;
                  padding: 0 5px 0 5px;"
        >
          <i class="fa fa-user-plus"></i> {{ trans('player.register') }}
        </a>
      </li>--
      --<li>
        <a href="#" 
          data-toggle="modal" 
          data-target="#RegisterAs" 
          class="sm-inputs"
          style="border: 1px solid #ddd;
                  border-radius:25px;
                  background: orange !important;
                  box-shadow: 1px 0px 1px #eee;
                  font-size: 15px;
                  color: #fff !important;
                  padding: 0 5px 0 5px;"
        >
          <i class="fa fa-user-plus"></i> {{ trans('player.register') }}
        </a>
      </li>
    </ul>
  </div>
{{-- visitor nav --}}

@endauth

</nav>

@guest()
  {{----}}
    <!-- Modal -->
  <div class="modal fade" id="RegisterAs" role="dialog" style="">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div> -->
        <!-- <div class="modal-body"> -->
          <div class="panel panel-default" style="margin-bottom: 0px">
                <div class="panel-heading" style="color: #fff;background-color: #06774a !important;">
                  {{ trans('player.You_will_Register_As') }}  
                  <button type="button" class="close" data-dismiss="modal" style="color:#fff">&times;</button>
                </div>
                    <div class="panel-body">
                    {{ Form::open(['url' => url('handlepreregister'), 'method' => 'GET', 'class' => 'form-horizontal our-form'])}}
                   <!--  <form class="form-horizontal our-form" method="POST" action="{{ route('register') }}">
                       {{ csrf_field() }} -->

                        
                        <div class="text-center form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <!-- <label for="type" class="col-md-4 control-label">Type</label> -->

                            <div class="col-md-12">

                                <div class="radio">
                                    <label>
                                        <input type="radio" value="1" name="type" checked="checked">
                                        {{ trans('player.Player') }}  
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" value="2" name="type">
                                        {{ trans('player.Club') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center form-group">
                            <div class="col-md-12">
                                <button class="btn sm-btn"
                                        style="background: #ff9800 !important;
                                                color: #fff !important;
                                                border-color: #ddd;
                                                box-shadow: 1px 0px 0px #eee;"
                                        type="submit" 
                                        class="">
                                   {{ trans('player.register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      </div>
    </div>
  </div>
{{----}}
@endguest
