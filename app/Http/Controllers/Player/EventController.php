<?php

namespace App\Http\Controllers\Player;

use App\Http\Controllers\Controller ;
use App\Notifications\player\newEvent;
use App\Notifications\player\newEventApplier;
use App\Notifications\player\EventCandidate;
use App\Notifications\player\SuggestPlayground;
use App\Notifications\player\AcceptRejectPlayground;

use DateTime;

use DB ;

use App\Model\Event;
use App\Model\SubEvent;
use App\Model\User;
use App\Model\Sport;
use App\Model\Playground;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
	/*
	* function to get one event by id
	*/
	public function index($id) // final
	{
		$id = sm_crypt($id, 'd') ;
		//return $id ;
		$event = Event::with('Applicants')
							->with('ratings')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;

		$CreatorGames =  SubEvent::where('mainEvent_id', '=', $event->id)
                                    ->where('mainEvent_type', '=', 'event')
									->where('S_E_winer_id', '=', $event->E_creator_id)
									->whereHas('SubEventResult', function ($query) {
                                        $query->where('E_R_YesOrNo', '=', 2);
                                    })
                                    ->count();

        $CandidateGames =  SubEvent::where('mainEvent_id', '=', $event->id)
                                    ->where('mainEvent_type', '=', 'event')
									->where('S_E_winer_id', '=', $event->E_candidate_id)
									->whereHas('SubEventResult', function ($query) {
                                        $query->where('E_R_YesOrNo', '=', 2);
                                    })
                                    ->count();
		//return $event ;
		$title = 'Match' ;
		return view('player.event.pages.event', compact('title','event','E_result', 'CreatorGames', 'CandidateGames')) ;
		
	}


//%%%%%%%%%%%%%%%%%%% End of Event playground functions %%%%%%%%%%%%%%%%%%//

//%%%%%%%%%%%%%%%%%%% start of Event Result functions %%%%%%%%%%%%%%%%%%//

	// function to handle suggest A Result !!!
	public function SuggestResult(Event $Event)
	{
		$request = request() ;

		//return $request ;

		$Event->SuggestResult($request) ;

		return back() ;
	}


//%%%%%%%%%%%%%%%%%%% End of Event Result functions %%%%%%%%%%%%%%%%%%//

	/*
    * function to load patrial view after A player give A rate to Ather player
    */
    public function EventResult(Event $Event)
    {
        $Event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($Event) ;
        //$Event = json_encode($Event) ;
        return $Event ;

        return view('event.parts.EventPart_1', compact('Event')) ;
    }


