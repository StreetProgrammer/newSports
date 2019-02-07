@extends('club.index')
@section('content')
  @yield('content')

    @can('Owner-Admin-only', Auth::user())
      {{-- owner_admin home page --}}
      @include('club.Home.owner_admin')

    @elsecan('Manager-only', Auth::user())
      {{-- manager home page --}}
      @include('club.Home.manager')
      
    @endcan
@endsection