@foreach (Auth::user()->playgrounds as $playground)
    <ul class="sidebar-menu" data-widget="tree">
        <li class="  {{ makeActiveLinkActive()[0] }}">
        <a href="{{url('club')}}/{{Auth::user()->club_id}}" style="{{ makeActiveLinkActive()[2] }}">
            <i class="fa fa-dashboard"></i> <span>{{$playground->c_b_p_name}}</span>
        </a>
        </li>
    </ul>
@endforeach