//%%%%%%%%%%%%%%%%%%% start of Event final functions %%%%%%%%%%%%%%%%%%//

	/*
	* function for add new event
	*/    
    public function Add(Request $request) // final
    {
		//return $request ;
    	$E_JQueryFrom = new DateTime($request->E_date);

		$E_JQueryFrom->modify('+' . $request->E_from . ' hour');

		$E_JQueryTo = new DateTime($request->E_date);

		$E_JQueryTo->modify('+' . $request->E_to . ' hour');

		if (Auth::user()->id == $request->playerId) {

			$day = date("l", strtotime(request()->E_date));// to get day name to check if in user vacant time
			//to get day id and store it to check if in user vacant time and for relations
			$E_day = DB::table('days')->where('day_format', '=', $day)->first() ;
			//return $E_day->day_id ;

			$event = Event::create([
						   'E_creator_id'        		=> Auth::user()->id,
						   'E_sport_id'      			=> $request->E_sport_id,
						   'E_preferred_rate'			=> $request->E_preferred_rate,
						   'E_date'    					=> $request->E_date,
						   'E_day'        				=> $E_day->day_id ,
						   'E_from'        				=> $request->E_from,
						   'E_to'        				=> $request->E_to,
						   'E_JQueryFrom'        		=> $E_JQueryFrom->format('Y-m-d H-i-s'),
						   'E_JQueryTo'        			=> $E_JQueryTo->format('Y-m-d H-i-s') ,
						]);
		}

		if ($event) {
			$creator = User::find(Auth::user()->id);
			// $users = Sport::find($request->E_sport_id)->users->except($creator->id);
			$sport = $request->E_sport_id ;
			// used to add sport to player if not exist
			$sportExists = Auth::user()->sports->contains($sport) ? 'true' : 'false';
			if ($sportExists == 'false') {
				Auth::user()->sports()->attach($sport);
			}
			$users = User::where('id', '!=', Auth::id())
                        ->whereHas('playerProfile',function($query){
                                    $query->where('p_country', '=', Auth::user()->playerProfile->p_country)
                                    //->where('p_city', '=', Auth::user()->playerProfile->p_city)
									//->where('p_area', '=', Auth::user()->playerProfile->p_area)
									->whereIn('p_preferred_gender', [0, 3, Auth::user()->playerProfile->p_gender]);
								}) 
                        ->whereHas('sports',function($query) use($sport){
                            $query->where('sports.id', '=', $sport);
                        })
                        ->get();
			//$users->notify(new newEvent($creator, $event));
			\Notification::send($users, new newEvent($creator, $event));

			return 'true' ;
		} else {
			return 'false' ;
		}	
    }

    /*
	* function for apply on an event
	*/
    public function Apply(Request $request) // final
    {
    	$event = Event::find($request->eventId);
		$res =  $event->AddApplicant($request) ; // function decleared inside [[ Event ]] model
		if ($res == 'true') {
			// used to add sport to player if not exist
			$sportExists = Auth::user()->sports->contains($event->E_sport_id) ? 'true' : 'false';
			if ($sportExists == 'false') {
				Auth::user()->sports()->attach($event->E_sport_id);
			}
			
			$users = User::find($event->E_creator_id) ;

			$creator = User::find(Auth::id());

			//$users->notify(new newEvent($creator, $event));
			\Notification::send($users, new newEventApplier($creator, $event));

			return 'true' ;
		} else {
			return 'false' ;
		}	
    }

     /*
	* function for Accept applier for event
	*/
    public function AcceptApplicant(Request $request) // final
    {
    	$event = Event::find($request->eventId);

		$res =   $event->AcceptApplicant($request) ; // function decleared inside [[ Event ]] model
		if ($res == 'true') {
			$users = User::find($event->E_candidate_id) ;

			$creator = User::find(Auth::id());

			//$users->notify(new newEvent($creator, $event));
			\Notification::send($users, new EventCandidate($creator, $event));

			return 'true' ;
		} else {
			return 'false' ;
		}	
    }

    // function to handle suggest A Playground !!!
	public function SuggestPlayground(Request $request) // final
	{
		//return $request ;
		$request = request() ;

		$event = Event::find($request->eventId);

		$res = $event->SuggestPlayground($request) ; // function decleared inside [[ Event ]] model
		if ($res == 'true') {

			$eventId = $event->id ;
			$eventType = 'event' ; 
			$users = Auth::id() == $event->E_creator_id ?  User::find($event->E_candidate_id) : User::find($event->E_creator_id) ;
			$creator = User::find(Auth::id()) ;
			$playground = Playground::find($request->playgroundId) ;

			//$users->notify(new newEvent($creator, $event));
			\Notification::send($users, new SuggestPlayground($creator,$eventId, $eventType, $playground, $users ));

			return 'true' ;
		} else {
			return 'false' ;
		}	
	}

	// function to accept or refuse suggested playground !!!
	public function AcceptRejectPlayground(Request $request) // final
	{
		$request = request() ;
		 
		$event = Event::find($request->eventId) ;
		$eventId = $event->id ;
		$eventType = 'event' ;
		$users = Auth::id() == $event->E_creator_id ?  User::find($event->E_candidate_id) : User::find($event->E_creator_id) ;
		$creator = User::find(Auth::id()) ;
		$playground = Playground::find($request->playgroundId) ;
		
		if ($request->status == 1) {
			$event->AcceptSuggestedPlayground($request) ;
			$status = 'accept' ;
		}elseif ($request->status == 2) {
			$event->refuseSuggestedPlayground($request) ;
			$status = 'refuse' ;
		}
		//$users->notify(new newEvent($creator, $event));
		\Notification::send($users, new AcceptRejectPlayground($creator,$eventId, $eventType, $playground, $users, $status ));


		return 'true' ;
	}

// *********************** start of ajax load page parts ********************** //

    // to update event page [[ applicants ]] part
    public function getApplicants($id)
    {
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		return view('player.event.pageParts.event.applicants', compact('event','E_result')) ;
    }

	// to update event page [[ creator ]] part
    public function getCreator($id) // final
    {
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		return view('player.event.pageParts.event.creator', compact('event','E_result')) ;
	}
	
    // to update event page [[ candidate ]] part
    public function getCandidate($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		//return $event ;
		return view('player.event.pageParts.event.candidate', compact('event','E_result')) ;
    }

    
    // to update event page [[ event-sport-playgrounds ]] part
    public function getEventSportPlaygrounds($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		//return $event ;
		return view('player.event.pageParts.event.event-sport-playgrounds', compact('event','E_result')) ;
    }

     // to update event page [[ expected-playgrounds ]] part
    public function getSuggestedPlaygrounds($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		//return $event ;
		return view('player.event.pageParts.event.expected-playgrounds', compact('event','E_result')) ;
	}

	// to update event page [[ event result ]] part
    public function getEventResult($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		$CreatorGames =  SubEvent::where('mainEvent_id', '=', $event->id)
                                    ->where('mainEvent_type', '=', 'event')
									->where('S_E_winer_id', '=', $event->E_creator_id)
									->whereHas('SubEventResult', function ($query) {
                                        $query->where('E_R_YesOrNo', '=', 2);
                                    })
                                    ->count();

        $CandidateGames =  SubEvent::where('mainEvent_id', '=', $event->id)
                                    ->where('mainEvent_type', '=', 'event')
									->where('S_E_winer_id', '=', $event->E_candidate_id)
									->whereHas('SubEventResult', function ($query) {
                                        $query->where('E_R_YesOrNo', '=', 2);
                                    })
                                    ->count();
		//return $event ;
		return view('player.event.pageParts.event.event-result', compact('event','E_result', 'CreatorGames', 'CandidateGames')) ;
	}

	// to update event page [[event winner ]] part
    public function geteventWinner($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$event = Event::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($id) ;
		//return $event ;
		return view('player.event.pageParts.event.event-winner', compact('event','E_result')) ;
	}
	
// *********************** end of ajax load page parts ********************** //

//%%%%%%%%%%%%%%%%%%% End of Event final functions %%%%%%%%%%%%%%%%%%//

}
