@extends('club.index')
@section('content')
    	{{-- @include('admin.layouts.messages') --}}
    	@yield('content')
      <!-- Small boxes (Stat box) -->
    @can('Owner-Admin-only', Auth::user())
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $club->clubBranches->count() }}</h3>

              <p>{{ trans('club.clubBranchesCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="fa fa-cubes"></i>
            </div>
            <a href="{{ url('branches/club') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $club->clubPlaygrounds->count() }}<!-- <sup style="font-size: 20px">%</sup> --></h3>

              <p>{{ trans('club.playgroundsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="fa fa-cube"></i>
            </div>
            <a href="{{ url('playgrounds/club') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $club->clubProfile->users->count() }}</h3>

              <p>{{ trans('club.usersCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ url('/club/users/all') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $club->clubReservation->count() }}</h3>

              <p>{{ trans('club.reservationsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url('/reservations/club') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        {{--
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-Purple">
            <div class="inner">
              <h3>{{ $club->clubPlaygrounds->count() }}</h3>

              <p>{{ trans('club.eventsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('events') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-darkGray">
            <div class="inner">
              <h3>{{ $club->clubPlaygrounds->count() }}</h3>

              <p>{{ $club->clubPlaygrounds->count() }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('challenges') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-brouwn">
            <div class="inner">
              <h3>{{ $club->clubPlaygrounds->count() }}</h3>

              <p>{{ trans('club.reservationsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('reservations') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-pink">
            <div class="inner">
              <h3>{{ $club->clubPlaygrounds->count() }}</h3>

              <p>{{ trans('club.sportsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('sports') }}" class="small-box-footer">{{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
        --}}
      </div>
      {{-------------}}
      <section class="content">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Area Chart</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <!--<canvas id="areaChart" style="height: 108px; width: 342px;" width="342" height="108"></canvas>-->
                  {!! $allReservationByYear->render() !!}
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
  
            <!-- DONUT CHART -->
            <div class="box box-danger">
              <div class="box-header with-border">
                <h3 class="box-title">Donut Chart</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                {{-- <canvas id="pieChart" style="height: 181px; width: 362px;" width="362" height="181"></canvas> --}}
                {!! $reservationPercentage->render() !!}
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
  
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">Line Chart</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <!--<canvas id="lineChart" style="height: 108px; width: 342px;" width="342" height="108"></canvas>-->
                  {!! $allReservationByMonth->render() !!}
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
  
            <!-- BAR CHART -->
            <div class="box box-success">
              <div class="box-header with-border">
                <h3 class="box-title">Bar Chart</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
              </div>
              <div class="box-body">
                <div class="chart">
                  <!--<canvas id="barChart" style="height: 99px; width: 342px;" width="342" height="99"></canvas>-->
                  {!! $allReservation->render() !!}
                </div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
  
          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
  
      </section>
      {{-------------}}
    @elsecan('Manager-only', Auth::user())
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              @foreach (Auth::user()->playgrounds as $playground)
                @if ($playground->is_active == 1 && $playground->our_is_active == 1)
                  <div class="col-lg-6 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                      <div class="inner">
                        <h4><strong>{{ $playground->c_b_p_name }}</strong></h4>

                        <p>{{ $playground->sport->en_sport_name }}</p>
                      </div>
                      <div  class="icon" 
                            id="{{$playground->id}}" 
                            style="cursor: pointer;color: #fff !important;"
                            data-toggle="modal" 
                            data-target="#calendar{{ $playground->id }}"
                      >
                        <i class="fa fa-cube"></i>
                      </div>
                      <a href="{{ url('playground/res') }}/{{ $playground->id  }}" 
                        class="small-box-footer"
                      >
                        {{ trans('club.moreInfo') }} <i class="fa fa-arrow-circle-right"></i>
                      </a>
                    </div>          
                  </div>
                  <!-- ./col -->
                @endif 
              @endforeach
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /. box -->
        </div>
        @foreach (Auth::user()->playgrounds as $playground)
          @if ($playground->is_active == 1 && $playground->our_is_active == 1)
          <!-- Modal -->
            <div class="modal fade" id="calendar{{ $playground->id }}" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{ $playground->c_b_p_name }}</h4>
                  </div>
                  <div class="box box-primary">
                    <div class="box-body no-padding">
                      <div class="modal-body">
                        <p>
                          <span class="btn btn-flat" style="color:#fff; background: #00a65a">by Player</span>
                          <span class="btn btn-flat" style="color:#fff; background: #dd4b39">by Owner</span>
                          <span class="btn btn-flat" style="color:#fff; background: #ff851b">by Admin</span>
                          <span class="btn btn-flat" style="color:#fff; background: #0073b7">by Manager</span>
                        </p>
                        <div class="row">
                          <div class="col-md-7">
                            <div id="Reservations{{$playground->id}}"></div>
                          </div>
                          <div class="col-md-4" style="background: #EEE; border: 1px solid #ddd;">
                            <h3>New Reservation</h3><br><br>

                            <p id="{{$playground->id}}_err" class="alert"></p>
                            <!-- start add reservation form -->
                            <form class="form-horizontal our-form"
                              action="{{url('Reservation')}}/{{$playground->id}}/Add"
                              method="post"
                              role="form"
                            >
                                {{ csrf_field() }}
                              <input type="hidden" name="playgroundId" value="{{$playground->id}}">
                              <div class="form-group">
                                <label class="col-lg-3 control-label">Date</label>
                                <div class="col-lg-8">
                                  <input 
                                    id="{{$playground->id}}_date" 
                                    type="date" class="date" 
                                    name="{{$playground->id}}_date" 
                                    min="{{ date("Y-m-d") }}" 
                                    class="date form-control input-xs">
                                </div>
                              </div>
                              <div class="hours" style="">
                                @php
                                  $hours = DB::table('hours')->get();
                                @endphp
                                <div class="form-group">
                                  <label class="col-lg-3 control-label">From</label>
                                  <div class="col-lg-8">
                                      <select id="{{$playground->id}}_from" name="{{$playground->id}}_from" class="date form-control input-xs">
                                          <option value="">{{ trans('club.starts_at') }}</option>
                                        @foreach ($hours as $hour)
                                          <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                                        @endforeach

                                      </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-lg-3 control-label">To</label>
                                  <div class="col-lg-8">
                                      <select id="{{$playground->id}}_to" name="{{$playground->id}}_to" class="date form-control input-xs">
                                          <option value="">{{ trans('club.ends_at') }}</option>
                                        @foreach ($hours as $hour)
                                          <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                                        @endforeach

                                      </select>
                                  </div>
                                </div>
                                
                                <div id="{{$playground->id}}_nameDiv" class="form-group" style="display: none">
                                  <label class="col-lg-3 control-label">Name</label>
                                  <div class="col-lg-8">
                                      <input  id="{{$playground->id}}_name"
                                              name="{{$playground->id}}_name" 
                                              type="text" 
                                              class="form-control input-xs"
                                              required="required" 
                                      >
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-md-3 control-label"></label>
                                  <div class="col-md-8">
                                     <input 
                                        type="submit" 
                                        class="submit btn btn-md btn-flat btn-primary"
                                        style="display: none;" 
                                        value="Add"
                                        name="{{$playground->id}}_add"
                                        id ="{{$playground->id}}_add"  
                                      >
                                      <span class="reCheckLoader pull-right" style="display:none;color: #367fa9 ;">
                                        <i class="fa fa-circle-o-notch fa-spin" style="font-size:20px"></i>
                                      </span>
                                  </div>
                                </div>
                          
                              
                              </div>
                            </form>
                            <!-- start add reservation form -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
          <!-- endModel -->
          @endif 
        @endforeach
       
          <div class="col-md-6">
            <div class="box box-primary">
              <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="reservations"></div>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->
            </div>
          </div>

    @endcan
@endsection