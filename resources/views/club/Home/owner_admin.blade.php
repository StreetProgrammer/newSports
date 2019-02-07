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