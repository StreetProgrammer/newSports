<?php

Route::get('/themeHome', function (){
    symlink('/home4/mind/public_html/sports-mate.net/SportsMate/storage/app/public', '/home4/mind/public_html/sports-mate.net/storage') ;
});
Route::get('/try', function (){
    //return view('club.Reports.Pages.template');
    $pdf = \PDF::loadView('club.Reports.Pages.template');
    return $pdf ->download('try.pdf');

}); 
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//***************** start routes for [ Home - static pages ] **************//

Route::get('/', 'HomeController@index'); // final

Route::get('/privacy_policy', 'HomeController@privacy_policy'); // final
Route::get('/social_media_disclosure', 'HomeController@social_media_disclosure'); // final
Route::get('/terms_of_service', 'HomeController@terms_of_service'); // final

Route::get('/faq', 'HomeController@faq'); // final
Route::get('/videos', 'HomeController@videos'); // final
Route::get('/contactus', 'HomeController@contactus'); // final

//************************ start routes for [ Home - static pages ]********************//

Route::get('/olfat', function () {
    //$user = App\User::with('roles')->first();
    $userModel = '\App\Model\User' ;

    $newReords= [
        'name' => 'Taha Mostafa Ali',
        'email' => 'tahamostfa8@gmail.com'
    ];

    $Model = $userModel::with('sports.playgrounds')->find(21);

    foreach ($newReords as $key => $record) {
        $Model->$key = $record;
    }
    

    $Model->save();
    return $Model;
});
//////////////////////////start register [ club / player ] //////////////////////
Auth::routes();
Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// to display preregister options [ club / player ] as acomplete page // final
Route::get('/preregister', function () {
    return view('auth/preRegister');
});

// used to redirect to register page depending on type [ club / player ] // final 
Route::any('/handlepreregister',function(){
    $type = $_GET['type'];
    if ($type == 1) {
        return redirect('register');
    } elseif ($type == 2) {
        $countries = \App\Model\Country::get();
        $governorate = \App\Model\governorate::with('areas')->get();
            return View::make("club.register.reghome", compact('governorate', 'countries'));
    } else {
        return 3 ;
    }
})->middleware('clubRegister');
//////////////////////////start register [ club / player ] ///////////////////////

Route::get('/home', 'HomeController@index')->name('home'); // final

Route::post('/contactus', 'ContactusController@contactus'); // final


