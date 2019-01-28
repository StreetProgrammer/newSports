<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;

use DateTime;

use Illuminate\Support\Facades\Auth;

use App\Model\User ;
use App\Model\Playground ;
use App\Model\Reservation ;
use App\Model\Event ;

use App\DataTables\Club\ClubReservationsDatatable;

use DB ;

use Illuminate\Http\Request;

class ReservationController extends Controller
{
    
    public function index(ClubReservationsDatatable $reservation)
    {
        $title = direction() == 'ltr' ?  'Courts' : 'الملاعب' ;
        return $reservation->render('club.Reservations.index', ['title' => $title]);
    }

    public function Save(Playground $Playground)
    {
        $request = request() ;
        return request() ;

        $ReservationCase_1 = Reservation::where('R_playground_id', '=' , $Playground->id)
                            ->where('R_date', '=' , $request->R_date)
                            ->whereBetween('R_from', [$request->R_from, (($request->R_to) - 1)])->get();

        $ReservationCase_2 = Reservation::where('R_playground_id', '=' , $Playground->id)
                            ->where('R_date', '=' , $request->R_date)
                            ->whereBetween('R_to', [(($request->R_from) + 1), $request->R_to, ])->get();

        $ReservationCase_3 = Reservation::where('R_playground_id', '=' , $Playground->id)
                            ->where('R_date', '=' , $request->R_date)
                            ->where('R_to', '>', $request->R_to)
                            ->where('R_from', '<', $request->R_from)->get();

        if ($ReservationCase_1->count() != 0 || $ReservationCase_2->count() != 0 || $ReservationCase_3->count() != 0) {
            return 'false' ;
        }else {
                $R_hour_count = $request->R_to - $request->R_from ;

                $R_total_price = $R_hour_count * ($Playground->c_b_p_price_per_hour);

        		$R_JQueryFrom = new DateTime(request('R_date'));

        		$R_JQueryFrom->modify('+' . request('R_from') . ' hour');

        		$R_JQueryTo = new DateTime(request('R_date'));

        		$R_JQueryTo->modify('+' . request('R_to') . ' hour');

        		if (Auth::user()->id == $Playground->c_user_id) {

        			$day = date("l", strtotime(request()->R_date));// to get day name to check if in user vacant time
        			//to get day id and store it to check if in user vacant time and for relations
        			$R_day = DB::table('days')->where('day_format', '=', $day)->first(); ;
        			//return $E_day->day_id ;
        			Reservation::create([

                        'R_playground_owner_id'   => $Playground->c_user_id,
                        'R_playground_id'         => $Playground->id,
                        'R_creator_id'            => $Playground->c_user_id,
                        'R_date'                  => $request->R_date,
                        'R_day'                   => $R_day->day_id,
                        'R_from'                  =>$request->R_from,
                        'R_to'                    =>$request->R_to,
                        'R_JQueryFrom'            =>$R_JQueryFrom->format('Y-m-d H-i-s'),
                        'R_JQueryTo'              =>$R_JQueryTo->format('Y-m-d H-i-s'),
                        'R_price_per_hour'        =>$Playground->c_b_p_price_per_hour,
                        'R_hour_count'            =>$R_hour_count,
                        'R_total_price'           =>$R_total_price,
                        'R_payment_status'        => 1,
                        ]);

        		}else {
                    $R_hour_count = $request->R_to - $request->R_from ;

                    $R_total_price = $R_hour_count * ($Playground->c_b_p_price_per_hour);

                    $Reserved = Reservation::create([

                        'R_playground_owner_id'   => $Playground->c_user_id,
                        'R_playground_id'         => $Playground->id,
                        'R_creator_id'            => Auth::id(), //change to Auth id
                        'R_event_id'              => $request->R_event_id,
                        'R_date'                  => $request->R_date,
                        'R_day'                   => $request->R_day,
                        'R_from'                  =>$request->R_from,
                        'R_to'                    =>$request->R_to,
                        'R_JQueryFrom'            =>$R_JQueryFrom->format('Y-m-d H-i-s'),
                        'R_JQueryTo'              =>$R_JQueryTo->format('Y-m-d H-i-s'),
                        'R_price_per_hour'        =>$Playground->c_b_p_price_per_hour,
                        'R_hour_count'            =>$R_hour_count,
                        'R_total_price'           =>$R_total_price,
                        'R_payment_status'        => 1,
                        ]);

                        if ($Reserved == true) {
                            //return 'true';
                            $event = Event::find($request->R_event_id);

                            $event->E_playground_id = $Playground->id ;

                            $event->save();
                        }else {
                            return 'false';
                        }

                }
        	//return $User ;
        }//if else close tag ( try to find reservations in our time !! )
        //return $ReservationCase_2 ;
    	return back() ;
    }

    /*
    * function to return form viwe to creat a reservation
    */
    public function create()
    {
        
    }

