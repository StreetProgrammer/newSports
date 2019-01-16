<?php

Route::get('/newclubregisterview', function () {
	$pending = \App\Model\PendinEgdit::find(3) ;
	return json_decode( $pending->old_data, TRUE ) ;
    //return view('admin.emails.NewClubRegister');
    //return view('admin.emails.NewClubEditRequest');
});
/*/////////////////###############################################///////////////////
* /////////////////////////// START REGISTER A CLUB /////////////////////////////////
/////////////////#################################################//////////////////*/

	//start of routs for register a club with all data enterd [profile info, branches, playgrounds] 

Route::group([ 'middleware' => ['auth'], 'namespace' => 'Club' ], function(){

		/* ## important note ## ====> will use this routes in other place 
		to handle update [ clubprofile - branch - playground ] after complete register */

	// handle Update main info for the club account in register procces
	Route::post('/NewClubProfileCreated', 'ClubProfilesController@NewClubProfileCreated');

	// handle Update main info for the club account in register procces
	Route::post('/updateRegisterClubMainInfo', 'ClubProfilesController@updateRegisterClubMainInfo');

	// handle Update Photo for the club account in register procces
	Route::post('/updateRegisterClubPhoto', 'ClubProfilesController@updateRegisterClubPhoto');
	
	// handle Store Branch for the club account in register procces
	Route::post('club/StoreRegisterClubBranch', 'ClubBranchesController@StoreRegisterClubBranch');

	// handle Delete Branch for the club account in register procces
	Route::post('club/DeleteRegisterClubBranch', 'ClubBranchesController@DeleteRegisterClubBranch');

	// handle Edit Branch for the club account in register procces
	Route::post('club/updateRegisterClubBranch', 'ClubBranchesController@updateRegisterClubBranch');

	// handle Store Playground for the club account in register procces
	Route::post('club/StoreRegisterClubPlayground', 'PlaygroundsController@StoreRegisterClubPlayground');
	
	// handle Delete playground for the club account in register procces
	Route::post('club/DeleteRegisterClubPlayground', 'PlaygroundsController@DeleteRegisterClubPlayground');

	// handle Update Photo for a playground for a club account in register procces
	Route::post('/UpdateRegisterClubPlayground', 'PlaygroundsController@UpdateRegisterClubPlayground');

	// handle Update Photo for a playground for a club account in register procces
	Route::post('/addRegisterPlaygroundPhoto', 'PlaygroundsController@addRegisterPlaygroundPhoto');

	// handle Delete Photo for a playground for a club account in register procces
	Route::post('/DeleteRegisterPlaygroundPhoto', 'PlaygroundsController@DeleteRegisterPlaygroundPhoto');

	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
	// [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
		/* ## important note ## ====> will use this routes in other place 
		to handle update [ clubprofile - branch - playground ] after complete register */

	// Load nav bar [ editMain - manageClub ] view if auth club after register
	Route::get('club/registerPageTop', 'ClubProfilesController@registerPageTop');

	// Load Editable main info for the club account in register procces [[ var when = 'ear' or null ]]
	Route::get('club/editMainRegisterInfo/{when?}', 'ClubProfilesController@editMainRegisterInfo');

	// Load add branch record for the club account in register procces [[ var when = 'ear' or null ]]
	Route::get('club/registerAddBranch/{when?}', 'ClubProfilesController@registerAddBranch');

	// Load Editable branch record for the club account in register procces [[ var when = 'ear' or null ]]
	Route::get('club/{clubBranch}/DisplayEditBranchRegister/{when?}', 'ClubBranchesController@DisplayEditBranchRegister');

	// Load add playground record to {{{clubBranch}}} for the club account in register procces [[ var when = 'ear' or null ]]
	Route::get('club/{clubBranch}/DisplayAddPlaygroundRegister/{when?}', 'PlaygroundsController@DisplayAddPlaygroundRegister');
	
	// Load Editable branch record for the club account in register procces
	Route::get('club/{Playground}/DisplayEditPlaygroundRegister', 'PlaygroundsController@DisplayEditPlaygroundRegister');
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
	// [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//

});

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//	
	//used to add main club info to create user, clubProfile record //first fuction//
	Route::post('/registerClub', 'Club\ClubProfilesController@registerClub'); // final 

	Route::get('/registerAddBranchPlayground', 'Club\ClubProfilesController@registerAddBranchPlayground');

