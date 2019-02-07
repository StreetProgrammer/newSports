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