    /*
    * function to return all reservations for playground or all managerplaygrounds by $type [playground/manager]
    */
    public function getPlaygroundReservations($id, $type = 'playground')
    {   
        $playerColor    = '#00a65a' ; $ownerColor     = '#dd4b39' ;
        $adminColor     = '#ff851b' ; $managerColor   = '#0073b7' ;
        $events = array() ;
        if ($type == 'playground') {
            $reservations = Reservation::where('R_playground_id', $id)->get();

            foreach ($reservations as $reservation) {
            $CreatorType = $reservation->creator->type ;
            if ($CreatorType == 1) {
                $Color = $playerColor ;
            } elseif($CreatorType == 2) {
                $Color = $ownerColor ;
            } elseif($CreatorType == 3) { 
                $Color = $adminColor ;
            } elseif($CreatorType == 4) {
                $Color = $managerColor ;
            }

                $events[] = array(  'id'                  => $reservation->id,
                                    'title'               => $reservation->creator->name,
                                    'start'               => $reservation->R_JQueryFrom ,
                                    'end'                 => $reservation->R_JQueryTo ,
                                    'backgroundColor'     => $Color, //red
                                    'borderColor'         => $Color 
                            );
            }

        } elseif ($type == 'user') {
            $manager      = User::find($id) ;
            foreach ($manager->playgrounds as $playground){
                if ($playground->is_active == 1 && $playground->our_is_active == 1){
                    foreach ($playground->PlaygroudReservations as $reservation){
                        $CreatorType = $reservation->creator->type ; $Color = '' ;
                        if ($CreatorType == 1){ 
                            $Color = '#00a65a' ;
                        }elseif($CreatorType == 2){ 
                            $Color = '#dd4b39' ;
                        }elseif($CreatorType == 3){  
                            $Color = '#ff851b' ;
                        }elseif($CreatorType == 4){ 
                            $Color = '#0073b7' ;
                        }
                       
                        $events[] = array(  'id'                  => $reservation->id,
                                            'title'               => $reservation->creator->name,
                                            'start'               => $reservation->R_JQueryFrom ,
                                            'end'                 => $reservation->R_JQueryTo ,
                                            'backgroundColor'     => $Color, //red
                                            'borderColor'         => $Color 
                        );
                    } // foreach
                } // if
            }// foreach
        }
        
        //return $reservations;
        
        
        //$reservations = $events->tojson() ;
        return json_encode($events);

    }

    public function store(Request $request)
    {
        //return $request ;

        $is_available = $this->is_available($request->playgroundId, $request->date, $request->from, $request->to) ;
        if($is_available == 'true') {
                $Playground = Playground::find($request->playgroundId) ;

                $R_hour_count = $request->to - $request->from ;

                $R_total_price = $R_hour_count * ($Playground->c_b_p_price_per_hour);

                $R_JQueryFrom = new DateTime(request('date'));

                $R_JQueryFrom->modify('+' . request('from') . ' hour');

                $R_JQueryTo = new DateTime(request('date'));

                $R_JQueryTo->modify('+' . request('to') . ' hour');

                //if (Auth::user()->id == $Playground->c_user_id) {

                    $day = date("l", strtotime(request()->date));// to get day name to check if in user vacant time
                    //to get day id and store it to check if in user vacant time and for relations
                    $R_day = DB::table('days')->where('day_format', '=', $day)->first(); ;
                    //return $E_day->day_id ;
                    $reservation = Reservation::create([

                                    'R_playground_owner_id'   => $Playground->c_user_id,
                                    'R_playground_id'         => $Playground->id,
                                    'R_creator_id'            => Auth::id(),
                                    'R_date'                  => $request->date,
                                    'R_day'                   => $R_day->day_id,
                                    'R_from'                  => $request->from,
                                    'R_to'                    => $request->to,
                                    'R_JQueryFrom'            => $R_JQueryFrom->format('Y-m-d H-i-s'),
                                    'R_JQueryTo'              => $R_JQueryTo->format('Y-m-d H-i-s'),
                                    'R_price_per_hour'        => $Playground->c_b_p_price_per_hour,
                                    'R_hour_count'            => $R_hour_count,
                                    'R_total_price'           => $R_total_price,
                                    'R_payment_status'        => 1,
                                    'resOwner'                => $request->name, 
                                    ]);
                    if ($reservation) {
                        return 'true' ;
                    }else{
                        return 'false' ;
                    }
        }else{
            return 'false' ;
        } ;
    }

    /*
    * return if checked time is vacant or not [ true / false ]
    */
    public function checkVacantTime(Request $request)
    {
        //return request() ;
        $is_available = $this->is_available($request->playgroundId, $request->date, $request->from, $request->to) ;
        $retVal = ($is_available == 'true') ? 'true' : 'false' ;

        return $retVal ;
    }

    /*
    * private function to this class return if checked time is vacant or not
    */
    private function is_available($playgroundId, $date, $from, $to)
    {
        //$request = request() ;
        

        $ReservationCase_1 = Reservation::where('R_playground_id', '=' , $playgroundId)
                            ->where('R_date', '=' , $date)
                            ->whereBetween('R_from', [$from, (($to) - 1)])->get();

        $ReservationCase_2 = Reservation::where('R_playground_id', '=' , $playgroundId)
                            ->where('R_date', '=' , $date)
                            ->whereBetween('R_to', [(($from) + 1), $to, ])->get();

        $ReservationCase_3 = Reservation::where('R_playground_id', '=' , $playgroundId)
                            ->where('R_date', '=' , $date)
                            ->where('R_to', '>', $to)
                            ->where('R_from', '<', $from)->get();

        if ($ReservationCase_1->count() != 0 || $ReservationCase_2->count() != 0 || $ReservationCase_3->count() != 0) {
            return 'false' ;
        }else {
           return 'true' ; 
        }
    }

    public function delete(Request $request)
    {
        //return $request ;
        $Reservation = Reservation::find($request->id) ;

        if ($Reservation->delete()) {
            return 'true';
        } else {
            return 'false';
        }
         
    }


}
