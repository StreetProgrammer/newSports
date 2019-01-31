    <!---------- start notification ----------->
    @if (Auth::user()->notifications->count() > 0)
        @foreach (Auth::user()->notifications as $notification)
        <li @if($notification->unread())style="background: #ededed;"@endif>
            <div class="col-md-3 col-sm-3 col-xs-3">
            <div class="notify-img">
                <img  width="46px" 
                @if ( empty($notification->data['user_img']) )
                    src="{{ url('/') }}/design/AdminLTE/dist/img/user.png"
                @else
                    src="{{ Storage::url($notification->data['user_img']) }}"
                @endif class="user-image" alt="User Image" alt=""
                >
            </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-9 pd-l0">
            <div class="pull-right">
                <a href="#" data-toggle="tooltip" 
                    title="{{ trans('player.delete') }}" 
                    id="{{$notification->id}}_delete" 
                    class="noti_delete a-holding-divs rIcon" 
                    style="padding:1px"
                >
                    <i class="fa fa-close"></i>
                </a>
                @if ($notification->unread())
                    <a href="#" data-toggle="tooltip" 
                    title="{{ trans('player.mark_as_read') }}" 
                    id="{{$notification->id}}_noti_as-read" 
                    class="noti_as-read a-holding-divs rIcon" 
                    style="padding:1px"
                >
                    <i class="fa fa-dot-circle-o"></i>
                </a>
                @endif
                
            </div>
            
            <a href="{{url('/')}}{{$notification->data['user_url']}}">
                {{$notification->data['user_name']}}
            </a> 
            @if (direction() == 'ltr')
                {{$notification->data['en']}} {{-- expr --}}
            @else
                {{$notification->data['ar']}}
            @endif
            <a href="{{url('/')}}{{$notification->data['taraget_url']}}" style="
    font-size: 15px;">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
            </a> 
            {{-- <a href="" class="{{$notification->id}}_as-read a-holding-divs rIcon">
                <i class="fa fa-dot-circle-o"></i>
            </a>
            <a href="" class="{{$notification->id}}_as-read a-holding-divs rIcon">
                <i class="fa fa-dot-circle-o"></i>
            </a> --}}
            
            <hr>
            @php
            //$Carbon = new Illuminate\SupportCarbon;
            if ( direction() == 'ltr') {
                \Illuminate\Support\Carbon::setLocale('en');
            } else {
                Illuminate\Support\Carbon::setLocale('ar');
            }
            
            @endphp
            <p class="time">{{$notification->created_at->diffForHumans()}}</p>
            </div>
        </li>
        @endforeach
    @else
        <li>
        
        <div style="padding-top: 30px" class="text-center col-md-12 col-sm-12 col-xs-12 pd-l0">
            
            no notifications yet

        </div>
        </li>
    @endif
    
    <!------------end notification ------------>