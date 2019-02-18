
              <h3>{{ $part_title }}</h3>
              {!! Form::hidden( 'clubId', $club->id ) !!}
              {!! Form::hidden( 'type', 'courts' ) !!}
              <div class="row">

                <div class="col-md-4">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.From') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('from_date', old('from'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-4--->

                <div class="col-md-4">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.To') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('to_date', old('to'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-4--->

                <div class="col-md-4">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.sortBy') }}
                    </p>
                    <p class="text-muted">
                      {!! Form::select(
                                        'sort_by',  
                                        ['name' => 'Names', 'id' => "ID's", 'created_at' => "Account Created Date"], 
                                        null, 
                                        ['class'=>'form-control','placeholder' => 'Sort By ...']
                      ); !!}
                    </p>
                  </div><!--/.col-md-4--->

                  <div class="col-md-12">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-user custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.adminName') }}
                    </p>
                      @foreach ($club->clubPlaygrounds as $playground)
                        <div class="col-lg-4">
                            @if ($playground->name != 'post')
                              <div class="checkbox">
                                <label><input type="checkbox" name="playgrounds[]" value="{{ $playground->id }}">{{ $playground->c_b_p_name }}</label>
                              </div>
                            @endif
                        </div>
                      @endforeach
                  </div><!--/.col-md-12--->

              </div><!--/.row--->
              
              
              <div class="col-md-12">
                <p class="text-muted">
                  <input type="password" name="password" class="form-control" value="">
                </p>
              </div>
    
              <br><br><br><br><br>
              <!----->
