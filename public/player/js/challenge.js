////////////////// //////////////////////////////


///////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////
//////////////start of accept or reject challenge //////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".AcceptRejectchallenge", function () {

	var params = this.id ;
	//alert(params);
	var params = params.split("_");
	var loader = $('#' + params[0] + '_ARChallengeLoader');
	loader.fadeIn();
	var challengeId  		= params[0] ;
	var status 			= params[1];
	//alert(challengeId);
	//alert(status);

	var _token = $("input[name=_token]").val();
	//alert(_token) ;
		$.ajax({
	      type:'POST',
	      url:'/Challenge/AcceptRejectchallenge',
	      data:{
             	_token:_token,
             	challengeId:challengeId,
             	status:status,
         },
	    	success:function(data){
	    		console.log(data) ;
	    		if (data == 'true') {
	    			$('#challenge-sport-playgrounds').load('/challenge/challengeSportPlaygrounds/' + challengeId).fadeIn('slow');
	    			$('#expected-playgrounds').load('/challenge/suggestedPlaygrounds/' + challengeId).fadeIn('slow');
	    		} else if(data == 'false') {
	    		}
    			$('#candidate').load('/challenge/candidate/' + challengeId).fadeIn('slow');
            	console.log(data) ;
	    		loader.fadeOut();
	            console.log(data) ;   
	         }
	   });
	
});

/////////////////////////////////////////////////////////////////////////////////
///////////////////end of accept or reject challenge ////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
//////////////start of suggest a playground for the challenge //////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".suggestChallengePlayground", function () {

	var params = this.id ;
	var params = params.split("_");
	var loader = $('#' + params[0] + '_' + params[1]+ '_suggestLoader');
	loader.fadeIn();
	var challengeId  = params[0] ;
	var playgroundId = params[1];
	//alert(challengeId);
	//alert(playgroundId);

	var _token = $("input[name=_token]").val();
	//alert(_token) ;
		$.ajax({
	      type:'POST',
	      url:'/Challenge/SuggestPlayground',
	      data:{
             	_token:_token,
             	playgroundId:playgroundId,
             	challengeId:challengeId
         },
	    	success:function(data){
	    		$('#challenge-sport-playgrounds').load('/challenge/challengeSportPlaygrounds/' + challengeId).fadeIn('slow');
	    		$('#expected-playgrounds').load('/challenge/suggestedPlaygrounds/' + challengeId).fadeIn('slow');
	    		console.log(data) ;
	    		if (data == 'true') {

	    		} else if(data == 'false') {
	    		}
    		
            	console.log(data) ;
	    		loader.fadeOut();
	            console.log(data) ;   
	         }
	   });
	
});

/////////////////////////////////////////////////////////////////////////////////
//////////////end of suggest a playground for the challenge //////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
//////////////start of accept or reject suggested playground //////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".AcceptRejectPlayground", function () {

	var params = this.id ;
	//alert(params);
	var params = params.split("_");
	var loader = $('#' + params[0] + '_' + params[1]+ '_ARPlaygroundLoader');
	loader.fadeIn();
	var challengeId  		= params[0] ;
	var playgroundId 	= params[1];
	var status 			= params[2];
	//alert(challengeId);
	//alert(playgroundId);

	var _token = $("input[name=_token]").val();
	//alert(_token) ;
		$.ajax({
	      type:'POST',
	      url:'/Challenge/AcceptRejectPlayground',
	      data:{
             	_token:_token,
             	playgroundId:playgroundId,
             	challengeId:challengeId,
             	status:status,
         },
	    	success:function(data){
	    		//$('#event-sport-playgrounds').load('/event/eventSportPlaygrounds/' + challengeId).fadeIn('slow');
	    		$('#expected-playgrounds').load('/challenge/suggestedPlaygrounds/' + challengeId).fadeIn('slow');
	    		console.log(data) ;
	    		if (data == 'true') {

	    		} else if(data == 'false') {
	    		}
    		
            	console.log(data) ;
	    		loader.fadeOut();
	            console.log(data) ;   
	         }
	   });
	
});

/////////////////////////////////////////////////////////////////////////////////
//////////////end of accept or reject suggested playground //////////////////////
/////////////////////////////////////////////////////////////////////////////////*/

