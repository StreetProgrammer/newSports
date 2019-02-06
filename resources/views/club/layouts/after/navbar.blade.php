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

      @include('club.layouts.after.menu')
      
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

      <hr style="border-top: 10px dotted #3c8dbc;margin: 5px 15px">

    <!-- start this links will appear only for club Owner -->
    @can('Owner-only', Auth::user())
      @include('club.layouts.after.menuLinks.ownerMenu')
    <!-- End this links will appear only for club Owner -->

    <!-- start this links will appear only for club Owner -->
    @elsecan('Admin-only', Auth::user())
      @include('club.layouts.after.menuLinks.adminMenu')
    <!-- Ends this links will appear only for club Admin -->

    <!-- start this links will appear only for club Manager -->
    @elsecan('Manager-only', Auth::user())
      @include('club.layouts.after.menuLinks.mangerMenu')
    @endcan
    <!-- Ends this links will appear only for club Admin -->
      
    </section>
    <!-- /.sidebar -->
  </aside>
