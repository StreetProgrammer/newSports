@if ( $challenge->C_YesOrNo == 1 ) {{-- if challenge candidate accept challenge --}}

  @if ( $challenge->C_JQueryTo < date("Y-m-d H:i:s") ) {{-- if challenge date is in past --}}

    {{-- @if ( empty($challenge->C_reservation) ) --}} {{-- if challenge reservation not exist --}}

        {{-- @if (Auth::user()->id == $challenge->C_creator_id || Auth::user()->id == $challenge->C_candidate_id) --}}

<div>
	<div class="panel panel-default shade top-bottom-border">

      <!--------------------->
    <div class="panel-heading text-center shade bottom-border">
       
        <h4 style="color: #06774a;margin: 5px 0px">
          {{ trans('player.All_Suggested_games') }}
        </h4>
          {{ trans('player.Desc_All_Suggested_games') }}
    </div>
{{------------------------------------------------------------}}
<!--------------->
	@include('player.challenge.pageParts.challenge.challenge-result-Child')    
<!---------------->
{{------------------------------------------------------------}}
	</div> <!---/.panel--->
</div> <!--- /div --->



		
			{{--@endif--}}  {{-- end if Auth == C_creator or C_candidate --}}

    {{-- @endif --}} {{-- here if  end if reservation is empty --}}

  @endif{{-- if challenge date is in past --}}

@endif {{-- end if challenge candidate accept challenge --}}