/////////////////////////////////////////////////////////////////////////////////
//////////////start make sure game result is integer positive value ///////////////
//////////////////////////////////////////////////////////////////////////////////
$(document).on('change', "input[type=number]", function (e) {

	var CreatorScore = $('input[name=CreatorScore]').val();
	var CreatorScore = /^\+?(0|[1-9]\d*)$/.test(CreatorScore);
	var CandidateScore = $('input[name=CandidateScore]').val();
	var CandidateScore = /^\+?(0|[1-9]\d*)$/.test(CandidateScore);
	//alert(status);
	if (CreatorScore === true && CandidateScore === true) {
		$('#AddGameBtn').fadeIn();
		$('.resultErr').fadeOut();
	} else {
		$('#AddGameBtn').fadeOut();
		$('.resultErr').fadeIn();
	}
	//
});
/////////////////////////////////////////////////////////////////////////////////
//////////////end make sure game result is integer positive value ///////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
//////////////start of suggest a subevent for that event //////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#AddGameBtn", function (e) {

	e.preventDefault();
	console.log('true');

	$('#AddGameBtnLoader').show();

	var _token = $('input[name=_token]').val();

	var EventType = $('input[name=EventType]').val();

	var MainEvent = $('input[name=MainEvent]').val();

	var OpinionBy = $('input[name=OpinionBy]').val();

	var CreatorScore = $('input[name=CreatorScore]').val();

	var CandidateScore = $('input[name=CandidateScore]').val();

	//console.log(data) ;
	console.log('MainEvent = ' + MainEvent + ' OpinionBy = ' + OpinionBy + ' CreatorScore = ' + CreatorScore + ' CandidateScore = ' + CandidateScore + ' _token = ' + _token);

	$.ajax({
		type: 'POST',
		url: '/SubEvent/' + MainEvent + '/Add',
		data: {
			EventType: EventType,
			OpinionBy: OpinionBy,
			CreatorScore: CreatorScore,
			CandidateScore: CandidateScore,
			_token: _token,
		},
		success: function (data) {
			$('#suggestGameModal').modal('hide');
			$('#AddGameBtnLoader').hide();
			$('#challenge-result').load('/challenge/challengeResult/' + MainEvent).fadeIn('slow');
		}
	});

});

/////////////////////////////////////////////////////////////////////////////////
//////////////end of suggest a subevent for that event //////////////////////
/////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End of Add Game to Event event part ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// start of refuse a Game to Event part ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".refuseSuggestedGame", function (e) {

	$("#event-result").css("filter", "blur(2px)");
	e.preventDefault();

	var _token = $('input[name=_token]').val();
	var MainEvent = $('input[name=MainEvent]').val();
	var id = $(this).attr('id');
	SubEvent = id.replace('refuseSuggestedGame', '')
	console.log(SubEvent);
	console.log('true');

	$.ajax({
		type: 'POST',
		url: '/SubEvent/' + SubEvent + '/RefuseGame',

		data: {
			_token: _token,
		},
		success: function (data) {
			$('#challenge-result').load('/challenge/challengeResult/' + MainEvent).fadeIn('slow');
			$("#event-result").css("filter", "blur(0px)");
			
		}
	});


});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End of refuse a Game to Event part ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// start of Accept a Game to Event part ////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".accpetSuggestedGame", function (e) {
	$("#challenge-result").css("filter", "blur(2px)");
	$("#event-result").css("filter", "blur(2px)");
	e.preventDefault();
	var _token = $('input[name=_token]').val();
	var MainEvent = $('input[name=MainEvent]').val();
	var id = $(this).attr('id');
	SubEvent = id.replace('accpetSuggestedGame', '')
	console.log(id);
	console.log('true');
	////alert(SubEvent + '  ' + MainEvent)
	$.ajax({
		type: 'POST',
		url: '/SubEvent/' + SubEvent + '/AcceptGame',

		data: {
			eventtype:'challenge',
			_token:_token,
		},
		success: function (data) {
			
			$('#challenge-result').load('/challenge/challengeResult/' + MainEvent).fadeIn('slow');
			$('#challenge-winner').load('/challenge/challenge-winner/' + MainEvent).fadeIn('slow');
			$("#challenge-result").css("filter", "blur(0px)");
			$("#challenge-winner").css("filter", "blur(0px)");
		}
	});


});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End of Accept a Game to Event part /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// start of Delete a Game to Event part ////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".deleteSuggestedGame", function (e) {
	$("#challenge-result").css("filter", "blur(2px)");
	e.preventDefault();
	var _token = $('input[name=_token]').val();
	var MainEvent = $('input[name=MainEvent]').val();
	var id = $(this).attr('id');
	SubEvent = id.replace('deleteSuggestedGame', '')
	console.log(id);
	console.log('true');

	$.ajax({
		type: 'POST',
		url: '/SubEvent/' + SubEvent + '/DeleteGame',

		data: {
			_token: _token,
		},
		success: function (data) {
			$('#challenge-result').load('/challenge/challengeResult/' + MainEvent).fadeIn('slow');
			$("#challenge-result").css("filter", "blur(0px)");
		}
	});


});

