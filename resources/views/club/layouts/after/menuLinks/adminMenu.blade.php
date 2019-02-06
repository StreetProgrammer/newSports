<ul class="sidebar-menu" data-widget="tree">

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