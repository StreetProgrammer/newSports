<div class="col-md-12">
    <div class="panel panel-default shade top-bottom-border">
        <div class="panel-heading text-center shade bottom-border">
            <h4 style="color:#06774a;">
                {{ trans('player.Player_search') }}
                <span id="player_filters_loader" style="display:none;">
                    <i class="fa fa-circle-o-notch fa-spin" style="font-size:20px;color:#06774a;"></i>
                </span>
            </h4>
        </div>
    {{-- <div class="panel panel-default shade"> --}}
        <div style="padding: 20px">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label style="color:#06774a" for="name">{{ trans('player.Name') }} :</label>
                        <input type="text" 
                            name="player_filters_name" 
                            class="sm-inputs form-control" 
                            id="player_filters_name" 
                        >
                    </div>
                </div>
                
                {{-- Gender Section --}}
                {{--@if (Auth::user()->playerProfile->p_preferred_gender == 0 || Auth::user()->playerProfile->p_preferred_gender == 3)--}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label style="color:#06774a" for="p_gender">{{ trans('player.Gender') }}:</label><br>
                        
                        <label class="radio-inline" style="font-size: 15px;">
                            <input type="radio" 
                            name="player_filters_gender"
                            value="1" 
                            >
                            <span style="font-size: 120%;color: #06774a;"><i class="fa fa-male" ></i></span>    
                        </label>
                        
                        <label class="radio-inline" style="font-size: 15px;">
                            <input type="radio" 
                            name="player_filters_gender"
                            value="2" 
                            >
                            <span style="font-size: 120%;color: #06774a;"><i class="fa fa-female" ></i></span>   
                        </label>

                        <label class="radio-inline" style="font-size: 15px;">
                            <input type="radio" 
                            name="player_filters_gender"
                            value="3" 
                            >
                            <span style="font-size: 120%;color: #06774a;"><i class="fa fa-male" ></i></span> | 
                            <span style="font-size: 120%;color: #06774a;"><i class="fa fa-female" ></i></span>   
                        </label>
                        
                    </div>
                </div>

                {{-- start location  --}}

                <div class="clearfix"></div>
                <div class="col-md-4" >
                    <select class="sm-inputs form-control input-xs" name="player_filters_country" id="country">

                        <option value="">{{ trans('player.Select_Country') }}</option>

                    @foreach ($countries as $country)

                        <option
                            value="{{ $country->id }}"
                            
                            
                        >
                            @if (direction() == 'ltr')
                            {{ $country->c_en_name }}
                            @else
                            {{ $country->c_ar_name }}
                            @endif
                        </option>

                    @endforeach


                    </select>

                </div>
                
                <div class="col-md-3">

                    <select 
                        class="sm-inputs form-control input-xs" 
                        name="player_filters_city" 
                        id="governorate"
                        style="display:none"
                    >

                        <option value="">{{ trans('player.Select_Governorate') }}</option>

                    @foreach ($governorate as $gov)

                        <option
                            value="{{ $gov->id }}"
                            
                        >
                            @if (direction() == 'ltr')
                            {{ $gov->g_en_name }}
                            @else
                            {{ $gov->g_ar_name }}
                            @endif
                        </option>

                    @endforeach


                    </select>

                </div>

                <div class="col-md-3">
                    <select 
                        class="sm-inputs form-control input-xs" 
                        name="player_filters_area" 
                        id="area"
                        style="display:none"
                    >

                    <option value="">Select Area</option>
                    @foreach ($governorate as $goov) <!--loop throw each city -->
                        @foreach ($goov->areas as $area) <!--loop throw each city->area -->
                            <!--check if we are in clubBranche city -->
                            <option
                                value="{{ $area->id }}"
                            >
                                @if (direction() == 'ltr')
                                {{ $area->a_en_name }}
                                @else
                                {{ $area->a_ar_name }}
                                @endif
                            </option>
                        @endforeach
                    @endforeach

                    </select>
                </div>

                <div class="col-md-2" >
                    <div id="loader"
                            class="text-center "
                            style="display: none;z-index: 99999;font-size: 20px;color: #06b36f;"
                    >
                    <i class="fa fa-circle-o-notch fa-spin"></i>
                    </div>
                </div>
                {{-- end location --}}

            </div>
        
            <div class="text-center" style="margin: 10px;">
            <button type="button" 
                    style="background: #ff9800 !important; 
                        color: #fff !important;
                        border-color:#ddd;
                        box-shadow: 1px 0px 0px #eee;" 
                    class="sm-inputs border-20" 
                    id="player_filters"
                >
                    {{ trans('player.filter') }}
                </button> 
            </div>
            

        </div>
    </div>
</div>