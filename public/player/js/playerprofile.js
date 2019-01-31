//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////// start change tabs and contents ///////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".evechares", function (e) {
  if ($(this).hasClass('tab-li-focus')) { //this is the start of our condition
    jQuery.fn.shake = function () {
    
        $(this).css({
          "position": "relative"
        });
        for (var x = 1; x <= 3; x++) {
          $(this).animate({
            left: -10
          }, 10).animate({
            left: 0
          }, 50).animate({
            left: 10
          }, 10).animate({
            left: 0
          }, 50);
        }
      return this;
    }
     setTimeout(function () {
      //$('#event-data-display').load('/getInfo/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
      $('.tab-li-focus').shake();
    }, 500); 

  }else{
      var type = $(this).attr('id');
      var user_id = $("input[name=user_id]").val();
      ////alert(filter) ;
      $('.' + type).show();

      if ($(this).hasClass('tab-li')) { //this is the start of our condition 
        $('.control-tab-class span.evechares').addClass('tab-li');
        $('.control-tab-class span.evechares').removeClass('tab-li-focus');
        $(this).removeClass('tab-li');
        $(this).addClass('tab-li-focus');

        //var type = 'evechares' ;
        var sport = 0;

        setTimeout(function () {
          $('#event-data-display').load('/getInfo/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
          $('.' + type).hide();
        }, 1000);

      }
  }
  
});
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// start change tabs and contents //////////////////
/////////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////
$(document).on('click', ".event", function (e) {
	var filter = $(this).attr('id');
	var user_id = $("input[name=user_id]").val() ;
	////alert(filter) ;
	$('.' + filter).show();

	if($(this).hasClass('tab-li')){ //this is the start of our condition 
	    $('.col-xs-3 span.event').addClass('tab-li');
	    $('.col-xs-3 span.event').removeClass('tab-li-focus');           
	    $(this).removeClass('tab-li');
	    $(this).addClass('tab-li-focus');

	    var type = 'event' ;
	    var sport = 0 ;

	    setTimeout(function(){ 
	    	$('#event-data-display').load('/getInfo/' + user_id+ '-' + type + '-' + filter + '-' + sport).fadeIn('slow');
	    	$('.' + filter).hide();
	    }, 1000);

	}
});

//////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
//////////////////start of proccess of profile image crop and upload///////////////
/////////////////////////////////////////////////////////////////////////////////

// start proccess of profile image crop and upload
  $image_crop = $('#player_photo').croppie({
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
  });

  $(document).on('change', "#upload", function () {

    var reader = new FileReader();
    reader.onload = function (event) {
      $image_crop.croppie('bind', {
        url: event.target.result
      }).then(function(){
        console.log('jQuery bind complete');
      });
    }
    reader.readAsDataURL(this.files[0]);
    ////alert('done') ;
    $('#uploadimageModal').modal('show');
    setTimeout(function () {
      //$('#uploadimageModal').modal('hide');
      var upload = $("#upload");
      upload.val('');
    }, 1000);
  });
  // End proccess of profile image crop and upload

  //$('.crop_image').click(function(event){
  $(document).on('click', ".crop_image", function (event) {
    $('.imageInfo').css('opacity', '0.6');
    $('#imageInfoLoader').fadeIn();
    $image_crop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
      var _token = $("input[name=_token]").val();
      var playerId = $("input[name=playerId]").val();
      $.ajax({
        url:"/player/changeProfilePhoto",
        type: "POST",
        data:{
          "image": response,
          "_token":_token,
          'playerId':playerId
        },
        success:function(data)
        {
          var upload = $("#upload");
          upload.val('');
          //upload.replaceWith( upload = upload.clone( true ) );
          
          $('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
          $('#imageInfoLoader').fadeOut();
          $('.imageInfo').css('opacity', '1');
          $('#uploadimageModal').modal('hide');
          //$('.imageInfoLoader').fadeOut();
          console.log(data.imgUrl);
        }
      });
    })
  });


