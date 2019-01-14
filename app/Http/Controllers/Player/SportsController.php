<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller ;
use App\Model\User;
use App\Model\Sport;
use App\Model\Event;
use App\Model\Country;
use App\Model\Governorate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Model\Filters\EventFilters ;
use App\Model\Filters\PlayerFilters ;

use Illuminate\Http\Request;

class SportsController extends Controller
{

	public function index($id = '')
	{

		$id = sm_crypt($id, 'd') ;
		/*if ($id == '') {


			$Sports = Sport::with('users')->get() ;

			//return $Sports ; 
			return view('sports.sportsShow', compact('Sports')) ;

		}*/


		$Sport = Sport::with('users')
						->with('sportEvents')
						->find($id) ;
		//return $Sport ;
		if ($Sport == null) {
			abort(404) ;
		}
		
        //return $Sport ;
        $title = $Sport->en_sport_name ;
		return view('player.sport.pages.sport', compact('title', 'Sport')) ;
	}

    public function AddToUser(Sport $Sport)
    {
    	$request = request() ;

        $Sport->AddUser($request) ;

        return back() ;
 		
	}
	
	///////////////////////////////////////////////////////////////////////////////////
    // start of function to update sporte page div#changeablee using ajax
    //////////////////////////////////////////////////////////////////////////////////
    public function sportGetInfo($data = '')
    {
        //return $data ;
        $countries = Country::get();
		$governorate = Governorate::with('areas')->get();
        $vars = explode('-', $data);
        
        $userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
        //return $vars ;

        switch ($model) {
            case "events":

                $new_events = Event::where('E_creator_id', '!=', $vars[0])
                                ->where('E_sport_id', '=', $vars[3])
								//->where('E_JQueryFrom', '<', Carbon::now())
								->whereHas('creator',function($query){
									//$query->where('id','!=', Auth::id());
									/*$query->whereHas('playerProfile',function($query){
                                        $query->where('p_country', '=', Auth::user()->playerProfile->p_country)
                                        ->where('p_city', '=', Auth::user()->playerProfile->p_city)
                                        ->where('p_city', '=', Auth::user()->playerProfile->p_city);
									});*/
                                })
                                ->orderBy('E_date', 'DESC')
								->with('creator')
                                ->get();
                $my_events = Event::where('E_creator_id', '=', $vars[0])
                                ->where('E_sport_id', '=', $vars[3])
								//->where('E_JQueryFrom', '<', Carbon::now())
                                ->orderBy('E_date', 'DESC')
								->with('creator')
								->get();

                return view('player.sport.pageParts.sport.events', compact('new_events', 'my_events'));
                
                break;
            case "players":
                $players = User::where('our_is_active', '=', 1)
                                ->where('type', '=', 1)
                                ->where('id', '!=', Auth::id())
                                ->whereHas('playerProfile',function($query){
                                    $query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
                                })
                                ->whereHas('sports',function($query) use($sport){
                                    $query->where('sports.id', '=', $sport);
                                })
                                ->get();
                
                //return $players ;
                return view('player.sport.pageParts.sport.players', compact('countries', 'governorate', 'players'));
                
                break;
            case "challenges":

                $challenges_1 = Challenge::where('C_creator_id', $vars[0])->with('creator')->get();

                $challenges_2 = Challenge::where('C_candidate_id', $vars[0])->with('creator')->get();

                $challenges = collect($challenges_1)->concat($challenges_2)->sortByDesc('created_at') ;
                

                return view('player.profile.pageParts.playerHisProfile.challenges', compact('challenges'));
                
                break;

            case "sportInfo":
				$Sport = Sport::with('users')->with('sportEvents')->find($sport) ;

                return view('player.sport.pageParts.sport.sportInfo', compact('countries', 'governorate', 'Sport'));
            default:
                echo "Error";
        }
        
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to update sport page div#changeable using ajax
    //////////////////////////////////////////////////////////////////////////////////

    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to search in sport new events using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function getNewEventsSearchResults(Request $request, EventFilters $filters)
	{
		
        $new_events = Event::filter($filters)
                        ->where('E_creator_id', '!=', Auth::id())
                        //->where('E_sport_id', '=', $sport)
                        //->where('E_JQueryFrom', '<', Carbon::now())
                        
                        ->orderBy('E_date', 'DESC')
                        ->with('creator')
                        ->get();

		
		$view = view('player.sport.pageParts.sport.events.newEvents.newEventsResult', compact('new_events') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to search in sport new events using ajax
    //////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////
    // start of function to fresh new event result using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function freshNewEventsSearchResults($data = '')
	{
        //return $data ;
        $vars = explode('-', $data);
		$userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
		$new_events = Event::where('E_creator_id', '!=', Auth::id())
                        ->where('E_sport_id', '=', $vars[3])
                        //->where('E_JQueryFrom', '<', Carbon::now())
                        ->whereHas('creator',function($query){
                            $query->whereHas('playerProfile',function($query){
                                $query->where('p_country', '=', Auth::user()->playerProfile->p_country)
                                ->where('p_city', '=', Auth::user()->playerProfile->p_city)
                                ->where('p_area', '=', Auth::user()->playerProfile->p_area);
                            });
                        })
                        ->orderBy('E_date', 'DESC')
                        ->with('creator')
                        ->get();
		//return $events ;		
		$view = view('player.sport.pageParts.sport.events.newEvents.newEventsResult', compact('new_events', 'model') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to fresh new event result using ajax
    //////////////////////////////////////////////////////////////////////////////////
/* *************************************************************************************************************** */
    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to search in sport my events using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function getMyEventsSearchResults(Request $request, EventFilters $filters)
	{
		
        $my_events = Event::filter($filters)
                        ->where('E_creator_id', '=', Auth::id())
                        //->where('E_sport_id', '=', $sport)
                        //->where('E_JQueryFrom', '<', Carbon::now())
                        ->orderBy('E_date', 'DESC')
                        ->with('creator')
                        ->get();

		
		$view = view('player.sport.pageParts.sport.events.myEvents.myEventsResult', compact('my_events') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to search in sport my events using ajax
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
		$my_events = Event::where('E_creator_id', '=', Auth::id())
                        ->where('E_sport_id', '=', $vars[3])
                        //->where('E_JQueryFrom', '<', Carbon::now())
                        ->orderBy('E_date', 'DESC')
                        ->with('creator')
                        ->get();
		//return $events ;		
		$view = view('player.sport.pageParts.sport.events.myEvents.myEventsResult', compact('my_events', 'model') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to fresh my event result using ajax
    //////////////////////////////////////////////////////////////////////////////////

    /* *************************************************************************************************************** */
    ///////////////////////////////////////////////////////////////////////////////////
    // start of function to search in players using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function getSportPlayersSearchResults(Request $request, PlayerFilters $filters)
	{
		$countries = Country::get();
		$governorate = Governorate::with('areas')->get();
        /*$players = User::filter($filters)
                        ->where('id', '!=', Auth::id())
                        ->whereHas('playerProfile',function($query){
                                    $query->where('p_country', '=', Auth::user()->playerProfile->p_country)
                                    ->where('p_city', '=', Auth::user()->playerProfile->p_city)
									->where('p_area', '=', Auth::user()->playerProfile->p_area)
									->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
								}) 
                        ->whereHas('sports',function($query) use($sport){
                            $query->where('sports.id', '=', $sport);
                        }) 
                        ->get(); */
        $players = User::filter($filters)
                        ->where('our_is_active', '=', 1)
                        ->where('type', '=', 1)
                        ->where('id', '!=', Auth::id())
                        ->whereHas('playerProfile',function($query){
                            $query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
                        })
                        ->get();

		
		$view = view('player.sport.pageParts.sport.players.playersSearch.playerSearchResult', compact('countries', 'governorate', 'players') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to search in players using ajax
    //////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////
    // start of function to fresh players result using ajax
    //////////////////////////////////////////////////////////////////////////////////
	public function freshSportPlayersSearchResults($data = '')
	{
        //return $data ;
        $countries = Country::get();
		$governorate = Governorate::with('areas')->get();
        $vars = explode('-', $data);
		$userId     = $vars[0] ;
        $model      = $vars[1] ;
        $filter     = $vars[2] ;
        $sport      = $vars[3] ;
		$players = User::where('our_is_active', '=', 1)
                                ->where('type', '=', 1)
                                ->where('id', '!=', Auth::id())
                                ->whereHas('playerProfile',function($query){
                                    $query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
                                })
                                ->whereHas('sports',function($query) use($sport){
                                    $query->where('sports.id', '=', $sport);
                                })
                                ->get();
		//return $events ;		
		$view = view('player.sport.pageParts.sport.players.playersSearch.playerSearchResult', compact('countries', 'governorate', 'players', 'model') )->render();
		return response($view);
		//return $users;
    }
    ///////////////////////////////////////////////////////////////////////////////////
    // end of function to fresh players result using ajax
    //////////////////////////////////////////////////////////////////////////////////

}
