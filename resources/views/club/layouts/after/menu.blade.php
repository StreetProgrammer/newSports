<div class="navbar-custom-menu">
  <ul class="nav navbar-nav">
    @can('Owner-only', Auth::user())
      <!-- Notifications: style can be found in dropdown.less -->
      <!-- Notifications: style can be found in dropdown.less -->
      @include('club.layouts.after.noti')
      <!-- Tasks: style can be found in dropdown.less -->
    @endcan
     <!-- User Account: style can be found in dropdown.less -->
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-globe"></i>
        <span class="hidden-xs"> </span>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{ aurl('lang/ar') }}"><i class="fa fa-flag"></i> عربى</a></li>
        <li><a href="{{ aurl('lang/en') }}"><i class="fa fa-flag"></i> English</a></li>
      </ul>
    </li>
    <!-- Control Sidebar Toggle Button -->

    <!-- User Account: style can be found in dropdown.less -->
    @if (Auth::check())
      <!-- show logged in navbar -->
    @else
      <!-- show logged out navbar -->
    @endif
    <li class="dropdown user user-menu">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <img id="updateable-2"  
            @if (empty(Auth::user()->user_img))
              src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
            @else
              src="{{ Storage::url(Auth::user()->user_img) }}"
            @endif class="user-image" alt="User Image"
        >
        <span class="hidden-xs">{{ Auth::user()->name }}</span>
      </a>
      <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header">
          <img id="updateable-3"
              @if (empty(Auth::user()->user_img))
                src="{{ url('/') }}/design/AdminLTE/dist/img/user4-128x128.jpg"
              @else
                src="{{ Storage::url(Auth::user()->user_img) }}"
              @endif class="img-circle" alt="User Image">

          <p>
            {{ Auth::user()->name }} - {{ trans('admin.adminLevel') }}
            <small>{{ trans('admin.MemberSince') }} {{ Auth::user()->created_at }}</small>
          </p>
        </li>
        <!-- Menu Body -->
        <!-- <li class="user-body">
          <div class="row">
            <div class="col-xs-4 text-center">
              <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
              <a href="#">Friends</a>
            </div>
          </div>
          /.row
        </li> -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="pull-left">
            <a href="{{ url('/club/' . Auth::user()->slug . '/profile' ) }}" class="btn btn-default btn-flat">
              {{ trans('admin.Profile') }}
            </a>
          </div>
          <div class="pull-right">
            <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">{{ trans('admin.SignOut') }}</a>
          </div>
        </li>
      </ul>
    </li>

    <!-- Control Sidebar Toggle Button -->
    {{--
    <li>
      <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
    </li>
    --}}
  </ul>
</div>