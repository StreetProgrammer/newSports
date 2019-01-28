{{-- <div class="container">
  <div class="col-md-12"> --}}
    <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <h3 class="box-title"><i class="fa fa-tag"></i>  {{ trans('club.mainAccountBranchesPlaygroundsInfo') }}</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <div class=" col-md-12">

          <div class="imageInfo col-md-4">       
            @include('club.register.pageParts.branchesPlaygroundsInfo')
          </div>
        <div class="mainInfo col-md-8">
          <!-- About Me Box -->
          {!! Form::open(['url' => aurl(''), 'method' => 'POST']) !!}
          {!! Form::hidden( 'clubBranch', $clubBranch->id ) !!}
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">{{ $title }} {{ $clubBranch->c_b_name }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- <p class="text-center">hggh</p> -->
              <strong>
                <i class="fa fa-building custom" style="color: #3c8dbc;"></i>  
                {{ trans('club.Name') }}
              </strong>
              <p class="text-muted">
                <input type="text" name="c_b_name" class="form-control"  value="{{$clubBranch->c_b_name}}">
              </p>

              <hr class="">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i> 
                {{ trans('club.Phone') }}
              </strong>

              <p class="text-muted">
                <input type="text" name="c_b_phone" class="form-control" value="{{$clubBranch->c_b_phone}}">
              </p>

              <hr class="">
              <div class="clearfix"></div>

              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> 
                {{ trans('club.Location') }}
              </strong>

              <p class="displayDetails text-muted" >
                
              <!---->
              <div class="col-lg-12" style="margin:10px auto">
                <select class="form-control input-xs" name="c_b_country" id="country" disabled>
                  <option value="">{{ trans('player.Select_Country') }}</option>
                    @foreach ($countries as $country)
                      <option
                          value="{{ $country->id }}"
                          {{ ($clubBranch->c_b_country == $country->id ? 'selected' : '') }}
                      >
                        {{ (direction() == 'ltr' ? $country->c_en_name : $country->c_ar_name) }}
                      </option>
                    @endforeach
                </select>
              </div>
              <div class="clearfix"></div>
              <!---->
              <div class="col-lg-5">
                <select class="form-control input-xs" name="c_b_city" id="governorate">
                  <option value="">{{ trans('club.Select_Governorate') }}</option>
                    @foreach ($governorate as $gov)
                      <option
                        value="{{ $gov->id }}"
                        {{ ($clubBranch->c_b_city == $gov->id ? ' selected="selected" ' : '') }} 
                      >
                        {{ (direction() == 'ltr' ? $gov->g_en_name : $gov->g_ar_name) }}
                    @endforeach
                </select>
              </div>
              <div class="col-lg-5" style="">
                <select class="form-control input-xs" name="c_b_area" id="area">
                  <option value="">{{ trans('club.Select_Area') }}</option>
                    @foreach ($governorate as $goov) <!--loop throw each city -->
                      @foreach ($goov->areas as $area) <!--loop throw each city->area -->
                        <!--check if we are in club city -->
                        @if ($area->a_governorate_id == $clubBranch->c_b_city)
                          <option
                            value="{{ $area->id }}"
                            {{ ($clubBranch->c_b_area == $area->id ? ' selected="selected" ' : '') }}
                          >
                            {{ (direction() == 'ltr' ? $area->a_en_name : $area->a_ar_name) }}
                          </option>
                        @endif
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
                    {{ trans('club.Detailed_Address') }}
                  </strong>
                  <p class="text-muted">
                    <input type="text" name="c_b_address" class="form-control" value="{{$clubBranch->c_b_address}}">
                  </p>
                  <hr>

                  <strong>
                    <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                    {{ trans('club.Description') }}
                  </strong>

                  <textarea class="form-control" name="c_b_desc" id="c_b_desc" cols="30" rows="8">
                    {{$clubBranch->c_b_desc}}
                  </textarea>
                  <br>
                  {!! Form::submit(trans('club.save'), ['class' => 'btn btn-primary', 'style' => '', 'id' => 'updateBranchRegister']) !!}
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
  /* </div>
</div> */

<!--  start upload branch logo Model -->
<div id="EditclubProfileImageModal" class="modal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Crop Image</h4>
          </div>
          <div class="modal-body">
            <div class="row">
            <div class="col-md-12 text-center">
              <div id="EditclubProfileImage_crop" style="<!-- width:350px; --> margin-top:30px"></div>
            </div>
        </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary crop_editClubProfileImage">Crop</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>
</div>
<!--  end upload branch logo Model -->
