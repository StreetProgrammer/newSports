<div class="container">
  <div class="col-md-12">
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i> {{ trans('club.mainAccountInfo') }}</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class=" col-md-12">

              <div class="imageInfo col-md-4">       
                <!-- Profile Image -->
                <div class="box box-primary">
                  <div class="box-body box-profile">
                    <div class="text-center" style="position: relative">
                      <img id="clubProfileImagePlaceholder" class="displayCamIcon img img-rounded" 
                            style="width:200px;"
                            src="{{ url('/') }}/player/img/football-playground.jpg"
                            alt="User profile picture"
                       >
                      <label for="clubProfileImageFile" style="position:absolute;bottom:0%;left:50%;
                        transform:translate(-50%, -20%);
                        -ms-transform:translate(-50%, -20%);display: none;
                        color:white;font-size:16px;border:none;
                        cursor:pointer;font-size:20px;color:#fff;">
                        <span style=""
                        >
                          <i class="fa fa-camera" aria-hidden="true"></i>
                        </span>
                        <input type="file" id="clubProfileImageFile" style="display:none">
                    </label>
                    </div>
                  </div>
                <!-- /.box-body -->
                </div>
              <!-- /.box -->
              </div>

        <div class="mainInfo col-md-8">
          <!-- About Me Box -->
          {!! Form::open(['url' => aurl(''), 'method' => 'POST']) !!}
          {!! Form::hidden( 'user_img', '' ) !!}
          {!! Form::hidden( 'type', '2' ) !!}
          <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {{-- <p class="text-center">hggh</p> --}}
              <strong>
                <i class="fa fa-user custom" style="color: #3c8dbc;"></i>  
                {{ trans('club.clubName') }}
              </strong>
              <p class="text-muted">
                <input type="text" name="name" class="form-control"  value="">
              </p>

              <hr class="">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i> 
              {{ trans('club.clubPhone') }}
              </strong>

              <p class="text-muted">
                <input type="text" name="c_phone" class="form-control" value="">
              </p>

              <hr>

              <strong class="displayDetails"><i class="fa fa-envelope margin-r-5" style="color: #3c8dbc;"></i>  
                {{ trans('club.clubEmail') }}
              </strong>

              <p class="text-muted">
              <input type="text" name="email" class="form-control" value="">
              </p>

              <hr class="">

              <p class="displayDetails">
                <i class="fa fa-key margin-r-5" style="color: #3c8dbc;"aria-hidden="true"></i>
                {{ trans('club.clubPassword') }}
              </p>
              <div class="col-md-10">
                <p class="text-muted">
                  <input type="password" name="password" class="form-control" value="">
                </p>
              </div>
              <div class="col-md-2 text-center">
                <strong class="showHidePass" style="font-size: 120%;
                                        border: 2px solid #3c8dbc;
                                        padding: 3px 5px;
                                        border-radius: 15px;
                                        cursor: pointer;"
                >
                  <i class="fa fa-eye" style="color: #3c8dbc;"aria-hidden="true"></i>
                </strong>
              </div>
              <hr class="">
              <div class="clearfix"></div>

              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> 
                {{ trans('club.clubLocation') }}
              </strong>

              <p class="displayDetails text-muted" >
              <!---->
              <div class="col-lg-12" style="margin:10px auto">
                <select class="form-control input-xs" name="c_country" id="country" >
                  <option value="">{{ trans('player.Select_Country') }}</option>
                    @foreach ($countries as $country)
                      <option
                          value="{{ $country->id }}"
                      >
                        {{ (direction() == 'ltr' ? $country->c_en_name : $country->c_ar_name) }}
                      </option>
                    @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
              <!---->
              <div class="col-lg-5">
                <select class="form-control input-xs" name="c_city" id="governorate">
                  <option value="">{{ trans('club.Select_Governorate') }}</option>
                  @foreach ($governorate as $gov)
                    <option
                      value="{{ $gov->id }}"
                    >
                    {{ ( direction() == 'ltr' ? $gov->g_en_name : $gov->g_ar_name) }}
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-5" style="">
                <select class="form-control input-xs" name="c_area" id="area">
                  <option value="">Select Area</option>
                  @foreach ($governorate as $goov) <!--loop throw each city -->
                    @foreach ($goov->areas as $area) <!--loop throw each city->area -->
                      <option value="{{ $area->id }}" >
                        {{ ( direction() == 'ltr' ? $area->a_en_name : $area->a_ar_name) }}
                      </option>
                    @endforeach
                  @endforeach
                </select>
              </div>
              <div class="col-lg-2" style="" >
                  <div id="loader"
                        class="text-center "
                        style="display: none;z-index: 99999;font-size: 10px;color: #3c8dbc;"
                  >
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                  </div>
              </div>
              <div class="clearfix"></div>
                <!---->
              <br>
                  <strong>
                    <i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> 
                    {{ trans('club.clubDetailed_Address') }}
                  </strong>
                  <p class="text-muted">
                    <input type="text" name="c_address" class="form-control" value="">
                  </p>
                  <hr>

                  <strong>
                    <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                    {{ trans('club.clubDescription') }}
                  </strong>

                  <textarea class="form-control" name="c_desc" id="c_desc" cols="30" rows="8">
                    
                  </textarea>
                  <br>
                  {!! Form::submit( trans('club.save')  , ['class' => 'btn btn-primary', 'style' => '', 'id' => 'StoreClubMainInfo']) !!}
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        {!! Form::close() !!}
              </div>

            </div>
            <!-- /.col -->
            
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
  </div>
</div>

<!--  start upload branch logo Model -->
<div id="clubProfileImageModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Upload & Crop Image</h4>
          </div>
          <div class="modal-body" style="height: 400px;">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="clubProfileImage_crop" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary crop_clubProfileImage">Crop</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->