///////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////// End of Delete a Game to Event part /////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
///////////////////////// start rate player after event ends ////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('click', "#RatePlayer", function (e) {
	//$("#AddGameBtn").on("click", function(e){
	//$("#AddGameBtn").click(function(e){

	e.preventDefault();
	console.log('true');

	$('#RatePlayerLoader').show();

	var _token = $('input[name=_token]').val();

	var EventType = $('input[name=EventType]').val();

	var MainEvent = $('input[name=MainEvent]').val();

	var OpinionBy = $('input[name=OpinionBy]').val();
	var data = {};
	var q1 = $("input[type=radio][name=q_1]:checked").val();
	if (q1 != null && q1 != "") {
		var q_1 = q1;
		data['q_1'] = q_1;
	} else {
		data['q_1'] = 0;
	}
	var q2 = $("input[type=radio][name=q_2]:checked").val();
	if (q2 != null && q2 != "") {
		var q_2 = q2;
		data['q_2'] = q_2;
	} else {
		data['q_2'] = 0;
	}
	var q3 = $("input[type=radio][name=q_3]:checked").val();
	if (q3 != null && q3 != "") {
		var q_3 = q3;
		data['q_3'] = q_3;
	} else {
		data['q_3'] = 0;
	}
	var q4 = $("input[type=radio][name=q_4]:checked").val();
	if (q4 != null && q4 != "") {
		var q_4 = q4;
		data['q_4'] = q_4;
	} else {
		data['q_4'] = 0;
	}
	var q5 = $("input[type=radio][name=q_5]:checked").val();
	if (q5 != null && q5 != "") {
		var q_5 = q5;
		data['q_5'] = q_5;
	} else {
		data['q_5'] = 0;
	}
	var Comment = $.trim($("#comment").val());
	if (Comment != null && Comment != "") {
		var comment = Comment;
		data['comment'] = comment;
	}


	console.log(data);
	//var load ;
	if (jQuery.isEmptyObject(data) == false) {
		data['_token'] = _token;
		data['EventType'] = EventType;
		data['Event'] = MainEvent;
		data['OpinionBy'] = OpinionBy;
		$.ajax({
			type: 'POST',
			url: '/AddPlayerRate',
			data: data,
			success: function (data) {
				if (data == 'true') {
					$('#RatePlayerLoader').hide();
					setTimeout(function () {
						$('#RatePlayerModal').modal('hide');
					}, 2000);

					$('#candidate').load('/challenge/candidate/' + MainEvent).fadeIn('slow');
					$('#creator').load('/challenge/creator/' + MainEvent).fadeIn('slow');
				} else {
					//$('#errors').fadeIn();
					setTimeout(function () {
						$('#RatePlayerErr').show(800);
					}, 2000);
					setTimeout(function () {
						$('#RatePlayerErr').hide();
					}, 10000);
					$('#RatePlayerLoader').hide();
					//$('#event-result').load('/event/eventResult/' + MainEvent).fadeIn('slow');
				}

				//$('#result').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Result').fadeIn('slow');
				//$('#EventGames').load('http://127.0.0.1:8000/Event/' + MainEvent + '/Games').fadeIn('slow');

			}
		});
	}

});

/////////////////////////////////////////////////////////////////////////////////
///////////////////////// end rate player after event ends ////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".chat-widget-container", function (e) {
	$(function () {
		var chatWidget = (".chat-widget-container"),
			chatBox = $(".chat-box-container");

		//$(chatWidget).click(function (e) {

		e.preventDefault();

		$(chatBox).toggleClass("show");
		$(chatWidget).toggleClass("open");
		//})

	});

});





/*$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

----------------------------------------------------------------------------------------

$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$
$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$*/