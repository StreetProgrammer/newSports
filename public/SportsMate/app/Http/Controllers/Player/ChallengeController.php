<?php

namespace App\Http\Controllers\Player;
use App\Notifications\player\newChallenge;
use App\Notifications\player\AcceptRejectChallenge;
use App\Notifications\player\SuggestPlayground;
use App\Notifications\player\AcceptRejectPlayground;
use DateTime;

use DB ;

use App\Http\Controllers\Controller ;
use App\Model\Challenge;
use App\Model\SubEvent;
use App\Model\User;
use App\Model\Sport ;
use App\Model\Playground ;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChallengeController extends Controller
{
   /*
	* function to get one event by id
	*/
	public function index($id) // final
	{
		$id = sm_crypt($id, 'd') ;
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;


       	$CreatorGames =  SubEvent::where('mainEvent_id', '=', $challenge->id)
                                    ->where('mainEvent_type', '=', 'challenge')
                                    ->where('S_E_winer_id', '=', $challenge->C_creator_id)
                                    ->whereHas('SubEventResult', function ($lquery) {
                                            $lquery->where('E_R_IsFinalResult', '=', 2);
                                        }) 
                                    ->count();

        $CandidateGames =  SubEvent::where('mainEvent_id', '=', $challenge->id)
                                    ->where('mainEvent_type', '=', 'challenge')
                                    ->where('S_E_winer_id', '=', $challenge->C_candidate_id)
                                    ->whereHas('SubEventResult', function ($lquery) {
                                            $lquery->where('E_R_IsFinalResult', '=', 2);
                                        })
                                    ->count();
		$title = 'Challenge' ;
		return view('player.challenge.pages.challenge', compact('title', 'challenge', 'CreatorGames', 'CandidateGames')) ;
	}


//%%%%%%%%%%%%%%%%%%% Challenge playground functions %%%%%%%%%%%%%%%%%%//
	// function to handle suggest A Playground !!!

//%%%%%%%%%%%%%%%%%%% End of Challenge playground functions %%%%%%%%%%%%%%%%%%//

//%%%%%%%%%%%%%%%%%%% start of Challenge Result functions %%%%%%%%%%%%%%%%%%//

	// function to handle suggest A Result !!!
	public function SuggestResult(Challenge $Challenge)
	{
		$request = request() ;

		//return $request ;

		$Challenge->SuggestResult($request) ;

		return back() ;
	}

	// function to accept or refuse suggested Result !!!
	public function AcceptOrRefuseSuggestedResult(Challenge $Challenge)
	{
		$request = request() ;

		if ($request->E_R_YesOrNo == 1) {
			$Challenge->AcceptSuggestedResult($request) ;
		}elseif ($request->E_R_YesOrNo == 0) {
			$Challenge->refuseSuggestedResult($request) ;
		}

		//return $request ;

		return back() ;
	}


//%%%%%%%%%%%%%%%%%%% End of Challenge Result functions %%%%%%%%%%%%%%%%%%//

	/*
    * function to load patrial view after A player give A rate to Ather player
    */
    public function ChallengeResult(Challenge $Challenge)
    {
        $Challenge = Challenge::with('Applicants')
							->with('creator.playerProfile')
							->with('eventSport')->find($Challenge) ;
        //$Challenge = json_encode($Challenge) ;
        return $Challenge ;

        return view('event.parts.ChallengePart_1', compact('Challenge')) ;
    }

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% start of Challenges final functions %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//

    //%%%%%%%%%%%%%%%%%%% start of Challenge final functions %%%%%%%%%%%%%%%%%%//

	/*
	* function for add new Challenge
	*/    
    public function Add(Request $request) //final
    {
    	//return $request ;
    	$C_JQueryFrom = new DateTime($request->C_date);

		$C_JQueryFrom->modify('+' . $request->C_from . ' hour');

		$C_JQueryTo = new DateTime($request->C_date);

		$C_JQueryTo->modify('+' . $request->C_to . ' hour');

			$day = date("l", strtotime(request()->C_date));// to get day name to check if in user vacant time
			//to get day id and store it to check if in user vacant time and for relations
			$C_day = DB::table('days')->where('day_format', '=', $day)->first() ;
			//return $C_day->day_id ;

			$challenge = Challenge::create([
						   'C_creator_id'        		=> Auth::id(),
						   'C_candidate_id'        		=> $request->playerId,//Auth::user()->id,
						   'C_sport_id'      			=> $request->C_sport_id,
						   'C_YesOrNo'					=> 0 ,
						   'C_date'    					=> $request->C_date,
						   'C_day'        				=> $C_day->day_id ,
						   'C_from'        				=> $request->C_from,
						   'C_to'        				=> $request->C_to,
						   'C_JQueryFrom'        		=> $C_JQueryFrom->format('Y-m-d H-i-s'),
						   'C_JQueryTo'        			=> $C_JQueryTo->format('Y-m-d H-i-s') ,
						]);

		if ($challenge) {
			$users = User::find($request->playerId) ;
			$creator = User::find(Auth::id());

			//$users->notify(new newEvent($creator, $event));
			\Notification::send($users, new newChallenge($creator, $challenge));

			return 'true' ;
		} else {
			return 'false' ;
		}	
    }

    /*
	* function for accept or reject challenge
	*/
    public function AcceptRejectchallenge(Request $request) // final
	{
		$request = request() ;
		$challenge = Challenge::find($request->challengeId);
		if ($request->status == 1) {
			$value = $challenge->AcceptChallenge($request) ;
			$status = 'accept' ;
		}elseif ($request->status == 2) {
			$value = $challenge->RefuseChallenge($request) ;
			$status = 'reject' ;
		}
		$users = User::find($challenge->C_creator_id) ;
		\Notification::send($users, new AcceptRejectChallenge($challenge, $status ));

		return $value ;
	}

    /*
	* function to handle suggest A Playground !!!
	*/
	public function SuggestPlayground(Request $request)  // final
	{
		$request = request() ;

		$challenge = Challenge::find($request->challengeId);
		//return $request ;

		//return $challenge->SuggestPlayground($request) ;
		$res = $challenge->SuggestPlayground($request) ; // function decleared inside [[ Event ]] model
		if ($res == 'true') {
			$eventId = $challenge->id ;
			$eventType = 'challenge' ; 
			$users = Auth::id() == $challenge->C_creator_id ?  User::find($challenge->C_candidate_id) : User::find($challenge->C_creator_id) ;
			$creator = User::find(Auth::id()) ;
			$playground = Playground::find($request->playgroundId) ;

			//$users->notify(new newEvent($creator, $challenge));
			\Notification::send($users, new SuggestPlayground($creator,$eventId, $eventType, $playground, $users ));

			return 'true' ;
		} else {
			return 'false' ;
		}	
		//return back() ;
	}
	
	// function to accept or refuse suggested playground !!!
	public function AcceptRejectPlayground(Request $request)  // final
	{
		$request = request() ;
		$event = Challenge::find($request->challengeId) ;
		$eventId = $event->id ;
		$eventType = 'challenge' ;
		$users = Auth::id() == $event->C_creator_id ?  User::find($event->C_candidate_id) : User::find($event->C_creator_id) ;
		$creator = User::find(Auth::id()) ;
		$playground = Playground::find($request->playgroundId) ;

		$Challenge = Challenge::find($request->challengeId) ;
		if ($request->status == 1) {
			$Challenge->AcceptSuggestedPlayground($request) ;
			$status = 'accept' ;
		}elseif ($request->status == 2) {
			$Challenge->refuseSuggestedPlayground($request) ;
			$status = 'reject' ;
		}

		\Notification::send($users, new AcceptRejectPlayground($creator,$eventId, $eventType, $playground, $users, $status ));

		return 'true' ;
	}
	

// *********************** start of ajax load page parts ********************** //

	// to update challenge page [[ creator ]] part
    public function getCreator($id) // final
    {
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;
		return view('player.challenge.pageParts.challenge.creator', compact('challenge')) ;
    }

    // to update challenge page [[ candidate ]] part
    public function getCandidate($id) // final
    {
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;
		return view('player.challenge.pageParts.challenge.candidate', compact('challenge')) ;
    }

    
    // to update challenge page [[ challenge-sport-playgrounds ]] part
    public function getchallengeSportPlaygrounds($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;
		//return $challenge ;
		return view('player.challenge.pageParts.challenge.challenge-sport-playgrounds', compact('challenge')) ;
    }

     // to update challenge page [[ expected-playgrounds ]] part
    public function getSuggestedPlaygrounds($id) // final
    {
    	//$id = sm_crypt($id, 'd') ;
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;
		//return $challenge ;
		return view('player.challenge.pageParts.challenge.expected-playgrounds', compact('challenge')) ;
    }

    // to update challenge page [[ challenge result ]] part
    public function getChallengeResult($id)
    {
		$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;
		$CreatorGames =  SubEvent::where('mainEvent_id', '=', $challenge->id)
                                    ->where('mainEvent_type', '=', 'challenge')
                                    ->where('S_E_winer_id', '=', $challenge->C_creator_id)
                                    ->whereHas('SubEventResult', function ($lquery) {
                                            $lquery->where('E_R_IsFinalResult', '=', 2);
                                        }) 
                                    ->count();

        $CandidateGames =  SubEvent::where('mainEvent_id', '=', $challenge->id)
                                    ->where('mainEvent_type', '=', 'challenge')
                                    ->where('S_E_winer_id', '=', $challenge->C_candidate_id)
                                    ->whereHas('SubEventResult', function ($lquery) {
                                            $lquery->where('E_R_IsFinalResult', '=', 2);
                                        })
                                    ->count();
		//return $event ;
		return view('player.challenge.pageParts.challenge.challenge-result', compact('challenge','E_result', 'CreatorGames', 'CandidateGames')) ;
	}

	// to update challenge page [[challenge winner ]] part
    public function getChallengeWinner($id)
    {
    	$challenge = Challenge::with('creator.playerProfile')
							->with('challengeSport')->find($id) ;

		return view('player.challenge.pageParts.challenge.challenge-winner', compact('challenge')) ;
	}
// *********************** end of ajax load page parts ********************** //

//%%%%%%%%%%%%%%%%%%% End of Event final functions %%%%%%%%%%%%%%%%%%//

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% end of Challenges final functions %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//
//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%//



}
