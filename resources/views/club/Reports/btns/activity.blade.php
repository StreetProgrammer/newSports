@if ( $user_is_active == 0 )
	<span style="color:#dd4b39">Deactivated</span>
@elseif ( $user_is_active == 1 )
	<span style="color:#3bc321;">Activated</span>
@endif