/*/////////////////################################################///////////////////
* /////////////////////////// END REGISTER A CLUB /////////////////////////////////
/////////////////#################################################///////////////////


/*
* ///////////////// START A CLUB OWENR ROUTES ///////////////////
* start of routs for a club with all data enterd [profile info, branches, playgrounds] 
* 
*/

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//
	Route::group([ 'middleware' => ['isActive', 'isClub', 'web'], 'namespace' => 'Club' ], function(){ // login as admin for this links

		// display main info for the club account
		Route::get('club/{id}', 'ClubProfilesController@index');

		Route::get('updateAllData', 'ClubProfilesController@updateAllData');
		/* Route::get('club/updateAllData', function () {
			$governorate  = \App\Model\Governorate::all() ;
			return view('club.Edits.Edits',  compact('governorate'));
		}); */

		// display specific info for the club account
		Route::get('club/{slug}/profile', 'ClubProfilesController@profile');

		Route::post('/editClubActivate/club', 'ClubProfilesController@editClubActivate');

		Route::post('/changeProfilePhoto/club', 'ClubProfilesController@updateClubProfilePhoto');

		Route::post('club/clubProfileEdit', 'ClubProfilesController@updateProfile');

		// Users Routes %%%%%%%%%%% START %%%%%%%%%%%  Users Routes//

		// club users datatable route
		Route::get('club/users/all', 'ClubProfilesController@allUsers');

		// club user create route
		Route::get('club/users/create', 'ClubProfilesController@createUser');

		// club user store route
		Route::post('club/users/store', 'ClubProfilesController@storeUser');

		// club user edit route
		Route::get('club/user/{User}', 'ClubProfilesController@editUser');

		// club user update route
		Route::post('club/user/update/{User}', 'ClubProfilesController@updateUser');

		// club user delete route
		Route::post('club/user/delete/{User}', 'ClubProfilesController@destroyUser');

		// club users multiDelete route
		Route::post('club/user/multiDelete', 'ClubProfilesController@multipleDestroyUsers');

		// Users Routes %%%%%%%%%%% END %%%%%%%%%%%  Users Routes//

		// Branches Routes %%%%%%%%%%% START %%%%%%%%%%%  Branches Routes//

		// club branches datatable route
		Route::get('branches/club', 'ClubBranchesController@index');

		// club branches create route
		Route::get('branches/club/create', 'ClubBranchesController@create');

		// club branches store route
		Route::post('branches/club/store', 'ClubBranchesController@store');

		// club branches show route
		Route::get('branche/club/{clubBranche}', 'ClubBranchesController@show');

		// club branches update route
		Route::post('branches/club/update', 'ClubBranchesController@update');

		// Branches Routes %%%%%%%%%%% END %%%%%%%%%%%  Branches Routes//

		// Playgrounds Routes %%%%%%%%%%% START %%%%%%%%%%%  Playgrounds Routes//

		// club Playgrounds datatable route
		Route::get('playgrounds/club', 'PlaygroundsController@index');

		// club Playgrounds create route
		Route::get('playgrounds/club/create', 'PlaygroundsController@create');

		// club Playgrounds store route
		Route::post('playgrounds/club/store', 'PlaygroundsController@store');

		// club Playgrounds show route
		Route::get('playground/club/{Playground}', 'PlaygroundsController@show');

		// club Playgrounds update route
		Route::post('playgrounds/club/update', 'PlaygroundsController@update');

		// Playgrounds Routes %%%%%%%%%%% END %%%%%%%%%%%  Playgrounds Routes//

		// Reservations Routes %%%%%%%%%%% START %%%%%%%%%%%  Reservations Routes//

		// club Reservations datatable route
		Route::get('reservations/club', 'ReservationController@index');

		// club Reservations create route
		Route::get('reservations/club/create', 'ReservationController@create');

		// club Reservations store route
		Route::post('reservations/club/store', 'ReservationController@store');

		// club Reservations show route
		Route::get('reservation/club/{Reservation}', 'ReservationController@show');

		// club Reservations update route
		Route::post('reservations/club/update', 'ReservationController@update');

		// club Reservations update route
		Route::post('reservations/club/delete', 'ReservationController@delete');

		// Reservations Routes %%%%%%%%%%% END %%%%%%%%%%%  Reservations Routes//

	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
	// [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//

		//for load main info div after update after completed account created
		Route::get('/maininfodivload/club', 'ClubProfilesController@mainInfoDivLoad');

		//for load image info div after update after completed account created
		Route::get('/imageinfodivload/club', 'ClubProfilesController@imageinfodivload');

		//for load main info div after update after completed account created
		Route::get('/branches/{clubBranche}/loadUpdateMainDiv/', 'ClubBranchesController@mainInfoDivLoad');

		//for load image info div after update after completed account created
		Route::get('/branches/{clubBranche}/loadUpdateLogobanner/', 'ClubBranchesController@imagesinfodivload');

		//for load all {{ Playground / manager playgrounds }} reservations
		Route::get('/getplaygroundReservation/{id}/{type}', 'ReservationController@getPlaygroundReservations');

		//for check if that time is avalible or not in playground
		Route::post('/checkVacantTime/', 'ReservationController@checkVacantTime');
		
		
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
	// [[ajaxLoad]] %%%%%%%%%%% partial views %%%%%%%%%%%  [[ajaxLoad]]//
	//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
		
		
	});

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//

/*
* ///////////////// START A CLUB ADMIN ROUTES ///////////////////
* start of routs for register a club with all data enterd [profilr info, branches, playgrounds] 
* 
*/

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//

/*
* ///////////////// START A CLUB MANAGERS ROUTES ///////////////////
* start of routs for register a club with all data enterd [profile info, branches, playgrounds] 
* 
*/

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&//
	// helper route to toggle languages
	Route::get('lang/{lang}', function ($lang) {
		session()->has('lang')?session()->forget('lang'):'';
		$lang == 'ar'?session()->put('lang', 'ar'):session()->put('lang', 'en');
		return back();
	});

//});


Route::get('logout', 'Club\ClubProfilesController@logout');

