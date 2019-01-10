<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller ;
use Storage ;
use App\Model\Filters\EventFilters ;
use App\Model\Filters\ChallengeFilters ;
//use App\Http\Controllers\App\User ;
use App\Model\Sport;
use App\Model\User;
use App\Model\Country;
use App\Model\Governorate;
use App\Model\playerProfile;
use App\Model\Event;
use App\Model\Challenge ;
use App\Model\Reservation ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PlayerProfilesController extends Controller
{
    public function try(Request $request)
    {
        return $request ;
    }
    ////////////////display profile Data //////////////////

     public function index($id)
    {   
        $countries = Country::get(); 

        $governorate = Governorate::with('areas')->where('g_country_id', '=', Auth::user()->playerProfile->p_country)->get();

        $id = sm_crypt($id, 'd') ;

        $createEvents = Event::where('E_creator_id', $id)->with('creator')->get();

        $candidateEvents = Event::where('E_candidate_id', $id)->with('creator')->get();

        $createChallenges = Challenge::where('C_creator_id', $id)->with('creator')->get();

        $candidateChallenges = Challenge::where('C_candidate_id', $id)->with('creator')->get();
        $user = User::find($id) ;
        //$user = User::with('sports')->with('playerProfile')->where('id', Auth::user()->id)->firstOrFail();
        //return $user ;
    	$sports = Sport::with('users')->get() ;

        //dd($sports->users());

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
            $title = $user->name;
            return view('player.profile.pages.playerHisProfile', 
                    compact('title', 'user', 'events', 'sports', 'governorate', 'countries', 'createEvents', 'candidateEvents', 'createChallenges', 'candidateChallenges'));
            //return view('player.profile', compact('user', 'events', 'sports'));
        }else{
            $user = User::with('sports')
                            ->with('playerProfile')
                            ->with('createdEvents.eventSport')
                            ->with('appliedEvents.eventSport')
                            ->where('id', $id)
                            ->firstOrFail();
            //dd($user);
            //return $user ;
            $title = $user->name;
            return view('player.profile.pages.playerHisProfile', 
                    compact('title', 'user', 'events', 'sports', 'governorate', 'countries', 'createEvents', 'candidateEvents', 'createChallenges', 'candidateChallenges'));
            //return view('player.profileForOthers', compact('user', 'sports'));
        }

        abort(404) ;

    }

    //////////////////////////////////////////////////////////////////////////////////
    // start of function to update player profile main info page using ajax
    //////////////////////////////////////////////////////////////////////////////////

    public function editMainInfo(Request $request)
    {   
        //return request() ;
        $status = 'false' ;
        $userData = $this->validate(request(),
                [
                    'name'      => 'required',
                    'email'     => 'required|email|unique:admins,id,' . $request->playerId,
                ],
                [],
                [
                    'name'      => 'Name',
                    'email'     => 'E-mail',
                ]);
        if (request()->has('password')) {
            $userData['password']           =   bcrypt(request('password')) ;
        }
        //return $data
        $userData['user_is_active'] = $request->user_is_active ;
        User::where('id', '=', Auth::user()->id)->update($userData);
        
        
        $playerProfileData = array(
                                    'p_phone'               => $request->p_phone,
                                    'p_country'             => $request->p_country,
                                    'p_city'                => $request->p_city,
                                    'p_area'                => $request->p_area,
                                    'p_address'             => $request->p_address,
                                    'p_gender'              => $request->p_gender,
                                    'p_preferred_gender'    => $request->p_preferred_gender,
                                    'p_born_date'           => $request->p_born_date,
                                    'privacy'               => $request->privacy,
                                    ) ;
        
        playerProfile::where('p_user_id', '=', Auth::user()->id)->update($playerProfileData);
            $status = 'true' ;
        

        return $status ;

    }

    //////////////////////////////////////////////////////////////////////////////////
    // end of function to update player profile main info page using ajax
    //////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////
    // start of function to update player image part of player profile page using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function updatePlayerProfilePhoto(Request $request)
    {
        //return request() ;
        if (Auth::id() == $request->playerId) {
            $oldProfilePhotoPath = Auth::user()->user_img ;
        }

        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name = Auth::id() . '-' . Auth::user()->slug . '-' . time() . '.png';

        $photoDatabaseRecord = "/profilePhotos/" . $image_name;

        Storage::disk('local')->put('public/' . $photoDatabaseRecord, $data);

        /*$path = public_path() . $photoDatabaseRecord ;
        file_put_contents($path, $data);*/

        Storage::has($oldProfilePhotoPath)? Storage::delete($oldProfilePhotoPath) :'' ;

        if (Auth::user()->id == $request->playerId) {
            User::where('id', '=', Auth::user()->id)
                        ->update(array(
                            'user_img' => $photoDatabaseRecord,
                        ));
              return response()->json(['success'=>'done','imgUrl'=>Storage::url(Auth::user()->user_img)]);
        } else {
            return 'failed' ;
        }

    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update player image part of player profile page using ajax
    //////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to update part of playyer profile page using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function getInfo($data = '')
    {
        $vars = explode('-', $data);
        
        $userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
        //return $vars ;

        switch ($model) {
            case "events":

                $events_1 = Event::where('E_creator_id', $vars[0])->with('creator')->get();

                $events_2 = Event::where('E_candidate_id', $vars[0])->with('creator')->get();

                $events = collect($events_1)->concat($events_2)->sortByDesc('created_at') ;

                $user = User::find($vars[0]);

                return view('player.profile.pageParts.playerHisProfile.events', compact('events', 'user'));
                
                break;

            case "challenges":

                $challenges_1 = Challenge::where('C_creator_id', $vars[0])->with('creator')->get();

                $challenges_2 = Challenge::where('C_candidate_id', $vars[0])->with('creator')->get();

                $challenges = collect($challenges_1)->concat($challenges_2)->sortByDesc('created_at') ;
                
                $user = User::find($vars[0]);

                return view('player.profile.pageParts.playerHisProfile.challenges', compact('challenges', 'user'));
                
                break;
            case "middleInfo":

                $createEvents = Event::where('E_creator_id', $vars[0])->with('creator')->get();

                $candidateEvents = Event::where('E_candidate_id', $vars[0])->with('creator')->get();

                $createChallenges = Challenge::where('C_creator_id', $vars[0])->with('creator')->get();

                $candidateChallenges = Challenge::where('C_candidate_id', $vars[0])->with('creator')->get();

                $user = User::find($vars[0]);

                return view('player.profile.pageParts.playerHisProfile.middle-info', 
                        compact('user', 'createEvents', 'candidateEvents', 'createChallenges', 'candidateChallenges'));
                break;
            case "reservations":

                $reservations = Reservation::where('R_creator_id', $vars[0])->with('creator')->get();

                //$reservations_2 = Challenge::where('C_candidate_id', $vars[0])->with('creator')->get();

                //$reservations = collect($reservations_1)->concat($reservations_2)->sortByDesc('created_at') ;

                return view('player.profile.pageParts.playerHisProfile.reservations', compact('reservations'));
                break;
            default:
                echo "Error";
        }
        
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update part of player profile page using ajax
    //////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to update sports model after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function getPlayerSports($id)
    {
        //$user = User::with('sports')->with('playerProfile')->where('id', Auth::user()->id)->firstOrFail();
        //return $user ;
        $sports = Sport::with('users')->get() ;

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
        }
        return view('player.profile.pageParts.playerHisProfile.getPlayerSports', compact('user', 'sports'));
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update sports model after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to update Vacants model after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function getPlayerVacants($id)
    {
        $sports = Sport::with('users')->get() ;

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
        }
        return view('player.profile.pageParts.playerHisProfile.getPlayerVacants', compact('user', 'sports'));
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update Vacants model after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to update new Event model after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function getnewEventModel($id)
    {
        $sports = Sport::with('users')->get() ;

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
        }
        return view('player.profile.pageParts.playerHisProfile.models.addNewEventModel', compact('user', 'sports'));
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update new Event after add new sport using ajax
    //////////////////////////////////////////////////////////////////////////////////
    
    
    // for update player main info div
    public function displayMainInfo($id)
    {   
        //$user = User::with('sports')->with('playerProfile')->where('id', Auth::user()->id)->firstOrFail();
        //return $user ;
        $sports = Sport::with('users')->get() ;
        $countries = Country::get();
		$governorate = Governorate::with('areas')->where('g_country_id', '=', Auth::user()->playerProfile->p_country)->get();

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
        }
        return view('player.profile.pageParts.playerHisProfile.display-MainInfo', compact('user', 'sports', 'governorate', 'countries'));
    }

    // for update player Secondry info div
    public function displaySecondaryInfo($id)
    {   
        //$user = User::with('sports')->with('playerProfile')->where('id', Auth::user()->id)->firstOrFail();
        //return $user ;
        $sports = Sport::with('users')->get() ;
        $countries = Country::get();
        $governorate = Governorate::with('areas')->where('g_country_id', '=', Auth::user()->playerProfile->p_country)->get();

        if (Auth::user()->id == $id) {
            $user = User::with('sports')
                            ->with('createdEvents.eventSport')
                            //->with('createdEvents.Day')
                            ->with('appliedEvents.eventSport')
                            ->where('id', Auth::user()->id)
                            ->firstOrFail();
        }
        return view('player.profile.pageParts.playerHisProfile.Secondary-Info', compact('user', 'sports', 'governorate', 'countries'));
    }

    public function attachSport(Request $request)
    {
        Auth::user()->sports()->attach($request->sportId);
        return 'true' ;
    }

    public function detachSport(Request $request)
    {
        //return $request ;
        $canDelete = 0 ;
        

        $canDelete = self::CanDelete($request->playerId, $request->sportId) ;

        if ($canDelete == 0) {
            Auth::user()->sports()->detach($request->sportId);
            return 'true' ;
        } else {
            return $canDelete ;
        }
        
        return $canDelete ;
    }

    public function updateSportRole(Request $request)
    {
        //return $request ;
        
        if ($request->value == 0) {
            $canDelete = self::CanDelete($request->playerId, $request->sportId, $request->role) ;
            //return $canDelete ;
            if ($canDelete == 0) {
                DB::table('sport_user')
                ->where('user_id', $request->playerId)
                ->where('sport_id', $request->sportId)
                ->update([$request->role => $request->value]);

                $ret = 'true' ;
            } else {
                $ret = 'false' ;
            }
            
            
        } elseif($request->value == 1) {
            DB::table('sport_user')
                ->where('user_id', $request->playerId)
                ->where('sport_id', $request->sportId)
                ->update([$request->role => $request->value]);
            $ret = 'true' ;
        }

        return $ret ;        
    }

    private static function CanDelete($playerId, $sportId, $role = '' )
    {
        //it must check all [player / trainer / referee] if $role == '' ((need to update))
        $candelete = 0 ;
        if ($role == '' || $role == 'as_player') {
            $creatorEvent = Event::where('E_creator_id', $playerId)
                            ->where('E_sport_id', $sportId)
                            ->where('E_JQueryTo', '>=', date("Y-m-d h:i:s"))
                            ->count() ;
            $candidateEvent = Event::where('E_candidate_id', $playerId)
                                ->where('E_sport_id', $sportId)
                                ->where('E_JQueryTo', '>=', date("Y-m-d h:i:s"))
                                ->count() ;
            $creatorChallenge = Challenge::where('C_creator_id', $playerId)
                                ->where('C_sport_id', $sportId)
                                ->where('C_JQueryTo', '>=', date("Y-m-d h:i:s"))
                                ->count() ;
            $candidateChallenge = Challenge::where('C_candidate_id', $playerId)
                                ->where('C_sport_id', $sportId)
                                ->where('C_JQueryTo', '>=', date("Y-m-d h:i:s"))
                                ->count() ;
            $Reservation = Reservation::where('R_creator_id', $playerId)
                                ->where('R_JQueryTo', '>=', date("Y-m-d h:i:s"))
                                ->get() ;
            $reservation = 0 ;
            if ($Reservation->count() > 0) { 
                foreach ($Reservation as $res) {
                    if ($res->playground->c_b_p_sport_id == $sportId) {
                        $reservation = 1 ;
                        break;    /* You could also write 'break 1;' here. */
                    }
                }
            }
            
            $candelete = $creatorEvent + $candidateEvent + $creatorChallenge + $candidateChallenge + $reservation ;

        } elseif($role == 'as_trainer') {
            $candelete =  0 ;
        }elseif($role == 'as_referee') {
            $candelete =  0 ;
        }
        return $candelete ;
    }

    /* *************************************************************************************************************** */
    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to search in my events using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function getMyEventsSearchResults(Request $request, EventFilters $filters)
	{
		
        /* $events = Event::filter($filters)->where('E_creator_id', '=', Auth::id())//->where('E_sport_id', '=', $sport)//->where('E_JQueryFrom', '<', Carbon::now())->orderBy('E_date', 'DESC')->with('creator')->get(); */
        if ($request->has('creator')) {
            // 
            switch ($request->creator) {
                case 1:
                    $events = Event::filter($filters)
                                    ->where('E_creator_id', Auth::id()) 
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();
                    break;
                case 2:
                    $events = Event::filter($filters)
                                    ->where('E_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();
                    break;
                
                default:
                    $events_1 = Event::filter($filters)
                                    ->where('E_creator_id', Auth::id())
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();
                    $events_2 = Event::filter($filters)
                                    ->where('E_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();
                    $events = collect($events_1)->concat($events_2)->sortByDesc('created_at') ;
                    break;
            }
        }else {
            $events_1 = Event::filter($filters)
                                    ->where('E_creator_id', Auth::id()) 
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();

            $events_2 = Event::filter($filters)
                                    ->where('E_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('E_date', 'DESC')->get();

            $events = collect($events_1)->concat($events_2)->sortByDesc('created_at') ;
        }
        
        
		
		$view = view('player.profile.pageParts.playerHisProfile.events.events', compact('events') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to search in my events using ajax
    //////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////
    // start of function to fresh my event result using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function freshMyEventsSearchResults($data = '')
	{   
        //return $data ;
        $vars = explode('-', $data);
		$userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
		$events_1 = Event::where('E_creator_id', $vars[0])->with('creator')->get();

        $events_2 = Event::where('E_candidate_id', $vars[0])->with('creator')->get();

        $events = collect($events_1)->concat($events_2)->sortByDesc('created_at') ;

        $user = User::find($vars[0]);

		//return $events ;		
		$view = view('player.profile.pageParts.playerHisProfile.events.events', compact('events', 'user', 'model') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to fresh my event result using ajax
    //////////////////////////////////////////////////////////////////////////////////

    /* *************************************************************************************************************** */

    /* *************************************************************************************************************** */
    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to search in my events using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function getMyChallenhgesSearchResults(Request $request, ChallengeFilters $filters)
	{
		
        /* $events = Event::filter($filters)->where('E_creator_id', '=', Auth::id())//->where('E_sport_id', '=', $sport)//->where('E_JQueryFrom', '<', Carbon::now())->orderBy('E_date', 'DESC')->with('creator')->get(); */
        if ($request->has('creator')) {
            // 
            switch ($request->creator) {
                case 1:
                    $challenges = Challenge::filter($filters)
                                    ->where('C_creator_id', Auth::id()) 
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();
                    break;
                case 2:
                    $challenges = Challenge::filter($filters)
                                    ->where('C_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();
                    break;
                
                default:
                    $challenges_1 = Challenge::filter($filters)
                                    ->where('C_creator_id', Auth::id())
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();
                    $challenges_2 = Challenge::filter($filters)
                                    ->where('C_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();
                    $challenges = collect($challenges_1)->concat($challenges_2)->sortByDesc('created_at') ;
                    break;
            }
        }else {
            $challenges_1 = Challenge::filter($filters)
                                    ->where('C_creator_id', Auth::id()) 
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();

            $challenges_2 = Challenge::filter($filters)
                                    ->where('C_candidate_id', Auth::id()) 
                                    ->with('creator')->orderBy('C_date', 'DESC')->get();

            $challenges = collect($challenges_1)->concat($challenges_2)->sortByDesc('created_at') ;
        }
        
        
		
		$view = view('player.profile.pageParts.playerHisProfile.challenges.challenges', compact('challenges') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to search in my events using ajax
    //////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////
    // start of function to fresh my event result using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function freshMyChallengesSearchResults($data = '')
	{   
        //return $data ;
        $vars = explode('-', $data);
		$userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
		$challenges_1 = Event::where('C_creator_id', $vars[0])->with('creator')->get();

        $challenges_2 = Event::where('C_candidate_id', $vars[0])->with('creator')->get();

        $challenges = collect($events_1)->concat($events_2)->sortByDesc('created_at') ;

        $user = User::find($vars[0]);

		//return $events ;		
		$view = view('player.profile.pageParts.playerHisProfile.challenges.challenges', compact('challenges', 'user', 'model') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to fresh my event result using ajax
    //////////////////////////////////////////////////////////////////////////////////

    /* *************************************************************************************************************** */

}