/////////////////////////////////////////////////////////////////////////////////
//////////////////end of proccess of profile image crop and upload///////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of update main profile info/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#updatePlayerMainInfo", function (e) {
  $('#editMainInfoMessage').fadeOut();
  e.preventDefault();
  var errors = 0 ;
  
  var name = $("input[name=name]").val();

    if(name.replace(/\s/g,"") === ""){

          errors = 1;
        $("input[name=name]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("input[name=name]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }

  var p_phone = $("input[name=p_phone]").val();

    if(p_phone.replace(/\s/g,"") === ""){

        // errors = 1;
        $("input[name=p_phone]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("input[name=p_phone]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }

    var email = $("input[name=email]").val();

    if(email.replace(/\s/g,"") === ""){

        errors = 1;
        $("input[name=email]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("input[name=email]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }

    var p_country = $("select[name=p_country]").val();

    if(p_country.replace(/\s/g,"") === ""){

        errors = 1;
        $("select[name=p_country]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("select[name=p_country]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }

    // var p_city = $("select[name=p_city]").val();
    var p_city = $("select[name=p_city]").val() === null || $("select[name=p_city]").val() === "" ? 0 : $("select[name=p_city]").val();

    /*if(p_city.replace(/\s/g,"") === ""){

        // errors = 1;
        $("select[name=p_city]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("select[name=p_city]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }*/

    var p_area = $("select[name=p_area]").val() === null || $("select[name=p_area]").val() === "" ? 0 : $("select[name=p_area]").val();

    /*if(p_area.replace(/\s/g,"") === ""){

        //errors = 1;
        $("select[name=p_area]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("select[name=p_area]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }*/
    var p_address = $("input[name=p_address]").val();

    if(p_address.replace(/\s/g,"") === ""){

          // errors = 1;
        $("input[name=p_address]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

    }else{
        $("input[name=p_address]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
    }

    var password = $("input[name=password]").val();

    if(password.replace(/\s/g,"") === ""){

          //errors = 1;
        $("input[name=password]").css({border: '2px solid #e80f0f',background: '#b2e8b2'});

    }else{
      
      if (password.length < 6) {
        errors = 1;
          $("input[name=password]").css({border: '2px solid #e80f0f',background: '#f7e7e7'});

      } else {
        $("input[name=p_address]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      }
      
    }

    if(errors === 0){
      $('.profileInfo').css('opacity', '0.6');
      $('#profileInfoLoader').fadeIn();

      $("input[name=name]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("input[name=p_phone]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("input[name=email]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("select[name=p_area]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("select[name=p_city]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("select[name=p_country]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("input[name=p_address]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      $("input[name=password]").css({border: '2px solid #5cb85c',background: '#b2e8b2'});
      var _token = $("input[name=_token]").val();
      var playerId = $("input[name=playerId]").val();
      var p_gender = $("input[name=p_gender]:checked").val();
      var p_preferred_gender = $("input[name=p_preferred_gender]:checked").val();
      var user_is_active = $("input[name=user_is_active]:checked").val();
      var privacy = $("input[name=privacy]:checked").val();
      var p_born_date = $("input[name=p_born_date]").val();
      $.ajax({
          type:'POST',
          url:'/player/editMainInfo',

          data:{
                playerId:playerId,
                _token:_token,
                name:name,
                email:email,
                p_phone:p_phone,
                p_country:p_country,
                p_city:p_city,
                p_area:p_area,
                p_address:p_address,
                p_gender:p_gender,
                p_preferred_gender:p_preferred_gender,
                p_born_date:p_born_date,
                password:password,
                user_is_active:user_is_active,
                privacy: privacy,
             },
             success:function(data){
              console.log(data) ;
                if (data === 'true') {
                  $('.profileInfo').css('opacity', '1');
                  $('#profileInfoLoader').fadeOut();
                  $('#editMainInfoModal').modal('hide');                
                  $('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
                }else if(data === 'false') {
                    $('.profileInfo').css('opacity', '1');
                    $('#profileInfoLoader').fadeOut();
                    setTimeout(function() {
                      $('#editMainInfoMessage').show(800);
                    }, 2000);
                    setTimeout(function() {
                        $('#editMainInfoMessage').hide();
                    }, 10000);
                }

             }
       });

    }else{

      setTimeout(function() {
        $('#editMainInfoMessage').show(800);
      }, 2000);
    setTimeout(function() {
          $('#editMainInfoMessage').hide();
      }, 10000);
    }

});
/////////////////////////////////////////////////////////////////////////////////
////////////////////end of update main profile info/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of player attach Sport/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('change','#sportToAdd', function() {
	$('#sportsInfoLoader').fadeIn();
	var sportId = $(this).find('option:selected').val() ;
	var playerId = $("input[name=playerId]").val();
	var _token = $("input[name=_token]").val();
	if (sportId != '') {
		$.ajax({
	      type:'POST',
	      url:'/player/attachSport' ,
	      data:{
             	_token:_token,
             	sportId:sportId,
             	playerId:playerId,
         },
	    	success:function(data){
	    		////alert(sportId)
				$('#sportToAdd').find('[value="' + sportId + '"]').remove();
	    		$('#sportsInfoLoader').fadeOut();
	    		$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
	    		$('#getPlayerSports').load('/getPlayerSports/player/' + playerId);
          $('#addNewEventModel').load('/getnewEventModel/player/' + playerId);
	    		$('#sportseditModal').modal('show');
	            console.log(data) ;
	            //$('#AddGameLoading').hide();
	            
	         }
	   });
		
	}

});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of player attach Sport/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of player detach Sport/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".detachSport", function () {

		var err = 0 ;
		var sportId = this.id ;
		var playerId = $("input[name=playerId]").val();
		
		////alert(sportId) ;
		$('#sportsInfoLoader').fadeIn();
		var _token = $("input[name=_token]").val();

		$.ajax({
	      type:'POST',
	      url:'/player/detachSport' ,
	      data:{
             	_token:_token,
             	sportId:sportId,
             	playerId:playerId,
         },
	    	success:function(data){
	    		$('#sportsInfoLoader').fadeOut();
	    		if (data == 'true') {
	    			$('#' + sportId ).parent().parent().parent().hide();
  					//$('#' + sportId +'_sport_div').fadeOut();
  					$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
  					$('#getPlayerSports').load('/getPlayerSports/player/' + playerId);
            $('#addNewEventModel').load('/getnewEventModel/player/' + playerId);

	    		} else {
	    			$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
					   $('#getPlayerSports').load('/getPlayerSports/player/' + playerId);
             $('#addNewEventModel').load('/getnewEventModel/player/' + playerId);
	    			setTimeout(function() {
			        $('#errors').show(800);
				    }, 2000);
	    			setTimeout(function() {
				        $('#errors').hide();
				    }, 20000);
	    		}
	    		$('#sportsInfoLoader').fadeOut();
	            ////alert(data);
	            console.log(data) ;
	            //$('#AddGameLoading').hide();
	            
	         }
	   });

	});
/////////////////////////////////////////////////////////////////////////////////
////////////////////end of player detach Sport/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of player update Sport Role [player - trainer - refree]/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('change','.sport_role', function() {
	var data =  new Array() ;
	var id = this.id ;
	var res = id.split("_");
	data['sport_id'] = res[0] ;
	data['role'] = res[1] ;
	if($( "#" + id ).is(":checked")){
		data['value'] = '1' ;
	}else{
		data['value'] = '0' ;
	}
	console.log(data);

	var playerId = $("input[name=playerId]").val();
	var _token = $("input[name=_token]").val();

	$.ajax({
      type:'POST',
      url:'/player/updateSportRole' ,
      data:{
         	_token:_token,
         	sportId:data['sport_id'] = res[0] ,
         	playerId:playerId,
         	role:data['role'] = 'as_' + res[1] ,
         	value:data['value'],
     },
    	success:function(data){
    		if (data == 'true') {
    			$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerSports').load('/getPlayerSports/player/' + playerId);
    		} else if(data == 'false') {
    			$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerSports').load('/getPlayerSports/player/' + playerId);
    			//$('#errors').fadeIn();
    			setTimeout(function() {
			        $('#sportErrors').show(800);
			    }, 2000);
    			setTimeout(function() {
			        $('#sportErrors').hide();
			    }, 20000);
    		}
    		
            console.log(data) ;
            
         }
   });

});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of player update Sport Role [player - trainer - refree]/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of add player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#addNewVacantTime", function (e) {
	e.preventDefault() ;
	$('#vacantInfoLoader').fadeIn();
	var err = 0 ;
	var day  =  $("select[name=day]").val();
	if (day == null || day == "" ) {
		err = 1 ;
	}
	var from  =  $("select[name=from]").val();
	if (from == null || from == "" ) {
		err = 1 ;
	}
	var to    =  $("select[name=to]").val();
	if (to == null || to == "" ) {
		err = 1 ;
	}
	var diff = parseInt(to) - parseInt(from) ;
	if ( Math.sign(diff) != 1 ) {
		err = 1
	}
	////alert( date + ' ' + from + ' ' + to);
	////alert(err) ;
	if(err == 0){
		var _token = $("input[name=_token]").val();
		var playerId = $("input[name=playerId]").val();
		$.ajax({
	      type:'POST',
	      url:'/Vacant/Add' ,
	      data:{
             	_token:_token,
             	playerId:playerId,
             	day:day,
             	from:from,
             	to:to,
         },
	    	success:function(data){
	    		if (data == 'true') {
            $('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
	    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
	    		} else if(data == 'false') {
            $('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
	    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
	    			//$('#errors').fadeIn();
	    			setTimeout(function() {
				        $('#vacantErrors').show(800);
				    }, 2000);
	    			setTimeout(function() {
				        $('#vacantErrors').hide();
				    }, 10000);
	    		}
    		
            console.log(data) ;
	    		$('#vacantInfoLoader').fadeOut();
	            ////alert(data);
	            console.log(data) ;
	            //$('#AddGameLoading').hide();
	            
	         }
	   });
	}else{
		$('#vacantInfoLoader').fadeOut();
		setTimeout(function() {
	        $('#vacantErrors').show(800);
	    }, 2000);
		setTimeout(function() {
	        $('#vacantErrors').hide();
	    }, 10000);
	}
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of add player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of delete player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".delVacant", function (e) {
	e.preventDefault() ;
	$('#vacantInfoLoader').fadeIn();
	var id = this.id ;
	vacantTimeId = id.substr(0, id.indexOf('_'));
	var _token = $("input[name=_token]").val();
	var playerId = $("input[name=playerId]").val();
	$.ajax({
      type:'POST',
      url:'/Vacant/Delete' ,
      data:{
         	_token:_token,
         	playerId:playerId,
         	vacantTimeId:vacantTimeId,
     },
    	success:function(data){
    		if (data == 'true') {
    			$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
    		} else if(data == 'false') {
    			$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
    			//$('#errors').fadeIn();
    			setTimeout(function() {
			        $('#vacantErrors').show(800);
			    }, 2000);
    			setTimeout(function() {
			        $('#vacantErrors').hide();
			    }, 10000);
    		}
		
        console.log(data) ;
    		$('#vacantInfoLoader').fadeOut();
            ////alert(data);
            console.log(data) ;
            //$('#AddGameLoading').hide();
            
         }
   });
	
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of delete player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of edit player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".editVacant", function (e) {
	e.preventDefault() ;
	$('#vacantInfoLoader').fadeIn();
	var id = this.id ;
	vacantTimeId = id.substr(0, id.indexOf('_'));
	////alert(vacantTimeId);
	var _token = $("input[name=_token]").val();
	var playerId = $("input[name=playerId]").val();
	$.ajax({
      type:'POST',
      url:'/Vacant/Edit' ,
      data:{
         	_token:_token,
         	playerId:playerId,
         	vacantTimeId:vacantTimeId,
     },
    	success:function(data){
    		if (data == 'true') {
    			$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
    		} else if(data == 'false') {
    			$('#display-SecondaryInfo').load('/displaySecondaryInfo/player/' + playerId).fadeIn('slow');
    			$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
    			//$('#errors').fadeIn();
    			setTimeout(function() {
			        $('#vacantErrors').show(800);
			    }, 2000);
    			setTimeout(function() {
			        $('#vacantErrors').hide();
			    }, 10000);
    		}
		
        console.log(data) ;
    		$('#vacantInfoLoader').fadeOut();
            ////alert(data);
            console.log(data) ;
            //$('#AddGameLoading').hide();
            
         }
   });
	
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of edit player vacant time /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////
////////////////////start of add new Event /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#addNewEvent", function () {
  
  $('#eventInfoLoader').fadeIn();
  var err = 0 ;

  var date  =  $("input[name=E_date]").val();

  var currentDate = new Date();

  var Cdate = currentDate.getDate();
  var Cmonth = currentDate.getMonth(); //Be careful! January is 0 not 1
  var Cyear = currentDate.getFullYear();

  var dateString = Cdate + "-" +(Cmonth + 1) + "-" + Cyear;

  if (date == null || date == "" || date < dateString) {
    // err = 1 ;
  }
  var from  =  $("select[name=E_from]").val();
  if (from == null || from == "" ) {
    err = 1 ;
  }
  var to    =  $("select[name=E_to]").val();
  if (to == null || to == "" ) {
    err = 1 ;
  }
  var diff = parseInt(to) - parseInt(from) ;
  if ( Math.sign(diff) != 1 ) {
    err = 1 ;
  }
  //err = 0;
  ////alert(Math.sign(diff));
  if(err == 0){
    var _token        =   $("input[name=_token]").val();
    var playerId    =   $("input[name=playerId]").val();
    var preferred_rate  =   $("input[name=preferred_rate]").val();
    var sport_id    =   $("select[name=sport_id]").val();
    $.ajax({
        type:'POST',
        url:'/Event/Add',
        data:{
              _token:_token,
              playerId:playerId,
              E_preferred_rate:preferred_rate,
              E_sport_id:sport_id,
              E_date:date,
              E_from:from,
              E_to:to,
         },
        success:function(data){
          console.log(data) ;
          if (data == 'true') {
            $('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
            //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
            setTimeout(function() {
                $('#eventErrors').show(800);
                $('#eventErrorsSuccess').show();
            }, 2000);
            setTimeout(function() {
                $('#eventErrors').hide();
                $('#eventErrorsSuccess').hide();
            }, 10000);
          } else if(data == 'false') {
            $('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
            //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
            //$('#errors').fadeIn();
            setTimeout(function() {
                $('#eventErrors').show(800);
                $('#eventErrorsFaild').show();
            }, 2000);
            setTimeout(function() {
                $('#eventErrors').hide();
                $('#eventErrorsFaild').hide();
            }, 10000);
          }
        
              console.log(data) ;
          $('#eventInfoLoader').fadeOut();
              console.log(data) ;   
           }
     });
  }else{
    //alert('done');
    setTimeout(function() {
          $('#eventErrors').show(800);
          $('#eventErrorsFaild').show();
      }, 2000);
    setTimeout(function() {
          $('#eventErrors').hide();
          $('#eventErrorsFaild').hide();
      }, 10000);
      $('#eventInfoLoader').fadeOut();
  }
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////////// start of add new Event ///////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of add new Challenge /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#addNewChallenge", function () {
  
  $('#challengeInfoLoader').fadeIn();
  var err = 0 ;

  var date  =  $("input[name=C_date]").val();
  
  var currentDate = new Date();

  var Cdate = currentDate.getDate();
  var Cmonth = currentDate.getMonth(); //Be careful! January is 0 not 1
  var Cyear = currentDate.getFullYear();

  var dateString = Cdate + "-" +(Cmonth + 1) + "-" + Cyear;


  if (date == null || date == "" || date < dateString ) {
    //err = 1 ;
  }
  var from  =  $("select[name=C_from]").val();
  if (from == null || from == "" ) {
    err = 1 ;
  }
  var to    =  $("select[name=C_to]").val();
  if (to == null || to == "" ) {
    err = 1 ;
  }
  var diff = parseInt(to) - parseInt(from) ;
  if ( Math.sign(diff) != 1 ) {
    err = 1 ;
  }
  //err = 0;
  ////alert(Math.sign(diff));
  if(err == 0){
    var _token        =   $("input[name=_token]").val();
    var playerId    =   $("input[name=playerId]").val();
    var sport_id    =   $("select[name=sport_id]").val();
    $.ajax({
        type:'POST',
        url:'/Challenge/Add',
        data:{
              _token:_token,
              playerId:playerId,
              C_sport_id:sport_id,
              C_date:date,
              C_from:from,
              C_to:to,
         },
        success:function(data){
          console.log(data) ;
          if (data == 'true') {
            //$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
            //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
            setTimeout(function() {
                $('#challengeErrors').show(800);
                $('#challengeErrorsSuccess').show();
            }, 2000);
            setTimeout(function() {
                $('#challengeErrors').hide();
                $('#challengeErrorsSuccess').hide();
            }, 10000);
          } else if(data == 'false') {
            //$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
            //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
            //$('#errors').fadeIn();
            setTimeout(function() {
                $('#challengeErrors').show(800);
                $('#challengeErrorsFaild').show();
            }, 2000);
            setTimeout(function() {
                $('#challengeErrors').hide();
                $('#challengeErrorsFaild').hide();
            }, 10000);
          }
        
              console.log(data) ;
          $('#challengeInfoLoader').fadeOut();
              console.log(data) ;   
           }
     });
  }else{
    //alert('done');
    setTimeout(function() {
          $('#challengeErrors').show(800);
          $('#challengeErrorsFaild').show();
      }, 2000);
    setTimeout(function() {
          $('#challengeErrors').hide();
          $('#challengeErrorsFaild').hide();
      }, 10000);
      $('#challengeInfoLoader').fadeOut();
  }
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of add new Challenge /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Start Search in my events //////////////////
/////////////////////////////////////////////////////////////////////////////////////

/* to get search results and display it  */
$(document).on('click', "#myEvents_filter", function () {
  $("#myEventsResult").css("filter", "blur(2px)");
  //$("#search-filtter").css("filter", "blur(2px)");
  var id = this.id;

  var myEventsLoader = $("#myEventsloader");
  myEventsLoader.show();
  $("#myEventsResult").css("filter", "blur(2px)");
  var data = {};
  // var sport = $("input[name=sport_id]").val();
  // var user_is_active = $("input[name=user_is_active]:checked").val();
  var creator_in = $("input[name=" + id + "_creator]:checked").val();
  // alert(creator_in);
  // if (creator_in !== null && creator_in !== "" && creator_in.replace(/\s/g, "") !== "") {
  if ( creator_in != 3 ) {
    var creator = creator_in;
    data['creator'] = creator;
  }

  //var winner_in = $("input[name=" + id + "_winner]").val();
  var winner_in = $("input[name=" + id + "_winner]:checked").val();
  //alert(winner_in);
  //if (winner_in !== null && winner_in !== "" && winner_in.replace(/\s/g, "") !== "") {
  if (winner_in != 5) {
    var winner = winner_in;
    data['winner'] = winner;
  }

  var candidate_in = $("input[type=text][name=" + id + "_candidate]").val();
  //alert(candidate_in);
  if (candidate_in !== null && candidate_in !== "" && candidate_in.replace(/\s/g, "") !== "") {
    var candidate = candidate_in;
    data['candidate'] = candidate;
  }
  var date_in = $("input[type=date][name=" + id + "_date]").val();
  //alert(date_in);
  if (date_in !== null && date_in !== "" && date_in.replace(/\s/g, "") !== "") {
    var date = date_in;
    data['date'] = date;
  }

  var from_in = $("select[name=" + id + "_from]").val();
  if (from_in != null && from_in != "") {
    var from = from_in;
    data['from'] = from;
  }
  var to_in = $("select[name=" + id + "_to]").val();
  if (to_in != null && to_in != "") {
    var to = to_in;
    data['to'] = to;
  }

  console.log(jQuery.isEmptyObject(data) ? 'empty' : data);
  alert(data);
  if (jQuery.isEmptyObject(data) == false) {
    data['sport'] = sport;
    $('.reCheckLoader').fadeIn();
    //var _token = $("input[name=_token]").val();
    //var playgroundId = $("input[name=playgroundId]").val();
    $.ajax({
      type: 'GET',
      url: '/getMyEventsSearchResults/',
      data: data,
      success: function (data) {
        $("#myEventsResult").removeAttr("style");
        myEventsLoader.fadeOut();
        $('#myEventsResult').html(data);
        console.log(data);
      }
    });
  } else {
    var type = $(this).attr('id');
    var user_id = $("input[name=user_id]").val();
    var sport = $("input[name=sport_id]").val();
    //alert(type + '  ' + user_id + '   ' + sport);
    setTimeout(function () {
      $('#myEventsResult').load('/freshMyEventsSearchResults/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
      $('.' + type).hide();
      $("#myEventsResult").removeAttr("style");
      myEventsLoader.fadeOut();
    }, 1000);

  }

});

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// End Search in my events //////////////////
/////////////////////////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Start Search in my challenges //////////////////
/////////////////////////////////////////////////////////////////////////////////////

/* to get search results and display it  */
$(document).on('click', "#myChallenges_filter", function () {
  $("#myChallengesResult").css("filter", "blur(2px)");
  //$("#search-filtter").css("filter", "blur(2px)");
  var id = this.id;

  var myChallengesLoader = $("#myChallengesloader");
  myChallengesLoader.show();
  //$("#myEventsResult").css("filter", "blur(2px)");
  var data = {};
  // var sport = $("input[name=sport_id]").val();
  // var user_is_active = $("input[name=user_is_active]:checked").val();
  var creator_in = $("input[name=" + id + "_creator]:checked").val();
  // alert(creator_in);
  // if (creator_in !== null && creator_in !== "" && creator_in.replace(/\s/g, "") !== "") {
  if (creator_in != 3) {
    var creator = creator_in;
    data['creator'] = creator;
  }

  //var winner_in = $("input[name=" + id + "_winner]").val();
  var winner_in = $("input[name=" + id + "_winner]:checked").val();
  //alert(winner_in);
  //if (winner_in !== null && winner_in !== "" && winner_in.replace(/\s/g, "") !== "") {
  if (winner_in != 5) {
    var winner = winner_in;
    data['winner'] = winner;
  }

  var candidate_in = $("input[type=text][name=" + id + "_candidate]").val();
  //alert(candidate_in);
  if (candidate_in !== null && candidate_in !== "" && candidate_in.replace(/\s/g, "") !== "") {
    var candidate = candidate_in;
    data['candidate'] = candidate;
  }
  var date_in = $("input[type=date][name=" + id + "_date]").val();
  //alert(date_in);
  if (date_in !== null && date_in !== "" && date_in.replace(/\s/g, "") !== "") {
    var date = date_in;
    data['date'] = date;
  }

  var from_in = $("select[name=" + id + "_from]").val();
  if (from_in != null && from_in != "") {
    var from = from_in;
    data['from'] = from;
  }
  var to_in = $("select[name=" + id + "_to]").val();
  if (to_in != null && to_in != "") {
    var to = to_in;
    data['to'] = to;
  }

  console.log(jQuery.isEmptyObject(data) ? 'empty' : data);
  alert(data);
  if (jQuery.isEmptyObject(data) == false) {
    data['sport'] = sport;
    $('.reCheckLoader').fadeIn();
    //var _token = $("input[name=_token]").val();
    //var playgroundId = $("input[name=playgroundId]").val();
    $.ajax({
      type: 'GET',
      url: '/getMyChallenhgesSearchResults/',
      data: data,
      success: function (data) {
        $("#myChallengesResult").removeAttr("style");
        myChallengesLoader.fadeOut();
        $('#myChallengesResult').html(data);
        console.log(data);
      }
    });
  } else {
    var type = $(this).attr('id');
    var user_id = $("input[name=user_id]").val();
    var sport = $("input[name=sport_id]").val();
    //alert(type + '  ' + user_id + '   ' + sport);
    setTimeout(function () {
      $('#myChallengesResult').load('/freshMyChallengesSearchResults/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
      $('.' + type).hide();
      $("#myChallengesResult").removeAttr("style");
      myChallengesLoader.fadeOut();
    }, 1000);

  }

});

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// End Search in my challenges //////////////////
/////////////////////////////////////////////////////////////////////////////////////