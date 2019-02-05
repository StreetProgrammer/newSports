<li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell"></i>
          @if (Auth::user()->unreadNotifications->count() > 0)
            <span class="label label-warning">
              {{ Auth::user()->unreadNotifications->count() }}
            </span>
          @endif
        </a>
        <ul class="dropdown-menu" style="width: 300px">
          <li class="header">
            <div class="row">
                <div class="text-center">
                    <a href="#" data-toggle="tooltip" title="{{ trans('player.delete') }}" class="noti_delete_all a-holding-divs" style="padding:1px">
                        {{ trans('player.delet_all') }}
                    </a>
                    -
                    <a href="#" data-toggle="tooltip" title="{{ trans('player.mark_as_read') }}" class="noti_all_as-read a-holding-divs" style="padding:1px">
                        {{ trans('player.mark_all_as_read') }}
                    </a>
                </div>            
            </div>
          </li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              @foreach (Auth::user()->notifications as $notification)
                <li @if($notification->unread())style="background: #ddd;"@endif>
                  {{-- <span class="pull-right">x</span> --}}
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
                  {{--  --}}
                  <a href="{{aurl()}}{{ $notification->data['url'] }}">
                    <div style="font-size: 90%">
                      <i class="{{ $notification->data['iconClass'] }}"></i>
                      @if (direction() == 'ltr')
                        {{ $notification->data['en'] }}
                      @else
                        {{ $notification->data['ar'] }}
                      @endif 
                       - 
                      <span style="color: #00c0ef;">
                        {{ $notification->data['clubName'] }}
                      </span>
                    </div>
                  </a>
                  
                </li>
              @endforeach

            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>