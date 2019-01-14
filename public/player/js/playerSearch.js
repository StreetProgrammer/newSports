//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// start change tabs and contents ///////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/* $(document).on('click', ".players-playgrounds-events", function (e) {
	$("#search-result").css("filter", "blur(2px)");
	$("#search-filtter").css("filter", "blur(2px)");
	var id = $(this).attr('id');
	//var user_id = $("input[name=user_id]").val();
	//alert(id) ;
	//$('.' + type).show();

	if ($(this).hasClass('tab-li')) { //this is the start of our condition 
		$('.col-xs-6 span.players-playgrounds-events').addClass('tab-li');
		$('.col-xs-6 span.players-playgrounds-events').removeClass('tab-li-focus');
		$(this).removeClass('tab-li');
		$(this).addClass('tab-li-focus');

		//var type = 'evechares' ;
		//var sport = 0;
		switch (id) {
			case 'players':
				var search_filtter = '/getPlayerFilter';
				var search_result = '/freshPlayerSearchResults';
				break;
			case 'playgrounds':
				var search_filtter = '/getPlaygroundFilter';
				var search_result = '/freshPlaygroundSearchResults';
				break;
			case 'events':
				var search_filtter = '/getPlaygroundFilter';
				var search_result = '/freshPlaygroundSearchResults';
				break;
			default:
				var search_filtter = '/getPlayerFilter';
				var search_result = '/freshPlayerSearchResults';
		}
		setTimeout(function () {
			$('#search-filtter').load(search_filtter).fadeIn('slow');
			$('#search-result').load(search_result).fadeIn('slow');
			$("#search-filtter").removeAttr("style");
			$("#search-result").removeAttr("style");
			//$('.' + type).hide();
		}, 1000);

	}
}); */
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// start change tabs and contents //////////////////
/////////////////////////////////////////////////////////////////////////////////////

	/* to get search results and display it  */
	$(document).on('click', "#player_filters", function () {
		$("#search-result").css("filter", "blur(2px)");
		//$("#search-filtter").css("filter", "blur(2px)");
		var id = this.id ;

		var playerLoader = $("#" + id + "_loader");
		playerLoader.show();
		$("#search-result").css("filter", "blur(2px)");
		var data = {} ;

		var name_in  =  $("input[type=text][name=" + id + "_name]").val();
		if (name_in !== null && name_in !== "" && name_in.replace(/\s/g,"") !== "") {
			var name = name_in ;
			data['name'] = name;
		}
		var sport_in = $("select[name=" + id + "_sport]").val();
		if (sport_in != null && sport_in != "" ) {
			var sport = sport_in ;
			data['sport'] = sport;
		}
		var gender_in = $("input[type=radio][name=" + id + "_gender]:checked").val();
		if (gender_in != null && gender_in != "" ) {
			var gender = gender_in ;
			data['gender'] = gender;
		}
		var preferred_gender_in =  $("input[type=radio][name=" + id + "_preferred_gender]:checked").val();
		if (preferred_gender_in != null && preferred_gender_in != "" ) {
			var preferred_gender = preferred_gender_in ;
			data['preferred_gender'] = preferred_gender;
		}

		var country_in =  $("select[name=" + id + "_country] option:selected").val();
		if (country_in != null && country_in != "" ) {
			var country = country_in ;
			data['country'] = country;
		}

		var city_in =  $("select[name=" + id + "_city] option:selected").val();
		if (city_in != null && city_in != "" ) {
			var city = city_in ;
			data['city'] = city;
		}

		var area_in =  $("select[name=" + id + "_area] option:selected").val();
		if (area_in != null && area_in != "" ) {
			var area = area_in ;
			data['area'] = area;
		}
		
		console.log( jQuery.isEmptyObject(data) ? 'empty' : data );
		//alert(err) ;
		if(jQuery.isEmptyObject(data) == false){
			console.log(data) ;
			$('.reCheckLoader').fadeIn();
			var _token = $("input[name=_token]").val();
			var playgroundId = $("input[name=playgroundId]").val();
			$.ajax({
		      type:'GET',
		      url:'/getPlayerSearchResults' ,
		      data:data,
		    	success:function(data){
					//$('#clear_player_filter').fadeIn();
					$("#search-result").removeAttr("style");
		    		playerLoader.fadeOut();
		            $('#search-result').html(data) ;
		            //console.log(data) ;
		         }
		   });
		}else{
			$.ajax({
		      type:'GET',
		      url:'/freshPlayerSearchResults' ,
		      data:{vars:'no'},
		    	success:function(data){
					playerLoader.fadeOut();
					$("#search-result").removeAttr("style");
		            $('#search-result').html(data) ;
		            //console.log(data) ;
		         }
		   });
		}

	});
