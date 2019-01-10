<div>
           <div class="panel panel-default shade top-bottom-border" >

          <!--------------------->
          <div class="panel-heading text-center shade bottom-border" >
            <h4 style="color: #06774a;margin: 5px 0px">{{ trans('player.Event_Detalis') }}</h4>
          </div>

         {{--  <div class="shade-2 text-center" 
               style="background: #ececec;
                  border: 1px solid #ddd;
                  margin: 5px 50px;">
            <h4 style="font-size: 15px !important;">
              <span style="padding-bottom:10px"> {{ trans('player.Countdown_Clock') }} : </span>
              <br>
              <div style="    margin: 10px">
               @if ( 1 == 1/* $event->E_date < date("Y-m-d") */ )
                   @include('player.event.pageParts.event.countdown')
               @endif                
              </div>
            </h4>
          </div> --}}

          <div class="shade-2 text-center" 
               style="background: #ececec;
                  border: 1px solid #ddd;
                  margin:15px 50px 5px 50px;"
          >
            <h4 style="font-size: 15px !important;">
              <span>{{ trans('player.Sport') }} : </span>
              <a class="a-holding-divs"
                  href="{{url('/')}}/Sport/{{ sm_crypt($event->eventSport->id) }}">
                @if ( direction() == 'ltr' )
                 {{ $event->eventSport->en_sport_name }}   
                @else
                 {{ $event->eventSport->ar_sport_name }}   
                @endif
              </a>
            </h4>
          </div>


          

          <!--------------------->
          <div class="shade-2 text-center" 
               style="background: #ececec;
                  border: 1px solid #ddd;
                  margin:5px 50px;"
          >
            <h4 style="font-size: 15px !important;">
              @if ( direction() == 'ltr' )
                  <span>
                    <i class="fa fa-calendar" style="color: #f89406;font-size: 20px;"></i> </span>
                  <span>{{ strftime( '%d-%m-%Y' , strtotime($event->E_date ) )}} </span>
                  <span><i class="fa fa-clock-o" style="color: #f89406;font-size: 20px;"></i></i></span>
                  <span>{{ $event->EventFrom->hour_format}} </span>
                  <span><i class="fa fa-arrows-h" style="color: #f89406;font-size: 20px;"></i></i></span>
                  <span>{{ $event->EventTo->hour_format}} </span>
              @else
                  <span>
                    <i class="fa fa-calendar" style="color: #f89406;font-size: 20px;"></i> 
                  </span>
                  <span>
                    {{ strftime( '%d-%m-%Y' , strtotime($event->E_date ) )}}  
                  </span>

                  <span style="display:inline-block;">
                    <i class="fa fa-clock-o" style="color: #f89406;font-size: 20px;"></i></i>
                    {{ $event->EventFrom->hour_format}}
                    <i class="fa fa-arrows-h" style="color: #f89406;font-size: 20px;"></i></i>
                  </span>

                  <span> 
                    {{ $event->EventTo->hour_format}} 
                  </span>
                  
              @endif
              
            </h4>
          </div>
</div>