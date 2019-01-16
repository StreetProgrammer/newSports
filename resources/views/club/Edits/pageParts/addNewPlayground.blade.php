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
          {!! Form::hidden( 'clubId', Auth::id() ) !!}
          {!! Form::hidden( 'branchId', $clubBranch->id ) !!}
          {!! Form::hidden( 'c_b_p_country', Auth::user()->clubProfile->c_country ) !!}
          <div class="box box-primary">
            <div class="box-header with-border">
              
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <!-- <p class="text-center">hggh</p> -->
              <strong>
                <i class="fa fa-building custom" style="color: #3c8dbc;"></i>  
                {{ trans('club.Name') }}
              </strong>
              <p class="text-muted">
                <input type="text" name="c_b_p_name" class="form-control"  value="">
              </p>

              <hr class="">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i> 
                {{ trans('club.Phone') }}
              </strong>

              <p class="text-muted">
                <input type="text" name="c_b_p_phone" class="form-control" value="">
              </p>

              <hr class="">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i> 
                {{ trans('club.Sport') }}
              </strong>

              <p class="text-muted">
                <select class="form-control input-xs" name="c_b_p_sport_id" id="sport">
                  <option value="">{{ trans('club.Select_Sport') }}</option>
                  @foreach ($sports as $sport)
                    <option
                        value="{{ $sport->id }}"
                    >
                        @if ( direction() == 'ltr' )
                         {{ $sport->en_sport_name }}   
                        @else
                         {{ $sport->ar_sport_name }}   
                        @endif
                    </option>
                  @endforeach
                </select>
              </p>

              <hr class="">
              <strong><i class="fa fa-phone custom" style="color: #3c8dbc;"></i> 
                {{ trans('club.Price_Per_Hour') }}
              </strong>

              <p class="text-muted">
                <input type="text" name="c_b_p_price_per_hour" class="form-control" value="">
              </p>

              <hr class="">
              <div class="clearfix"></div>

              <strong><i class="fa fa-map-marker margin-r-5" style="color: #3c8dbc;"></i> 
                {{ trans('club.Location') }}
              </strong>

              <p class="displayDetails text-muted" >
                
              <!---->

              <div class="col-lg-5">
                <select class="form-control input-xs" name="c_b_p_city" id="governorate">
                  <option value="">{{ trans('club.Select_Governorate') }}</option>
                  @foreach ($governorate as $gov)
                    <option
                      value="{{ $gov->id }}"
                    >
                        @if ( direction() == 'ltr' )
                          {{ $gov->g_en_name }}   
                        @else
                          {{ $gov->g_ar_name }}   
                        @endif
                    </option>
                  @endforeach
                </select>
              </div>
              <div class="col-lg-5" style="">
                <select class="form-control input-xs" name="c_b_p_area" id="area">
                  <option value="">{{ trans('club.Select_Area') }}</option>
                  @foreach ($governorate as $goov) <!--loop throw each city -->
                    @foreach ($goov->areas as $area) <!--loop throw each city->area -->
                      <!--check if we are in club city -->
                      @if ($area->a_governorate_id == Auth::user()->clubProfile->c_city)
                        <option
                          value="{{ $area->id }}"
                        >
                          @if ( direction() == 'ltr' )
                            {{ $area->a_en_name }}   
                          @else
                            {{ $area->a_ar_name }}   
                          @endif
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
                    <input type="text" name="c_b_p_address" class="form-control" value="">
                  </p>
                  <hr>

                  <strong>
                    <i class="fa fa-file-text-o margin-r-5" style="color: #3c8dbc;"></i> 
                    {{ trans('club.Description') }}
                  </strong>
                  <textarea class="form-control" name="c_b_p_desc" id="c_b_p_desc" cols="30" rows="8">
                    
                  </textarea>
                  <div class="row" >
                    <div class="col-md-12">
                      <p>{{ trans('club.features') }}</p>
                    </div>
                    <div class="col-md-12">
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 1">{{ trans('club.feature1') }}</label>
                          {{ Form::checkbox('features[]', 'feature1', ['id'=> 'feature 1']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 2">{{ trans('club.feature2') }}</label>
                          {{ Form::checkbox('features[]', 'feature2', ['id'=> 'feature 2']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 3">{{ trans('club.feature3') }}</label>
                          {{ Form::checkbox('features[]', 'feature3', ['id'=> 'feature 3']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 4">{{ trans('club.feature4') }}</label>
                          {{ Form::checkbox('features[]', 'feature4', ['id'=> 'feature 4']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 5">{{ trans('club.feature5') }}</label>
                          {{ Form::checkbox('features[]', 'feature5', ['id'=> 'feature 5']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 6">{{ trans('club.feature6') }}</label>
                          {{ Form::checkbox('features[]', 'feature6', ['id'=> 'feature 6']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 7">{{ trans('club.feature7') }}</label>
                          {{ Form::checkbox('features[]', 'feature7', ['id'=> 'feature 7']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 8">{{ trans('club.feature8') }}</label>
                          {{ Form::checkbox('features[]', 'feature8', ['id'=> 'feature 8']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 9">{{ trans('club.feature9') }}</label>
                          {{ Form::checkbox('features[]', 'feature9', ['id'=> 'feature 9']) }}
                        </div>
                      </div>
                      <div class="col-md-3 text-center">
                        <div class="fea" style="background: #ecf0f5;border:1px solid #ddd;margin-bottom: 5px;">
                          <label class="" style="cursor: pointer;" for="feature 10">{{ trans('club.feature10') }}</label>
                          {{ Form::checkbox('features[]', 'feature10', ['id'=>'feature 10']) }}
                        </div>
                      </div>
                    </div>
                      
                  </div>
                  <div class="row">
                    <div class="col-md-12">  
                      <label id="forPlaygroundImageFile" for="newPlaygroundImageFile" style="position:absolute;bottom:0%;left:50%;
                        transform:translate(-50%, 105%);
                        -ms-transform:translate(-50%, 110%);
                        font-size:16px;border:none;
                        cursor:pointer;font-size:16px;color:#3c8dbc;"
                      >
                        {{ trans('club.Add_Photos') }}
                        <span style=""
                        >
                          <i class="fa fa-picture-o margin-r-5" style="color: #3c8dbc;"></i>
                        </span>
                          <input type="file" id="newPlaygroundImageFile" style="display:none">
                      </label>
                    </div>
                  </div>
                  <div class="row newplaygroundGallaryPlaceholder" style="margin: 25px 0px 0px 0px;background: #ecf0f5;border: 1px solid #d2d6de;">
                    
                  </div>
                  <br>
                  <br>
                  <input type="hidden" name="photos">
                  {!! Form::submit(trans('club.save'), ['class' => 'btn btn-primary', 'style' => '', 'id' => 'AddNewPlaygroundRegister']) !!}
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
  {{-- </div>
</div> --}}


<script>


</script>
