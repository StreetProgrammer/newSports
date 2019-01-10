@extends('admin.index')
@section('content')


    	{{-- @include('admin.layouts.messages') --}}
    	@yield('content')
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $playersCount }}</h3>

              <p>{{ trans('admin.playersCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="fa fa-users"></i>
            </div>
            <a href="{{ aurl('players') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $clubsCount }}<!-- <sup style="font-size: 20px">%</sup> --></h3>

              <p>{{ trans('admin.clubsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ aurl('clubs') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $clubBranchesCount }}</h3>

              <p>{{ trans('admin.clubBranchesCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ aurl('branches') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $playgroundsCount }}</h3>

              <p>{{ trans('admin.playgroundsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ aurl('playgrounds') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-Purple">
            <div class="inner">
              <h3>{{ $eventsCount }}</h3>

              <p>{{ trans('admin.eventsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('events') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-darkGray">
            <div class="inner">
              <h3>{{ $challengesCount }}</h3>

              <p>{{ trans('admin.challengesCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('challenges') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-brouwn">
            <div class="inner">
              <h3>{{ $reservationsCount }}</h3>

              <p>{{ trans('admin.reservationsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('reservations') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-pink">
            <div class="inner">
              <h3>{{ $sportsCount }}</h3>

              <p>{{ trans('admin.sportsCount') }}</p>
            </div>
            <div class="icon" style="color: #fff !important;">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ aurl('sports') }}" class="small-box-footer">{{ trans('admin.moreInfo') }} <i class="fa fa-arrow-circle-right"></i></a>
          </div>          
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <div class="row"><!-- top players row -->
      
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs" style=" font-size: 11px;font-weight: bold;">
            <li class="active"><a href="#onePlayer" data-toggle="tab">{{ trans('admin.TopSinglePlayer') }}</a></li>
            <li><a href="#top10PlayerEvent" data-toggle="tab">{{ trans('admin.topEventCreator') }}</a></li>
           <li><a href="#top10PlayerChallenge" data-toggle="tab">{{ trans('admin.topChallengeCreator') }}</a></li>
           <li><a href="#top10PlayerApplied" data-toggle="tab">{{ trans('admin.topappliedEvents') }}</a></li>
           <li><a href="#top10PlayerChallenged" data-toggle="tab">{{ trans('admin.tpochallenged') }}</a></li>
           <li><a href="#top10PlayerCandidate" data-toggle="tab">{{ trans('admin.topcandidatedEvents') }}</a></li>
           <li><a href="#top10PlayerReservation" data-toggle="tab">{{ trans('admin.topPlayerReservations') }}</a></li>
          </ul>
          <div class="tab-content">
<!--=============================start onePlayer tab=============================-->
        <div class="active tab-pane" id="onePlayer">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActivePlayes') }}</h4>
              <br>
              <div class="col-md-4">
                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.topEventCreator') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topEventCreator[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topEventCreator[0]->user_img) }}"
                        @endif 
                        alt="{{ $topEventCreator[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topEventCreator[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topEventCreator[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.topChallengeCreator') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topChallengeCreator[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topChallengeCreator[0]->user_img) }}"
                        @endif 
                        alt="{{ $topChallengeCreator[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topChallengeCreator[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topChallengeCreator[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.topappliedEvents') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topappliedEvents[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topappliedEvents[0]->user_img) }}"
                        @endif 
                        alt="{{ $topappliedEvents[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topappliedEvents[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topappliedEvents[0]->created_at)) ; @endphp
                  </p>

                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
               <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.tpochallenged') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topchallenged[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topchallenged[0]->user_img) }}"
                        @endif 
                        alt="{{ $topchallenged[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topchallenged[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topchallenged[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.topcandidatedEvents') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topcandidatedEvents[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topcandidatedEvents[0]->user_img) }}"
                        @endif  
                        alt="{{ $topcandidatedEvents[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topcandidatedEvents[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topcandidatedEvents[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color: #3c8dbc;font-weight: bold;">{{ trans('admin.topPlayerReservations') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        @if (empty($topPlayerReservations[0]->user_img))
                          src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                        @else
                          src="{{ Storage::url($topPlayerReservations[0]->user_img) }}"
                        @endif 
                        alt="{{ $topPlayerReservations[0]->name }}"
                    >
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topPlayerReservations[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserPlayer') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topPlayerReservations[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end onePlayer tab=============================-->

<!--=============================start 10 Events Players tab=============================-->
        <div class="tab-pane" id="top10PlayerEvent">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ trans('admin.mostActiveTenPlayes') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenEventCreator as $TECreator)

                    <tr>
                      <td>{{$TECreator->id}}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TECreator->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TECreator->user_img) }}"
                              @endif 
                              alt="{{ $TECreator->name }}"
                          >
                      </td>
                      <td>{{$TECreator->name}}</td>
                      <td>{{$TECreator->email}}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TECreator->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{$TECreator->id}}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{$TECreator->created_events_count}}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Events Players tab=============================-->

<!--=============================start 10 Challenges Players tab=============================-->
        <div class="tab-pane" id="top10PlayerChallenge">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenChallengeCreator as $TCCreator)

                    <tr>
                      <td>{{$TCCreator->id}}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TCCreator->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TCCreator->user_img) }}"
                              @endif  
                              alt="{{ $TCCreator->name }}"
                          >
                      </td>
                      <td>{{$TCCreator->name}}</td>
                      <td>{{$TCCreator->email}}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TCCreator->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{$TCCreator->id}}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{$TCCreator->created_challenges_count}}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Challenges Players tab=============================-->

<!--=============================start 10 Applied Players tab=============================-->
        <div class="tab-pane" id="top10PlayerApplied">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenappliedEvents as $TApplied)

                    <tr>
                      <td>{{ $TApplied->id }}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TApplied->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TApplied->user_img) }}"
                              @endif 
                              alt="{{ $TApplied->name }}"
                          >
                      </td>
                      <td>{{ $TApplied->name }}</td>
                      <td>{{ $TApplied->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TApplied->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{ $TApplied->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TApplied->applied_events_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Applied Players tab=============================-->

<!--=============================start 10 Challenged Players tab=============================-->
        <div class="tab-pane" id="top10PlayerChallenged">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenchallenged as $TChallenged)

                    <tr>
                      <td>{{ $TChallenged->id }}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TChallenged->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TChallenged->user_img) }}"
                              @endif 
                              alt="{{$TChallenged->name}}"
                          >
                      </td>
                      <td>{{ $TChallenged->name }}</td>
                      <td>{{ $TChallenged->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TChallenged->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{ $TChallenged->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TChallenged->challenge_events_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Challenged Players tab=============================-->

<!--=============================start 10 Candidate Players tab=============================-->
        <div class="tab-pane" id="top10PlayerCandidate">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTencandidated as $TCandidate)

                    <tr>
                      <td>{{ $TCandidate->id }}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TCandidate->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TCandidate->user_img) }}"
                              @endif 
                              alt="{{$TCandidate->name}}"
                          >
                      </td>
                      <td>{{ $TCandidate->name }}</td>
                      <td>{{ $TCandidate->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TCandidate->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{ $TCandidate->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TCandidate->candidated_events_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Candidate Players tab=============================-->

<!--=============================start 10 Candidate Players tab=============================-->
        <div class="tab-pane" id="top10PlayerReservation">
          <div class="box box-primary">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#3c8dbc;">{{ trans('admin.mostActiveTenPlayes') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Bordered Table</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenReservations as $TReservation)

                    <tr>
                      <td>{{ $TReservation->id }}</td>
                      <td>
                          <img 
                              width="60px" 
                              class="user-profile-60-img img-responsive img-circle" 
                              @if (empty($TReservation->user_img))
                                src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                              @else
                                src="{{ Storage::url($TReservation->user_img) }}"
                              @endif 
                              alt="{{$TReservation->name}}"
                          >
                      </td>
                      <td>{{ $TReservation->name }}</td>
                      <td>{{ $TReservation->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TReservation->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/players/{{ $TReservation->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TReservation->player_reservations_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Candidate Players tab=============================-->

      </div>
      </div>
    </div><!-- end top players row -->
      <!-- /.row -->
       <div class="row"><!-- top clubs row -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs" style=" font-size: 11px;font-weight: bold;">
              <li class="active"><a href="#oneClub" data-toggle="tab">{{ trans('admin.TopSingleClub') }}</a></li>
              <li><a href="#top10Clubsbranches" data-toggle="tab">{{ trans('admin.topBranchOwner') }}</a></li>
              <li><a href="#top10ClubsPlayground" data-toggle="tab">{{ trans('admin.topclubPlaygrounds') }}</a></li>
              <li><a href="#top10ClubsReservation" data-toggle="tab">{{ trans('admin.topClubsReservation') }}</a></li>
          </ul>
          <div class="tab-content">
<!--=============================start one Club tab=============================-->
        <div class="active tab-pane" id="oneClub">      
          <div class="box box-success">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#00a65a;">{{ trans('admin.mostActiveClubs') }}</h4>
              <br>
            
               <div class="col-md-4">
                <!-- Profile Image -->
                <div class="box box-success">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color:#00a65a;font-weight: bold;">{{ trans('admin.topclubBranches') }}</h5>
                    <img 
                        width="60px" 
                        class="user-profile-60-img img-responsive img-circle" 
                        src="{{ url('/') }}/design/AdminLTE/dist/img/user4-128x128.jpg" alt="{{ $topclubBranches[0]->name }}">
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topclubBranches[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserClub') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topclubBranches[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-success">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color:#00a65a;font-weight: bold;">{{ trans('admin.topclubPlaygrounds') }}</h5>
                    <img width="60px" class="user-profile-60-img img-responsive img-circle" src="{{ url('/') }}/design/AdminLTE/dist/img/user4-128x128.jpg" alt="{{ $topclubPlaygrounds[0]->name }}">
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topclubPlaygrounds[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserClub') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topclubPlaygrounds[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->
              <div class="col-md-4">

                <!-- Profile Image -->
                <div class="box box-success">
                  <div class="box-body box-profile">
                    <h5 class="text-center" style="color:#00a65a;font-weight: bold;">{{ trans('admin.topclubReservation') }}</h5>
                    <img width="60px" class="user-profile-60-img img-responsive img-circle" src="{{ url('/') }}/design/AdminLTE/dist/img/user4-128x128.jpg" alt="{{ $topclubReservation[0]->name }}">
                    
                    <h6 class="text-center" style="font-weight: bold;">{{ $topclubReservation[0]->name }}</h6>

                    <p style="font-size:12px" class="text-muted text-center">{{ trans('admin.UserClub') }}</p>
                    <p style="font-size:12px" class="text-muted text-center">
                      {{ trans('admin.MemberSince') }}  @php  echo date('d-m-Y', strtotime($topclubReservation[0]->created_at)) ; @endphp
                  </p>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
            <!-- main box /.box -->
        </div><!-- /.tab-pane -->
<!--=============================end one Club tab=============================-->

<!--=============================start 10 Clubs have Branches tab=============================-->
        <div class="tab-pane" id="top10Clubsbranches">
          <div class="box box-success">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#00a65a;">{{ trans('admin.mostActiveClubs') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"style="color:#00a65a;">{{ trans('admin.topBranchOwner') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenclubBranches as $TClubBranches)

                    <tr>
                      <td>{{ $TClubBranches->id }}</td>
                      <td>
                          <img width="60px" class="user-profile-60-img img-responsive img-circle" src="http://127.0.0.1:8000/design/AdminLTE/dist/img/user4-128x128.jpg" alt="Taha Mostafa">
                      </td>
                      <td>{{ $TClubBranches->name }}</td>
                      <td>{{ $TClubBranches->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TClubBranches->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/clubs/{{ $TClubBranches->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TClubBranches->club_branches_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Clubs have Branches tab=============================-->

<!--=============================start 10 Clubs have Playgrounds tab=============================-->
        <div class="tab-pane" id="top10ClubsPlayground">
          <div class="box box-success">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#00a65a;">{{ trans('admin.mostActiveClubs') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"style="color:#00a65a;">{{ trans('admin.topclubPlaygrounds') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenclubPlaygrounds as $TClubPlaygrounds)

                    <tr>
                      <td>{{ $TClubPlaygrounds->id }}</td>
                      <td>
                          <img width="60px" class="user-profile-60-img img-responsive img-circle" src="http://127.0.0.1:8000/design/AdminLTE/dist/img/user4-128x128.jpg" alt="Taha Mostafa">
                      </td>
                      <td>{{ $TClubPlaygrounds->name }}</td>
                      <td>{{ $TClubPlaygrounds->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TClubPlaygrounds->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/clubs/{{ $TClubPlaygrounds->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TClubPlaygrounds->club_playgrounds_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Clubs have Playgrounds tab=============================-->

<!--=============================start 10 Clubs have Playgrounds tab=============================-->
        <div class="tab-pane" id="top10ClubsReservation">
          <div class="box box-success">
            <div class="box-body " style="background: #eeeeee59;">
              <h4 class="text-center" style="color:#00a65a;">{{ trans('admin.mostActiveClubs') }}</h4>
              <br>
              <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title"style="color:#00a65a;">{{ trans('admin.topClubsReservation') }}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="text-center table table-bordered">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 10px">{{ trans('admin.Photo') }}</th>
                      <th>{{ trans('admin.Name') }}</th>
                      <th>{{ trans('admin.Email') }}</th>
                      <th>{{ trans('admin.MemberSince') }}</th>
                       <th>{{ trans('admin.ViewProfile') }}</th>
                      <th style="">{{ trans('admin.Count') }}</th>
                    </tr>
                    @foreach($topTenclubReservation as $TClubReservations)

                    <tr>
                      <td>{{ $TClubReservations->id }}</td>
                      <td>
                          <img width="60px" class="user-profile-60-img img-responsive img-circle" src="http://127.0.0.1:8000/design/AdminLTE/dist/img/user4-128x128.jpg" alt="Taha Mostafa">
                      </td>
                      <td>{{ $TClubReservations->name }}</td>
                      <td>{{ $TClubReservations->email }}</td>
                      <td> @php  echo date('d-m-Y', strtotime($TClubReservations->created_at)) ; @endphp</td>
                      <td>
                        <a href="{{ aurl() }}/clubs/{{ $TClubReservations->id }}" style="font-size: 25px;">
                          <i class="fa fa-user"></i>
                        </a>
                      </td>
                      <td><span class="badge bg-green">{{ $TClubReservations->club_reservation_count }}</span></td>
                    </tr>
                    
                    @endforeach
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
              <!--<ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul> -->
                </div>
              </div>
              <!-- /.box -->
              </div>
              <!-- /.col-md-->

            </div>
                  <!-- /.box-body -->
          </div>
          <!-- main box /.box -->
       </div><!-- /.tab-pane -->
<!--=============================end 10 Clubs have Playgrounds tab=============================-->

          </div>
        </div>   
      </div>
      <!-- /.row -->


@endsection