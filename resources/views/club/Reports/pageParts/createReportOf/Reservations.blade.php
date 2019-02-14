
              <h3>{{ $part_title }}</h3>
              {!! Form::hidden( 'clubId', $club->id ) !!}
              {!! Form::hidden( 'type', 'reservations' ) !!}
              <div class="row">
                <div class="col-md-6">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-calendar custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.From') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('from_date', old('from'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-6--->

                <div class="col-md-6">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-calendar custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.To') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('to_date', old('to'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-6--->

                <div class="col-md-6">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.sortBy') }}
                    </p>
                    <p class="text-muted">
                      {!! Form::select(
                                        'sort_by',  
                                        ['id' => "ID's",'R_date' => 'Reservation Date', 'created_at' => "Reservation Created Date"], 
                                        null, 
                                        ['class'=>'form-control','placeholder' => 'Sort By ...']
                      ); !!}
                    </p>
                  </div><!--/.col-md-6--->

                  <div class="col-md-6">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.adminName') }}
                    </p>
                    <p class="text-muted">
                      {!! Form::date('too',old('to'),['class'=>'form-control']) !!}
                    </p>
                  </div><!--/.col-md-6--->
              </div><!--/.row--->
              
              <br><br><br><br><br>
              <!----->
