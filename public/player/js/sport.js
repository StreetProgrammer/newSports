

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

    } else {
        var type = $(this).attr('id');
        var user_id = $("input[name=user_id]").val();
        var sport = $("input[name=sport_id]").val();
        ////alert(filter) ;
        $('.' + type).show();

        if ($(this).hasClass('tab-li')) { //this is the start of our condition 
            $('.control-tab-class span.evechares').addClass('tab-li');
            $('.control-tab-class span.evechares').removeClass('tab-li-focus');
            $(this).removeClass('tab-li');
            $(this).addClass('tab-li-focus');

            //var type = 'evechares' ;

            setTimeout(function () {
                $('#changeable').load('/sport-getInfo/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
                $('.' + type).hide();
            }, 1000);

        }
    }

});
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// end change tabs and contents //////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Start Search in new events //////////////////
/////////////////////////////////////////////////////////////////////////////////////

/* to get search results and display it  */
$(document).on('click', "#newEvents_filter", function () {
    $("#newEventsResult").css("filter", "blur(2px)");
    //$("#search-filtter").css("filter", "blur(2px)");
    var id = this.id;
    
    var newEventsLoader = $("#newEventsloader");
    newEventsLoader.show();
    $("#newEventsResult").css("filter", "blur(2px)");
    var data = {};
    var sport = $("input[name=sport_id]").val();

    var creator_in = $("input[type=text][name=" + id + "_creator]").val();
    //alert(creator_in);
    if (creator_in !== null && creator_in !== "" && creator_in.replace(/\s/g, "") !== "") {
        var creator = creator_in;
        data['creator'] = creator;
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

    var date_in = $("input[type=date][name=" + id + "_date]").val();
    if (date_in != null && date_in != "") {
        var date = date_in;
        data['date'] = date;
    }

    console.log(jQuery.isEmptyObject(data) ? 'empty' : data);
    //alert(data);
    if (jQuery.isEmptyObject(data) == false) {
        data['sport'] = sport;
        $('.reCheckLoader').fadeIn();
        //var _token = $("input[name=_token]").val();
        //var playgroundId = $("input[name=playgroundId]").val();
        $.ajax({
            type: 'GET',
            url: '/getNewEventsSearchResults/',
            data: data,
            success: function (data) {
                $("#newEventsResult").removeAttr("style");
                newEventsLoader.fadeOut();
                $('#newEventsResult').html(data);
                console.log(data);
            }
        });
    } else {
        var type = $(this).attr('id');
        var user_id = $("input[name=user_id]").val();
        var sport = $("input[name=sport_id]").val();
        setTimeout(function () {
            $('#newEventsResult').load('/freshNewEventsSearchResults/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
            $('.' + type).hide();
            $("#newEventsResult").removeAttr("style");
            newEventsLoader.fadeOut();
        }, 1000);

    } 

});

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// End Search in new events //////////////////
/////////////////////////////////////////////////////////////////////////////////////

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
    var sport = $("input[name=sport_id]").val();

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
/////////////////////////////////// End Search in sport players //////////////////
/////////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#player_filters", function () {
    $("#playersSearchResult").css("filter", "blur(2px)");
    //$("#search-filtter").css("filter", "blur(2px)");
    var id = this.id;

    var playerLoader = $("#" + id + "_loader");
    playerLoader.show();
    $("#playersSearchResult").css("filter", "blur(2px)");
    var data = {};

    var name_in = $("input[type=text][name=" + id + "_name]").val();
    if (name_in !== null && name_in !== "" && name_in.replace(/\s/g, "") !== "") {
        var name = name_in;
        data['name'] = name;
    }
    var sport_in = $("select[name=" + id + "_sport]").val();
    if (sport_in != null && sport_in != "") {
        var sport = sport_in;
        data['sport'] = sport;
    }
    var gender_in = $("input[type=radio][name=" + id + "_gender]:checked").val();
    if (gender_in != null && gender_in != "") {
        var gender = gender_in;
        data['gender'] = gender;
    }
    var preferred_gender_in = $("input[type=radio][name=" + id + "_preferred_gender]:checked").val();
    if (preferred_gender_in != null && preferred_gender_in != "") {
        var preferred_gender = preferred_gender_in;
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

    console.log(jQuery.isEmptyObject(data) ? 'empty' : data);
    //alert(err) ;
    if (jQuery.isEmptyObject(data) == false) {
        $('.reCheckLoader').fadeIn();
        var sport = $("input[name=sport_id]").val();
        data['sport'] = sport;
        var _token = $("input[name=_token]").val();
        var playgroundId = $("input[name=playgroundId]").val();
        $.ajax({
            type: 'GET',
            url: '/getSportPlayersSearchResults',
            data: data,
            success: function (data) {
                //$('#clear_player_filter').fadeIn();
                $("#playersSearchResult").removeAttr("style");
                playerLoader.fadeOut();
                $('#playersSearchResult').html(data);
                console.log(data);
            }
        });
    } else {
        var type = $(this).attr('id');
        var user_id = $("input[name=user_id]").val();
        var sport = $("input[name=sport_id]").val();
        //alert(type + '  ' + user_id + '   ' + sport);
        setTimeout(function () {
            $('#playersSearchResult').load('/freshSportPlayersSearchResults/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
            $('.' + type).hide();
            $("#playersSearchResult").removeAttr("style");
            playerLoader.fadeOut();
        }, 1000);
    }

});
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// End Search in sport players //////////////////
/////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of add new Event /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#addNewEvent", function () {

    $('#eventInfoLoader').fadeIn();
    var err = 0;

    var date = $("input[name=E_date]").val();

    var currentDate = new Date();

    var Cdate = currentDate.getDate();
    var Cmonth = currentDate.getMonth(); //Be careful! January is 0 not 1
    var Cyear = currentDate.getFullYear();

    var dateString = Cdate + "-" +(Cmonth + 1) + "-" + Cyear;

    if (date == null || date == "" ) {
        err = 1;
    }
    var from = $("select[name=E_from]").val();
    if (from == null || from == "") {
        err = 1;
    }
    var to = $("select[name=E_to]").val();
    if (to == null || to == "") {
        err = 1;
    }
    var diff = parseInt(to) - parseInt(from);
    if (Math.sign(diff) != 1) {
        err = 1;
    }
    //err = 0;
    ////alert(Math.sign(diff));
    if (err == 0) {
        var _token = $("input[name=_token]").val();
        var playerId = $("input[name=playerId]").val();
        var preferred_rate = $("input[name=preferred_rate]").val();
        var sport_id = $("select[name=sport_id]").val();
        $.ajax({
            type: 'POST',
            url: '/Event/Add',
            data: {
                _token: _token,
                playerId: playerId,
                E_preferred_rate: preferred_rate,
                E_sport_id: sport_id,
                E_date: date,
                E_from: from,
                E_to: to,
            },
            success: function (data) {
                console.log(data);
                if (data == 'true') {
                    setTimeout(function () {
                        $('#changeable').load('/sport-getInfo/' + playerId + '-sportInfo-' + '-' + sport_id).fadeIn('slow');
                        $('.' + type).hide();
                    }, 1000);
                    //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
                    setTimeout(function () {
                        $('#eventErrors').show(800);
                        $('#eventErrorsSuccess').show();
                    }, 2000);
                    setTimeout(function () {
                        $('#eventErrors').hide();
                        $('#eventErrorsSuccess').hide();
                    }, 10000);
                } else if (data == 'false') {
                    //$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
                    //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
                    //$('#errors').fadeIn();
                    setTimeout(function () {
                        $('#eventErrors').show(800);
                        $('#eventErrorsFaild').show();
                    }, 2000);
                    setTimeout(function () {
                        $('#eventErrors').hide();
                        $('#eventErrorsFaild').hide();
                    }, 10000);
                }

                console.log(data);
                $('#eventInfoLoader').fadeOut();
                console.log(data);
            }
        });
    } else {
        //alert('done');
        setTimeout(function () {
            $('#eventErrors').show(800);
            $('#eventErrorsFaild').show();
        }, 2000);
        setTimeout(function () {
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
//////////////////// /start of apply to a new Event /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', ".apply", function () {
    $('#applyLoader').fadeIn();
    var params = this.id;
    var params = params.split("_");
    var eventId = params[0];
    var playerId = params[1];
    alert(eventId);
    alert(playerId);
    $('#applyLoader').fadeOut();
    var _token = $("input[name=_token]").val();
    $.ajax({
        type: 'POST',
        url: '/Event/Apply',
        data: {
            _token: _token,
            playerId: playerId,
            eventId: eventId
        },
        success: function (data) {
             var type = $(this).attr('id');
             var user_id = $("input[name=user_id]").val();
             var sport = $("input[name=sport_id]").val();
             setTimeout(function () {
                 $('#newEventsResult').load('/freshNewEventsSearchResults/' + user_id + '-' + type + '-' + '-' + sport).fadeIn('slow');
                 $('.' + type).hide();
                 $("#newEventsResult").removeAttr("style");
             }, 1000);
            /*  if (data == 'true') {

            } else if (data == 'false') {}

            console.log(data);
            $('#applyLoader').fadeOut();
            console.log(data); */
        }
    }); 

});

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of apply to a new Event /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of add new Challenge /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

$(document).on('click', ".openChallengeModel", function () {
    var id = this.id;
    $("input[name=target]").val(id);
    //alert($("input[name=target]").val());
});

$(document).on('click', "#addNewChallenge", function () {

    $('#challengeInfoLoader').fadeIn();
    var err = 0;

    var date = $("input[name=C_date]").val();
    if (date == null || date == "" || date < Date.now()) {
        err = 1;
    }
    var from = $("select[name=C_from]").val();
    if (from == null || from == "") {
        err = 1;
    }
    var to = $("select[name=C_to]").val();
    if (to == null || to == "") {
        err = 1;
    }
    var diff = parseInt(to) - parseInt(from);
    if (Math.sign(diff) != 1) {
        err = 1;
    }
    //err = 0;
    ////alert(Math.sign(diff));
    if (err == 0) {
        var _token = $("input[name=_token]").val();
        var playerId = $("input[name=target]").val();
        var sport_id = $("select[name=sport_id]").val();
        $.ajax({
            type: 'POST',
            url: '/Challenge/Add',
            data: {
                _token: _token,
                playerId: playerId,
                C_sport_id: sport_id,
                C_date: date,
                C_from: from,
                C_to: to,
            },
            success: function (data) {
                console.log(data);
                if (data == 'true') {
                    //$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
                    //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
                    setTimeout(function () {
                        $('#challengeErrors').show(800);
                        $('#challengeErrorsSuccess').show();
                    }, 2000);
                    setTimeout(function () {
                        $('#challengeErrors').hide();
                        $('#challengeErrorsSuccess').hide();
                    }, 10000);
                } else if (data == 'false') {
                    //$('#display-MainInfo').load('/displayMainInfo/player/' + playerId).fadeIn('slow');
                    //$('#getPlayerVacants').load('/getPlayerVacants/player/' + playerId);
                    //$('#errors').fadeIn();
                    setTimeout(function () {
                        $('#challengeErrors').show(800);
                        $('#challengeErrorsFaild').show();
                    }, 2000);
                    setTimeout(function () {
                        $('#challengeErrors').hide();
                        $('#challengeErrorsFaild').hide();
                    }, 10000);
                }

                console.log(data);
                $('#challengeInfoLoader').fadeOut();
                console.log(data);
            }
        });
    } else {
        //alert('done');
        setTimeout(function () {
            $('#challengeErrors').show(800);
            $('#challengeErrorsFaild').show();
        }, 2000);
        setTimeout(function () {
            $('#challengeErrors').hide();
            $('#challengeErrorsFaild').hide();
        }, 10000);
        $('#challengeInfoLoader').fadeOut();
    }
});

/////////////////////////////////////////////////////////////////////////////////
////////////////////end of add new Challenge /////////////////////////////
/////////////////////////////////////////////////////////////////////////////////