//////////////////////////// start social login routes////////////////////////////////
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');
//////////////////////////// end social login routes////////////////////////////////
Route::group(['middleware' => ['isActive', 'isPlayer', 'web'],'namespace' => 'Player'], function(){
//***************** routes for Notifications **************//
Route::post('/newNotiCount', 'NotificationController@newNotiCount'); // final
Route::post('/deleteNoti', 'NotificationController@deleteNoti'); // final
Route::post('/deleteAllNoti', 'NotificationController@deleteAllNoti'); // final
Route::post('/markAsReadNoti', 'NotificationController@markAsReadNoti'); // final
Route::post('/markAllAsReadNoti', 'NotificationController@markAllAsReadNoti'); // final
Route::get('/getNoti', 'NotificationController@getNoti'); // final
//***************** routes for Notifications **************//

//***************** routes for search **************//
    Route::get('/search/{model?}', 'SearchController@index'); // final
    
    Route::get('/getPlayerSearchResults', 'SearchController@getPlayerSearchResults'); // final

    Route::get('/freshPlayerSearchResults', 'SearchController@freshPlayerSearchResults'); // final

    Route::get('/getPlayerFilter', 'SearchController@getPlayerFilter'); // final

    Route::get('/getPlaygroundSearchResults', 'SearchController@getPlaygroundSearchResults'); // final

    Route::get('/freshPlaygroundSearchResults', 'SearchController@freshPlaygroundSearchResults'); // final

    Route::get('/getPlaygroundFilter', 'SearchController@getPlaygroundFilter'); // final
//**********************************************************************//

    //***************** routes for Players **************//

    Route::get('/profile/{id}', 'PlayerProfilesController@index'); // final
    Route::post('/player/changeProfilePhoto', 'PlayerProfilesController@updatePlayerProfilePhoto'); //final
    Route::post('/player/editMainInfo', 'PlayerProfilesController@editMainInfo'); //final
    Route::post('/player/attachSport', 'PlayerProfilesController@attachSport'); //final
    Route::post('/player/detachSport', 'PlayerProfilesController@detachSport'); //final
    Route::post('/player/updateSportRole', 'PlayerProfilesController@updateSportRole'); //final


    //**********************************************************************//


    //***************** start routes for clubs *********************************//

    Route::get('/Club/{id}', 'ClubController@index'); //final
    //=======================================================================//

    //***************** routes for playgrounds **************//

    Route::get('/Playground/{id}', 'PlaygroundsController@index'); // final
    //**********************************************************************//


    //***************** routes for Sports **************//

    Route::post('/Sports/{Sport}/Add', 'SportsController@AddToUser');

    Route::get('/Sport/{Sport?}', 'SportsController@index'); // final

    Route::get('/getNewEventsSearchResults', 'SportsController@getNewEventsSearchResults'); // final

    Route::get('/freshNewEventsSearchResults', 'SportsController@freshNewEventsSearchResults'); // final

    Route::get('/getMyEventsSearchResults', 'PlayerProfilesController@getMyEventsSearchResults'); // final

    Route::get('/freshMyEventsSearchResults/{data}', 'PlayerProfilesController@freshMyEventsSearchResults'); // final

    Route::get('/getMyChallenhgesSearchResults', 'PlayerProfilesController@getMyChallenhgesSearchResults'); // final

    Route::get('/freshMyChallengesSearchResults/{data}', 'PlayerProfilesController@freshMyChallengesSearchResults'); // final

    Route::get('/getSportPlayersSearchResults', 'SportsController@getSportPlayersSearchResults'); // final

    Route::get('/freshSportPlayersSearchResults/{data}', 'SportsController@freshSportPlayersSearchResults'); // final
    //**********************************************************************//

    //***************** routes for Sports **************//

    Route::get('/Club/id}', 'SportsController@index'); // final

    //**********************************************************************//


    //***************** routes for Event  **************//

    Route::get('/Event/Show/{id}', 'EventController@index'); // final

    Route::post('/Event/Add', 'EventController@Add'); // final

    Route::post('/Event/Apply', 'EventController@Apply'); // final

    Route::post('/Event/AcceptApplicant', 'EventController@AcceptApplicant'); // final

    Route::post('/Event/SuggestPlayground', 'EventController@SuggestPlayground'); //final

    Route::post('/Event/AcceptRejectPlayground', 'EventController@AcceptRejectPlayground'); // final

    Route::post('/Event/{Event}/refuseSuggestedPlayground', 'EventController@refuseSuggestedPlayground');

    Route::post('/Event/{Event}/SuggestResult', 'EventController@SuggestResult');

    Route::post('/Event/{Event}/AcceptOrRefuseSuggestedResult', 'EventController@AcceptOrRefuseSuggestedResult');

    Route::post('/Event/{Event}/refuseSuggestedResult', 'EventController@refuseSuggestedResult');

    //**********************************************************************//

    //***************** routes for Challenge  **************//

    Route::get('/Challenge/Show/{id}', 'ChallengeController@index'); // final

    Route::post('/Challenge/Add', 'ChallengeController@Add'); // final

    Route::post('/Challenge/AcceptRejectchallenge', 'ChallengeController@AcceptRejectchallenge'); // final

    Route::post('/Challenge/AcceptRejectPlayground', 'ChallengeController@AcceptRejectPlayground'); // final

    Route::post('/Challenge/SuggestPlayground', 'ChallengeController@SuggestPlayground'); //final

    Route::post('/Challenge/AcceptRejectPlayground', 'ChallengeController@AcceptRejectPlayground'); // final

    Route::post('/Challenge/{User}/Save', 'ChallengeController@Save');
    //**********************************************************************//


    //***************** Start routes for SubEvent  **************//

    Route::post('/SubEvent/{Event}/Add', 'SubEventController@AddSubEvent'); // final
    Route::post('/SubEvent/{SubEvent}/DeleteGame', 'SubEventController@deleteSuggestedGame'); // final
    Route::post('/SubEvent/{SubEvent}/RefuseGame', 'SubEventController@refuseSuggestedGame'); // final
    Route::post('/SubEvent/{SubEvent}/AcceptGame', 'SubEventController@acceptSuggestedGame'); // final
    //**********************************************************************//
    //rate %%%%%%%%%%% partial views %%%%%%%%%%% rate//
    Route::get('/Event/{Event}/Games', 'SubEventController@EventGames');
    //rate %%%%%%%%%%% partial views %%%%%%%%%%% rate//
    //*******************End routes for SubEvent***************************//


//***************** Start routes for Reservation  **************//
    // Player Reservations store route
	Route::post('reservations/player/store', 'ReservationController@store');

    Route::post('/Reservation/{Playground}/Add', 'ReservationController@Save');
//***************** Start routes for Reservation  **************//


    //***************** routes for Vacant Times **************//

    Route::post('/Vacant/Add', 'VacantTimeController@Add'); // final

    Route::post('/Vacant/Edit', 'VacantTimeController@Edit'); // final

    Route::post('/Vacant/Delete', 'VacantTimeController@Delete'); // final

    //**********************************************************************//

    //***************** routes for Rate **************//
    Route::post('/AddPlayerRate', 'RateController@AddPlayerRate'); // final
    //Route::post('/Rate/{Event}/Add', 'RateController@AddPlayerRate');

    //Route::get('/Rate/{Event}/Add', 'RateController@AddPlayerRate');

    //Route::post('/Rate/{Event}/Add', 'RateController@AddPlayerRate');

    //rate %%%%%%%%%%% partial views %%%%%%%%%%% rate//
    Route::get('/Event/{Event}/Result', 'RateController@EventResult');
    //rate %%%%%%%%%%% partial views %%%%%%%%%%% rate//

    //**********************************************************************//


    //***************** routes for Governorates  **************//


    //**********************************************************************//


    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
    // [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//

    // **********************************player profile ***********************//
        //for load main info div after update after completed account created
        Route::get('/getInfo/{data}', 'PlayerProfilesController@getInfo'); // final
        
        //for load main info div after update after completed account created
        Route::get('/displayMainInfo/player/{id}', 'PlayerProfilesController@displayMainInfo'); // final

        //for load Secondry info div after update after completed account created
        Route::get('/displaySecondaryInfo/player/{id}', 'PlayerProfilesController@displaySecondaryInfo'); // final

        //for load part of sports model after update sport
        Route::get('/getPlayerSports/player/{id}', 'PlayerProfilesController@getPlayerSports'); // final

        //for load part of vacant model after update vacants
        Route::get('/getPlayerVacants/player/{id}', 'PlayerProfilesController@getPlayerVacants'); // final

        //for load part of vacant model after update vacants
        // Route::get('/getPlayerVacants/player/{id}', 'PlayerProfilesController@getPlayerVacants'); // final

        //for load part of vacant model after update vacants
        Route::get('/getnewEventModel/player/{id}', 'PlayerProfilesController@getnewEventModel'); // final
        
    // **********************************player profile ***********************//
    // ********************************** event page ***********************//
        //for load event applicants div 
        Route::get('/event/applicants/{id}', 'EventController@getApplicants'); // final

        //for load event creator div
        Route::get('/event/creator/{id}', 'EventController@getCreator'); // final

        //for load event candidate div
        Route::get('/event/candidate/{id}', 'EventController@getCandidate'); // final

        //for load event Sport Playgrounds div
        Route::get('/event/eventSportPlaygrounds/{id}', 'EventController@getEventSportPlaygrounds'); // final

        //for load event Sport Playgrounds div
        Route::get('/event/suggestedPlaygrounds/{id}', 'EventController@getSuggestedPlaygrounds'); // final

        //for load event result div
        Route::get('/event/eventResult/{id}', 'EventController@getEventResult'); // final

        //for load event winner div
        Route::get('/event/eventWinner/{id}', 'EventController@geteventWinner'); // final
    // ********************************** event page ***********************//

    // ********************************** challenge page ***********************//
        //for load challenge applicants div 
        Route::get('/challenge/applicants/{id}', 'ChallengeController@getApplicants'); // final

        //for load challenge creator div
        Route::get('/challenge/creator/{id}', 'ChallengeController@getCreator'); // final

        //for load challenge candidate div
        Route::get('/challenge/candidate/{id}', 'ChallengeController@getCandidate'); // final

        //for load challenge Sport Playgrounds div
        Route::get('/challenge/challengeSportPlaygrounds/{id}', 'ChallengeController@getchallengeSportPlaygrounds'); // final

        //for load challenge Sport Playgrounds div
        Route::get('/challenge/suggestedPlaygrounds/{id}', 'ChallengeController@getSuggestedPlaygrounds'); // final

        //for load challenge result div
        Route::get('/challenge/challengeResult/{id}', 'ChallengeController@getChallengeResult'); // final

        //for load challenge winner div
        Route::get('/challenge/challengeWinner/{id}', 'ChallengeController@getChallengeWinner'); // final
    // ********************************** challenge page ***********************//
    // ********************************** playground page ***********************//
        Route::get('/playerPlaygroundReservation/{id}/{type}', 'ReservationController@playerPlaygroundReservation');
        
        //for check if that time is avalible or not in playground
        Route::post('/player/checkVacantTime/', 'ReservationController@checkVacantTime'); // final

    //********************************** playground page ***********************//

    // ********************************** sport page ***********************//
        Route::get('/sport-getInfo/{data}', 'SportsController@sportGetInfo');

        Route::get('/freshNewEventsSearchResults/{data}', 'SportsController@freshNewEventsSearchResults');

    //********************************** sport page ***********************//

    
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
    // [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
    //%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
            
    
});
// Route::get('/governorate/{Governorate}', 'GovernorateController@GetAreas');

Route::group(['namespace' => 'Player'], function(){
    Route::get('/governorate/{Governorate}', 'GovernorateController@GetAreas');
    Route::get('/country/{Country}', 'CountryController@GetGovernorate');
});