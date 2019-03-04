
              <h3>{{ $part_title }}</h3>
              {!! Form::hidden( 'clubId', $club->id ) !!}
              {!! Form::hidden( 'type', 'users' ) !!}
              <div class="row">
                <div class="col-md-4">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-calendar custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.From') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('from_date', old('from'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-4--->

                <div class="col-md-4">
                  <p style="font-weight:bold" id="formTitle">
                    <i class="fa fa-calendar custom" style="color: #3c8dbc;"></i>
                    {{ trans('club.To') }}
                  </p>
                  <p class="text-muted">
                    {!! Form::date('to_date', old('to'),['class'=>'form-control']) !!}
                  </p>
                </div><!--/.col-md-4--->

                <div class="col-md-4">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-sort custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.sortBy') }}
                    </p>
                    <p class="text-muted">
                      {!! Form::select(
                                        'sort_by',  
                                        ['name' => 'Names', 'id' => "ID's", 'created_at' => "Account Created Date"], 
                                        null, 
                                        ['class'=>'form-control','placeholder' => 'Pick a size...']
                      ); !!}
                    </p>
                  </div><!--/.col-md-4--->

                  <div class="col-md-12">
                    <p style="font-weight:bold" id="formTitle">
                      <i class="fa fa-building custom" style="color: #3c8dbc;"></i>
                      {{ trans('club.Branch') }}
                    </p>
                    @php
                        $users = \App\Model\User::where('club_id', $club->id)->get();
                    @endphp
                      @foreach ($users as $user)
                        <div class="col-lg-4">
                            @if ($user->name != 'post')
                              <div class="checkbox">
                                <label><input type="checkbox" name="users[]" value="{{ $user->id }}">{{ $user->name }}</label>
                              </div>
                            @endif
                        </div>
                      @endforeach
                  </div><!--/.col-md-12--->

              </div><!--/.row--->
              
              
              <br><br><br><br><br>
              <!----->
