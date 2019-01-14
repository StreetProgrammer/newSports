<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller ;

use App\Model\User ;
use App\Model\clubBranche ;
use App\Model\Playground ;
use App\Model\Event ;
use App\Model\Challenge ;
use App\Model\Reservation ;
use App\Model\Sport ;
use App\Model\Country;
use App\Model\Governorate;
use Illuminate\Http\Request;

use App\Model\Filters\PlayerFilters ;
use App\Model\PlaygroundFilters ;

use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{

/* %%%%%%%%%%%%%%%%%%%%%% start of player search for [ players ] %%%%%%%%%%%%%%%%%%%5 */
    public function index($model = '')
    {
		$countries = Country::get();
		$governorate = Governorate::with('areas')->get();
    	switch ($model) {
			case 'player':
			$players = User::where('our_is_active', '=', 1)
						->where('type', '=', 1)
						->where('id', '!=', Auth::id())
						->whereHas('playerProfile',function($query){
							$query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
						}) 
						->get() ;
				//return $players;
				$title = 'Search';
		    	return view('player.search.pages.search', compact('countries', 'governorate','title', 'players', 'model') );
		        break;
		    case 'playground':
		        $playgrounds =  Playground::with('Photos')->where('our_is_active', '=', 1)
		        				->where('is_active', '=', 1)
		        				->get() ; 
		    	return view('player.search.pages.search', compact('countries', 'governorate', 'playgrounds', 'model') );
		        break;
			default:
			$players = User::where('our_is_active', '=', 1)
						->where('type', '=', 1)
						->where('id', '!=', Auth::id())
						->whereHas('playerProfile',function($query){
							$query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
						}) 
						->get() ;
				//return $players;
				$title = 'Search';
		    	return view('player.search.pages.search', compact('countries', 'governorate','title', 'players', 'model') );
		}
    	//return view('player.search.pages.search' );
    }

	/* search for player function */
	public function getPlayerSearchResults(Request $request, PlayerFilters $filters)
	{
		//return $request;
		$countries = Country::get();
		$governorate = Governorate::with('areas')->get();
		$players = User::filter($filters)
						->where('our_is_active', '=', 1)
						->where('type', '=', 1)
						->where('id', '!=', Auth::id())
						->whereHas('playerProfile',function($query){
							$query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
						}) 
						->get() ;
		$title = 'Search';
		$view = view('player.search.pageParts.player-search.player-result', compact('countries', 'governorate','title', 'players', 'model') )->render();
		return response($view);
		//return $users;
	}

	/* fresh player search result for [player] function */
	public function freshPlayerSearchResults(Request $request)
	{
		$countries = Country::get();
		$governorate = Governorate::with('areas')->get();
		$players = User::where('our_is_active', '=', 1)
						->where('type', '=', 1)
						->where('id', '!=', Auth::id())
						->whereHas('playerProfile',function($query){
							$query->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
						}) 
						->get() ;
		//return $players ;	
		$title = 'Search';	
		$view = view('player.search.pageParts.player-search.player-result', compact('countries', 'governorate', 'title', 'players', 'model') )->render();
		return response($view);
		//return $users;
	}

	/* to make reload of player-filter part */
	public function getPlayerFilter()
	{	$countries = Country::get();
		$governorate = Governorate::with('areas')->get();
		return view('player.search.pageParts.player-search.player-filtter', compact('governorate')) ;
	}

/* %%%%%%%%%%%%%%%%%%%%%% end of player search for [ players ] %%%%%%%%%%%%%%%%%%%5 */

	
/* %%%%%%%%%%%%%%%%%%%%%% start of playground search for [ players ] %%%%%%%%%%%%%%%%%%%5 */
/* search for playground function */
	public function getPlaygroundSearchResults(Request $request, PlaygroundFilters $filters)
	{
		//return $request ;
		$playgrounds = Playground::with('Photos')->filter($filters)->get() ;
		//return $playgrounds ;
		$view = view('player.search.pageParts.playground-search.playground-result', compact('playgrounds', 'model') )->render();
		return response($view);
		//return $users;
	}

	/* fresh playground search result for [player] function */
	public function freshPlaygroundSearchResults(Request $request)
	{
		
		$playgrounds =  Playground::with('Photos')->where('our_is_active', '=', 1)
		        				
		        				->get() ;
		//return $playgrounds ;		
		$view = view('player.search.pageParts.playground-search.playground-result', compact('playgrounds', 'model') )->render();
		return response($view);
		//return $playground;
	}

	/* to make reload of playground-filter part */
	public function getPlaygroundFilter()
	{	$governorate = Governorate::with('areas')->get();
		return view('player.search.pageParts.playground-search.playground-filtter', compact('governorate')) ;
	}

	/* %%%%%%%%%%%%%%%%%%%%%% end of playground search for [ players ] %%%%%%%%%%%%%%%%%%%5 */

	
	

}
