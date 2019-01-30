                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <div class="text-center" style="">
                        <!-- check if club has branches -->
                        @if (Auth::user()->clubBranches->count() > 0)
                          @foreach (Auth::user()->clubBranches as $branch)

                            <div style="border: 1px solid #3c8dbc;
                                        margin: 5px 5px;
                                        padding: 10px 0px;
                                        border-radius: 5px;
                                        background: #ddd;"
                            >
                              <p style="color: #3c8dbc;font-size: 115%;font-weight: bold;">
                                <span class="text-center">
                                  {{ $branch->c_b_name }}
                                </span>
                                <span id="{{ $branch->id }}"  
                                      class="DeleteBranch pull-right" 
                                      style="margin: -10px 5px 0px 5px;
                                            color:#3c8dbc;
                                            cursor: pointer;"
                                >
                                  <i class="fa fa-close"></i>
                                </span>
                                <span id="{{ $branch->id }}"  
                                      class="DisplayEditBranch pull-right" 
                                      style="margin: -10px 5px 0px 5px;
                                            color:#3c8dbc;
                                            cursor: pointer;"
                                >
                                  <i class="fa fa-edit"></i>
                                </span>
                              </p>
                              @if ($branch->branchPlaygrounds->count() > 0)
                                @foreach ($branch->branchPlaygrounds as $playground)
                                  <div style="padding: 10px 0px 0px 10px;
                                              margin: 10px 40px;
                                              border: 1px solid #3c8dbc;
                                              background: #fff;
                                              border-radius: 10px;"
                                  >
                                    <p>
                                      <span class="text-center">
                                        {{ $playground->c_b_p_name }}
                                      </span>
                                      <span id="{{ $playground->id }}"  
                                            class="DeletePlayground pull-right" 
                                            style="margin: -10px 5px 0px 5px;
                                                  color:#3c8dbc;
                                                  cursor: pointer;"
                                      >
                                        <i class="fa fa-close"></i>
                                      </span>
                                      <span id="{{ $playground->id }}"  
                                            class="DisplayEditPlayground pull-right" 
                                            style="margin: -10px 5px 0px 5px;
                                                  color:#3c8dbc;
                                                  cursor: pointer;"
                                      >
                                        <i class="fa fa-edit"></i>
                                      </span>
                                          </p>
                                  </div>
                                @endforeach
                              @else
                                <div class="text-center">
                                  <span class="label label-danger">{{ trans('club.No_Playgrounds') }}</span>
                                </div>
                              @endif
                              <hr>
                                {{ trans('club.Add_New_Playground') }}
                                <span id="{{ $branch->id }}"  
                                      class="AddPlaygroundRegister"  style="cursor: pointer;color: #3c8dbc;">
                                  <i class="fa fa-plus-square"></i>
                                </span>
                            </div>
                            
                          @endforeach

                          <hr>
                           <span class="ShowManagePart" style="cursor: pointer;color: #3c8dbc;">
                            <i class="fa fa-plus-square"></i>
                          </span>
                          {{ trans('club.Add_New_Branch') }}
                        @else
                          <hr>
                           <span class="ShowManagePart" style="cursor: pointer;color: #3c8dbc;">
                            <i class="fa fa-plus-square"></i>
                          </span>
                          {{ trans('club.Add_New_Branch') }}
                        @endif
                        
                    </div>
                  </div>

                <!-- /.box-body -->
                </div>
              <!-- /.box -->
               <br><br>
                <!----->
                @php
                $registerDone = 1 ;
                  if (Auth::user()->clubBranches->count() > 0){
                    foreach (Auth::user()->clubBranches as $Branch) {
                      if ($Branch->branchPlaygrounds->count() == 0) {
                        $registerDone = 0 ;
                      }
                    }
                  }else{
                    $registerDone = 0 ;
                  }
                @endphp

                @if ($registerDone == 1)
                  <!---->
                  {!! Form::open(['url' => url('/NewClubProfileCreated'), 'method' => 'POST']) !!}
                  {!! Form::hidden( 'clubId', Auth::id() ) !!}
                  <div style="padding: 10px;
                          margin: 10px;
                          border: 2px solid #3c8dbc;
                          border-radius: 5px;
                          background: #ecf0f5;"   
                  >
                    <p style="color: #3c8dbc;
                            font-size: 100%;
                            font-weight: bold;
                            font-family: sans-serif;"   
                    >
                    {{ trans('club.finishEditMessage') }}
                    <span style="color:#ff0505">{{ trans('club.untillreview') }}</span>
                      {{-- if you finished your club data, please click button below to save it and wait for our response --}}
                    </p>
                    {!! Form::submit(trans('club.Send_Account_Data'), ['class' => 'btn btn-primary btn-block']) !!}
                    {!! Form::close() !!}
                  </div>
                  <!----->

                @endif
                
                 