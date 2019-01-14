@php
    $days = DB::table('days')->get();
    $hours = DB::table('hours')->orderBy('sort')->get();
@endphp
<div class="col-md-12">

  <div class="panel panel-default shade top-bottom-border">
    <div class="panel-heading text-center shade bottom-border">
      <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.searchNewEvents') }}
        <span id="newEventsloader" style="display:none;">
          <i class="fa fa-circle-o-notch fa-spin" style="font-size:20px;color:#06774a;"></i>
        </span>
      </h4>
    </div>
    <div class="search-events" style="margin: 10px;padding: 10px;">
      <div class="row">  
        <div class="col-sm-3">
          <div class="form-group">
            <label for="name" style="color:#06774a;">{{ trans('player.Event_creator') }}</label>
            <input type="text" 
                    name="newEvents_filter_creator" 
                    class="newEventsSearch sm-inputs form-control" 
                    id="newEventCreatorInput" 
            >
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label style="color:#06774a;">{{ trans('player.eventDate') }}</label>
            <input type="date" 
                    name="newEvents_filter_date" 
                    class="newEventsSearch sm-inputs form-control" 
                    id="newEventDateInput" 
            >
          </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label style="color:#06774a;">{{ trans('player.From') }}</label>
                <select name="newEvents_filter_from" id="newEventFromInput" style="padding: 0 5px 0 10px;" class="newEventsSearch sm-inputs form-control">
                   <option value="">{{ trans('player.eventFrom') }}</option> 
                    @foreach ($hours as $hour)
                    <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                    @endforeach
                </select>
            </div>
        </div>
         <div class="col-sm-3">
            <div class="form-group">
                <label style="color:#06774a;">{{ trans('player.To') }}</label>
                <select name="newEvents_filter_to" id="newEventToInput" style="padding: 0 5px 0 10px;" class="newEventsSearch sm-inputs form-control">
                    <option value="">{{ trans('player.eventTo') }}</option>
                    @foreach ($hours as $hour)
                    <option value="{{ $hour->hour_id }}">{{ $hour->hour_format }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-12 text-center">
           <button type="button" 
                style="background: #ff9800 !important; 
                       color: #fff !important;
                       border-color:#ddd;
                       box-shadow: 1px 0px 0px #eee;" 
                class="btn sm-inputs btn-warning border-20" 
                id="newEvents_filter"
            >
                {{ trans('player.filter') }}
            </button> 
        </div>
      </div>
    </div>


    </div>
</div>
