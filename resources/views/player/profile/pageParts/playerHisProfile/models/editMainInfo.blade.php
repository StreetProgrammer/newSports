<div id="editMainInfoModal" class="modal" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header" style="color: #fff;background-color: #06774a !important;">
              <button type="button" class="close" data-dismiss="modal" style="color:#fff">&times;</button>
              <h4 class="modal-title" >
                {{ trans('player.Edit_Main_Information') }} 
                <span id="profileInfoLoader" style="display:none;">
                  <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                </span>
              </h4>
            </div>
            <div class="modal-body profileInfo">
              <div class="row">
                <div class="col-md-12">
                    <div id="editMainInfoMessage" class="alert alert-danger text-center" style="display:none">
                        <h4><i class="fa fa-warning"></i></h4>
                        <p style="font-size: 90%;color: #3c763d;">
                        {{ trans('player.check_wrong_entries_and_try_again') }}
                        </p>
                    </div>
                    <form action="">
                        <div class="form-group">
                            <label for="name">{{ trans('player.Name') }} :</label>
                            <input type="text" 
                                    name="name" 
                                    class="sm-inputs form-control" 
                                    id="name" 
                                    value="{{$user->name}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('player.Email_address') }} :</label>
                            <input type="email" 
                                    name="email"
                                    disabled="disabled"
                                    class="sm-inputs form-control"  
                                    value="{{$user->email}}"
                            >
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('player.Phone_Number') }} :</label>
                            <input type="phone" 
                                    name="p_phone" 
                                    class="sm-inputs form-control" 
                                    id="phone" 
                                    value="{{$user->playerProfile->p_phone}}"
                            >
                        </div>

                        <div class="col-lg-12" style="margin:10px auto">
                            <label for="country">{{ trans('player.location') }} :</label>
                            <select class="sm-inputs form-control input-xs" name="p_country" id="country">
        
                                <option value="">{{ trans('player.Select_Country') }}</option>
        
                            @foreach ($countries as $country)
        
                                <option
                                    value="{{ $country->id }}"
                                    {{ ($user->playerProfile->p_country == $country->id ? ' selected="selected" ' : '') }}     
                                >
                                    {{ (direction() == 'ltr' ? $country->c_en_name : $country->c_ar_name) }}
                                </option>
        
                            @endforeach
        
        
                            </select>
        
                        </div>
                        <div class="clearfix"></div>
                        
                        <div class="col-lg-5 ">
        
                            <select 
                                class="sm-inputs form-control input-xs" 
                                name="p_city" 
                                id="governorate"
                                @if ($user->playerProfile->p_city == "" || $user->playerProfile->p_city == 0)
                                   style="display:none" 
                                @endif
                            >
        
                                <option value="">{{ trans('player.Select_Governorate') }}</option>
        
                            @foreach ($governorate as $gov)
        
                                <option
                                    value="{{ $gov->id }}"
                                    {{ ($user->playerProfile->p_city == $gov->id ? ' selected="selected" ' : '') }}
                                    
                                >
                                    {{ (direction() == 'ltr' ? $gov->g_en_name : $gov->g_ar_name) }}
                                </option>
        
                            @endforeach
        
        
                            </select>
        
                        </div>

                        <div class="col-lg-5">
                            <select 
                                class="sm-inputs form-control input-xs" 
                                name="p_area" 
                                id="area"
                                @if ($user->playerProfile->p_area == "" || $user->playerProfile->p_area == 0)
                                   style="display:none" 
                                @endif
                            >
        
                            <option value="">Select Area</option>
                            @foreach ($governorate as $goov) <!--loop throw each city -->
                                @foreach ($goov->areas as $area) <!--loop throw each city->area -->
                                    <!--check if we are in clubBranche city -->
                                    @if ($area->a_governorate_id == $user->playerProfile->p_city)
                                    <option
                                        value="{{ $area->id }}"
                                        {{ ($user->playerProfile->p_area == $area->id ? ' selected="selected" ' : '') }}
                                    >
                                        {{ (direction() == 'ltr' ? $area->a_en_name : $area->a_ar_name) }}
                                    </option>
                                    @endif
                                @endforeach
                            @endforeach
        
                            </select>
                        </div>

                        <div class="col-lg-2" >
                            <div id="loader"
                                    class="text-center "
                                    style="display: none;z-index: 99999;font-size: 20px;color: #06b36f;"
                            >
                            <i class="fa fa-circle-o-notch fa-spin"></i>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
        
                        <div class="form-group" style="display:none">
                            <label for="p_address">{{ (trans('player.Address')) }} :</label>
                            <input type="text" 
                            name="p_address" 
                            class="sm-inputs form-control" 
                            id="p_address"
                            style="display:none" 
                            value="{{$user->playerProfile->p_address}}"
                            >
                        </div>
        
                        <div class="form-group">
                            <label for="p_gender">{{ (trans('player.Gender')) }} :</label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="p_gender" 
                                value="1"
                                {{ ($user->playerProfile->p_gender == 1 ? ' checked="checked" ' : '') }} 
                                >
                                <span style="font-size: 120%;color: #06774a;"><i class="fa fa-male" ></i></span>    
                            </label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="p_gender" 
                                value="2" 
                                {{ ($user->playerProfile->p_gender == 2 ? ' checked="checked" ' : '') }}
                                >
                                <span style="font-size: 120%;color: #06774a;"><i class="fa fa-female" ></i></span>   
                            </label>
                            
                        </div>
        
                        <div class="form-group">
                            <label for="p_preferred_gender">{{ trans('player.Interested_in') }} :</label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="p_preferred_gender" 
                                value="1" 
                                {{($user->playerProfile->p_preferred_gender == 1 ? ' checked="checked" ' : '')}}
                                >
                                <span style="font-size: 120%;color: #06774a;"><i class="fa fa-male" ></i></span>    
                            </label>
                            
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="p_preferred_gender" 
                                value="2" 
                                {{ ($user->playerProfile->p_preferred_gender == 2 ? ' checked="checked" ' : '') }}
                                
                                />
                                <span style="font-size: 120%;color: #06774a;"><i class="fa fa-female" ></i></span>   
                            </label>
                            
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="p_preferred_gender" 
                                value="3" 
                                {{ ($user->playerProfile->p_preferred_gender == 3 ? ' checked="checked" ' : '') }}
                                >
                                <span style="font-size: 120%;color: #06774a;">
                                <i class="fa fa-male" ></i> | <i class="fa fa-female" ></i> 
                                </span>   
                            </label>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="pwd">{{ trans('player.birth_date') }} :</label>
                            <input type="date" 
                                    class="sm-inputs form-control" 
                                    id="p_born_date"
                                    name="p_born_date" 
                                    format="dd-MM-yyyy"
                                    @if ($user->playerProfile->p_born_date != '')
                                    value="{{$user->playerProfile->p_born_date}}" 
                                    @endif
                            />
                        </div>
                            
                        <div class="col-md-10">
                            <p style="font-size: 14px;color: #333;">
                            <label for="pwd">{{ trans('player.Password') }} :</label>
                            <input type="password" name="password" class="sm-inputs form-control" value="">
                            </p>
                        </div>
                        <div class="col-md-2 text-center" style="margin-top: 30px">
                            <strong class="showHidePass" style="font-size: 120%;
                                                    border: 2px solid #f89406;
                                                    padding: 3px 5px;
                                                    border-radius: 15px;
                                                    cursor: pointer;"
                            >
                            <i class="fa fa-eye" style="color: #f89406;"aria-hidden="true"></i>
                            </strong>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="privacy">{{ trans('player.privacy') }} :</label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="privacy" 
                                value="1"
                                {{ ($user->playerProfile->privacy == 1 ? ' checked="checked" ' : '') }} 
                                >
                                <span style="font-size: 120%;color: #06774a;">{{ trans('player.unlock') }}</span>    
                            </label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="privacy" 
                                value="0" 
                                {{ ($user->playerProfile->privacy == 0 ? ' checked="checked" ' : '') }}
                                >
                                <span style="font-size: 120%;color: #06774a;">{{ trans('player.lock') }}</span>   
                            </label>
                            
                        </div>
                        <div class="form-group">
                            <label for="user_is_active">{{ trans('player.Account_Status') }} :</label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="user_is_active" 
                                value="1"
                                {{ ($user->user_is_active == 1 ? ' checked="checked" ' : '') }} 
                                >
                                <span style="font-size: 120%;color: #06774a;">{{ trans('player.Activated') }}</span>    
                            </label>
                            
                            <label class="radio-inline" style="font-size: 15px;">
                                <input type="radio" 
                                name="user_is_active" 
                                value="0" 
                                {{ ($user->user_is_active == 0 ? ' checked="checked" ' : '') }}
                                >
                                <span style="font-size: 120%;color: #06774a;">{{ trans('player.Deactivated') }}</span>   
                            </label>
                            
                        </div>
                    </form>
                </div>         
            </div>
        </div>
            <div class="modal-footer" style="color: #fff;background-color: #06774a !important;">
              <button 
                    type="button"
                    style="background:orange"
                    class="btn btn-success sm-round-btn orange"
                    id="updatePlayerMainInfo" 
              >
                {{ trans('player.Update') }}
              </button>
              <button 
                    type="button"
                    style="background: #fff !important; color: #000 !important;border-color:#ddd;box-shadow: 1px 0px 0px #eee;" 
                    class="btn sm-round-btn btn-default"  
                    data-dismiss="modal"
              >
                {{ trans('player.Close') }}
              </button>
            </div>
          </div>
        </div>
      </div>