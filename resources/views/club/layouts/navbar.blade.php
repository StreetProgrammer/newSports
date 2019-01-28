  <header class="main-header">
    <!-- Logo -->
    <a href="{{ url('club') }}/{{Auth::user()->id}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sport Mate</b> Club</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      @include('club.layouts.menu')
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
            <img id="updateable-1" 
                @if (empty(Auth::user()->user_img))
                  src="{{ url('design/AdminLTE') }}/dist/img/admin.png"
                @else
                  src="{{ Storage::url(Auth::user()->user_img) }}"
                @endif
             class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <a href="{{ url('/club/' . Auth::user()->slug . '/profile' ) }}">
            <p>{{ Auth::user()->name }}</p>
          </a>
          <!--<a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
        </div>
      </div>
      <!-- search form -->
      {{--
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="{!! trans('club.navSearch') !!}">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
      --}}
      <!-- /.search form -->
      <hr style="border-top: 10px dotted #3c8dbc;margin: 5px 15px">
      <!-- sidebar menu: : style can be found in sidebar.less -->
    @can('Owner-only', Auth::user())
      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">{!! trans('club.mainNavigation') !!}</li> --}}
        <!------->
        <li class="  {{ makeActiveLinkActive()[0] }}">
          <a href="{{url('club')}}/{{Auth::user()->id}}" style="{{ makeActiveLinkActive()[2] }}">
            <i class="fa fa-dashboard"></i> <span>{!! trans('club.adminpanel') !!}</span>
          </a>
        </li>
        <!------->
        <!------->
        <li class="  {{ makeActiveLinkActive()[0] }}">
          <a href="{{url('/')}}/updateAllData" style="{{ makeActiveLinkActive()[1] }}">
            <i class="fa fa-edit"></i> <span>{!! trans('club.updateAllData') !!}</span>
          </a>
        </li>
        <!------->

        <!------->
        <li class="treeview {{ makeActiveLinkActive(['clubs','admins', 'players'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['clubs','admins', 'players'])[2] }}">
            <i class="fa fa-users"></i>
            <span>{!! trans('club.users') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('club/users/all') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allUsers') !!}
              </a>
            </li>
            <li>
              <a href="{{ url('club/users/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addUser') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------>
        
        <!------>
       <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
            <i class="fa fa-cubes"></i> <span>{!! trans('club.branches') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('branches/club') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allBranches') !!}
              </a>
            </li>
            <li>
              <a href="{{url('/')}}/updateAllData">
                <i class="fa fa-plus"></i> {!! trans('club.addBranch') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------->

        <!------>
       <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
            <i class="fa fa-cubes"></i> <span>{!! trans('club.playgrounds') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('playgrounds/club') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allPlaygrounds') !!}
              </a>
            </li>
            <li>
              <a href="{{url('/')}}/updateAllData">
                <i class="fa fa-plus"></i> {!! trans('club.addPlayground') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------->

        <!------>
          <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
            <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
              <i class="fa fa-cubes"></i> <span>{!! trans('club.reservations') !!}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{ makeActiveLinkActive(['reservations', 'clubs', 'players'])[1] }}">
              <li>
                <a href="{{ url('reservations/club') }}">
                  <i class="fa fa-circle-o"></i> {!! trans('club.allReservations') !!}
                </a>
              </li>
              <li>
                <a href="{{ url('reservations/club/create') }}">
                  <i class="fa fa-plus"></i> {!! trans('club.addReservation') !!}
                </a>
              </li>
            </ul>
          </li>
        <!------->

        <!------->
        <li class="treeview {{ makeActiveLinkActive(['settings','countries', 'governorates'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['settings','countries', 'governorates'])[2] }}">
            <i class="fa fa-cogs"></i>
            <span>{!! trans('club.settings') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['settings', 'countries', 'governorates'])[1] }}">
            <li class="{{ makeActiveLinkActive(['settings'])[0] }}">
              <a href="{{ aurl('settings') }}">
                <i class="fa fa-cog"></i> {!! trans('club.siteSettings') !!}
              </a>
            </li>
            <li class="{{ makeActiveLinkActive(['countries'])[0] }}">
              <a href="{{ aurl('countries') }}">
                <i class="fa fa-flag"></i> {!! trans('club.countries') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('countries/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addCountry') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('governorates') }}">
                <i class="fa fa-flag"></i> {!! trans('club.governoratesControl') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('areas') }}">
                <i class="fa fa-flag"></i> {!! trans('club.areasControl') !!}
              </a>
            </li>
           </ul>
        </li>
        <!------>
      </ul>
    @elsecan('Admin-only', Auth::user())
      <ul class="sidebar-menu" data-widget="tree">
        {{-- <li class="header">{!! trans('club.mainNavigation') !!}</li> --}}

        <li class="  {{ makeActiveLinkActive()[0] }}">
          <a href="{{url('club')}}/{{Auth::user()->club_id}}" style="{{ makeActiveLinkActive()[2] }}">
            <i class="fa fa-dashboard"></i> <span>{!! trans('club.adminpanel') !!}</span>
          </a>
        </li>
        <!------->
        <li class="treeview {{ makeActiveLinkActive(['clubs','admins', 'players'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['clubs','admins', 'players'])[2] }}">
            <i class="fa fa-users"></i>
            <span>{!! trans('club.users') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('club/users/all') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allUsers') !!}
              </a>
            </li>
            <li>
              <a href="{{ url('club/users/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addUser') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------>
        
        <!------>
       <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
            <i class="fa fa-cubes"></i> <span>{!! trans('club.branches') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('branches/club') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allBranches') !!}
              </a>
            </li>
            <li>
              <a href="{{ url('branches/club/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addBranch') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------->

        <!------>
       <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
            <i class="fa fa-cubes"></i> <span>{!! trans('club.playgrounds') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['admins', 'clubs', 'players'])[1] }}">
            <li>
              <a href="{{ url('playgrounds/club') }}">
                <i class="fa fa-circle-o"></i> {!! trans('club.allPlaygrounds') !!}
              </a>
            </li>
            <li>
              <a href="{{ url('playground/club/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addPlayground') !!}
              </a>
            </li>
          </ul>
        </li>
        <!------->

        <!------>
          <li class="treeview {{ makeActiveLinkActive(['events', 'challenges'])[0] }}">
            <a href="#" style="{{ makeActiveLinkActive(['events', 'challenges'])[2] }}">
              <i class="fa fa-cubes"></i> <span>{!! trans('club.reservations') !!}</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu" style="{{ makeActiveLinkActive(['reservations', 'clubs', 'players'])[1] }}">
              <li>
                <a href="{{ url('reservations/club') }}">
                  <i class="fa fa-circle-o"></i> {!! trans('club.allReservations') !!}
                </a>
              </li>
              <li>
                <a href="{{ url('reservations/club/create') }}">
                  <i class="fa fa-plus"></i> {!! trans('club.addReservation') !!}
                </a>
              </li>
            </ul>
          </li>
        <!------->

        <!------->
        <li class="treeview {{ makeActiveLinkActive(['settings','countries', 'governorates'])[0] }}">
          <a href="#" style="{{ makeActiveLinkActive(['settings','countries', 'governorates'])[2] }}">
            <i class="fa fa-cogs"></i>
            <span>{!! trans('club.settings') !!}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" style="{{ makeActiveLinkActive(['settings', 'countries', 'governorates'])[1] }}">
            <li class="{{ makeActiveLinkActive(['settings'])[0] }}">
              <a href="{{ aurl('settings') }}">
                <i class="fa fa-cog"></i> {!! trans('club.siteSettings') !!}
              </a>
            </li>
            <li class="{{ makeActiveLinkActive(['countries'])[0] }}">
              <a href="{{ aurl('countries') }}">
                <i class="fa fa-flag"></i> {!! trans('club.countries') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('countries/create') }}">
                <i class="fa fa-plus"></i> {!! trans('club.addCountry') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('governorates') }}">
                <i class="fa fa-flag"></i> {!! trans('club.governoratesControl') !!}
              </a>
            </li>
            <li>
              <a href="{{ aurl('areas') }}">
                <i class="fa fa-flag"></i> {!! trans('club.areasControl') !!}
              </a>
            </li>
           </ul>
        </li>
        <!------>
      </ul>
    @elsecan('Manager-only', Auth::user())
      @foreach (Auth::user()->playgrounds as $playground)
        <ul class="sidebar-menu" data-widget="tree">
          <li class="  {{ makeActiveLinkActive()[0] }}">
            <a href="{{url('club')}}/{{Auth::user()->club_id}}" style="{{ makeActiveLinkActive()[2] }}">
              <i class="fa fa-dashboard"></i> <span>{{$playground->c_b_p_name}}</span>
            </a>
          </li>
        </ul>
      @endforeach
    @endcan
      
    </section>
    <!-- /.sidebar -->
  </aside>
