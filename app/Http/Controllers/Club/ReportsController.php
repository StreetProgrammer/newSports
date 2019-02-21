<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;
//use App\Http\Controllers\App\User ;
use Storage ;
use PdfReport;
use PDF;

use App\Notifications\admin\NewClubRegistered ;
use App\Notifications\admin\NewClubFixedErr ;
use App\Notifications\admin\NewClubEditRequest ;

use App\Model\Admin;
use App\Model\Sport;
use App\Model\User;
use App\Model\clubProfile;
use App\Model\Country;
use App\Model\Governorate;
use App\Model\PendingEdit ;

use App\DataTables\Club\ClubUsersDatatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate ;

class ReportsController extends Controller
{
    /*
    * return page where can make a report 
    *
    */
    public function index()
    {
        $title = direction() == 'ltr' ? 'Create Report' : 'أنشئ تقرير' ;
        $part_title = direction() == 'ltr' ? 'Reservations' : 'الحجوزات'; //landing part title
        $governorate = Governorate::with('areas')->get();
        $id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        $club = User::find($id) ;
        return view('club.Reports.Pages.create', compact('title', 'club', 'Sports', 'governorate', 'part_title') );
    }

    // take request from user and get target model and send data to prepareQuery function 
    public function displayReport(Request $request)
    {
        //return $request ;
        $model = $request->type ;
        return self::prepareQuery($model, $request) ;
    }

   
    ////////////////////////////// start static query builder //////////////////////////////
    // take request from displayReport and send date to target model function to handle it
    public static function prepareQuery($model, Request $request)
    {   
        switch ($model) {
            case 'reservations':
                return self::reservations($request);
                break;
            case 'branches':
                return self::branches($request);
                break;
            case 'courts':
                return self::courts($request);
                break;
            case 'users':
                return self::users($request);
                break;
            default:
                # code...
                break;
        }
    }

    public static function reservations(Request $request)
    {
        //return $request ;
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Reservations Report';

        $meta = [ // For displaying filters description on header
            'Club User Accounts on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $reservations = DB::table('reservations')
                        ->leftJoin('users AS Club', 'reservations.R_playground_owner_id', '=', 'Club.id')
                        ->leftJoin('users AS Creator', 'reservations.R_creator_id', '=', 'Creator.id')
                        //->leftJoin('users AS reservedBy', 'reservations.reservedBy', '=', 'reservedBy.id')
                        ->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')
                        ->leftJoin('events AS Event', 'reservations.R_event_id', '=', 'Event.id')
                        ->leftJoin('days AS Day', 'reservations.R_day', '=', 'Day.day_id')
                        ->leftJoin('hours AS From', 'reservations.R_from', '=', 'From.hour_id')
                        ->leftJoin('hours AS To', 'reservations.R_to', '=', 'To.hour_id')
                        /*->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')*/
                        /*->leftJoin('reservations AS Reservation', 'reservations.R_Reservation', '=', 'Reservation.id')*/
                        
                        ->select(['reservations.created_at as created_at','reservations.R_date','reservations.resOwner','reservations.reservedBy as Position',
                                    'reservations.id','reservations.R_price_per_hour', 'reservations.R_hour_count',
                                    'reservations.R_total_price','reservations.clubPaid', 'reservations.reservedBy',                                    
                                    'Club.name as Club', 
                                    'Creator.name as Creator',
                                    //'reservedBy.name as Position', 
                                    'Day.day_format as Day',
                                    'From.hour_format as From',
                                    'To.hour_format as To',
                                    'Playground.c_b_p_name as Playground',
                                    //'reservations.R_total_price', DB::raw('SUM(reservations.R_total_price) as total')
                                    

                        ])
                        //->groupBy('reservations.created_at')
                        ->where('reservations.R_playground_owner_id', '=', $request->clubId);
                        if (!empty($request->input('from_date'))) {
                            $reservations->where('reservations.created_at', '>', $request->input('from_date'));
                            //$reservations$reservationsBetween('reservations.created_at', [$fromDate, $toDate]);
                        }elseif (!empty($request->input('to_date'))) {
                            $reservations->where('reservations.created_at', '<', $request->input('to_date'));
                            //$reservations->whereBetween('reservations.created_at', [$fromDate, $toDate]);
                        }elseif (!empty($request->input('from_date')) && !empty($request->input('to_date'))) {
                            $reservations->whereBetween('reservations.created_at', [$fromDate, $toDate]);
                        }
                        
                        $reservations->orderBy($sortBy);
                        $reservations = $reservations->get();
                        //return $reservations;
                        //return view('club.Reports.Pages.reportsTemplates.reservations', compact('reservations', 'fromDate', 'toDate')) ;

                        $pdf = \PDF::loadView('club.Reports.Pages.reportsTemplates.reservations', compact('reservations', 'fromDate', 'toDate'));
                        return $pdf ->download('try.pdf');
        
        

    }

    public static function courts(Request $request)
    {
        //return $request ;
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Reservations Report';

        $reservations = DB::table('reservations')
                        ->leftJoin('users AS Club', 'reservations.R_playground_owner_id', '=', 'Club.id')
                        ->leftJoin('users AS Creator', 'reservations.R_creator_id', '=', 'Creator.id')
                        //->leftJoin('users AS reservedBy', 'reservations.reservedBy', '=', 'reservedBy.id')
                        ->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')
                        ->leftJoin('events AS Event', 'reservations.R_event_id', '=', 'Event.id')
                        ->leftJoin('days AS Day', 'reservations.R_day', '=', 'Day.day_id')
                        ->leftJoin('hours AS From', 'reservations.R_from', '=', 'From.hour_id')
                        ->leftJoin('hours AS To', 'reservations.R_to', '=', 'To.hour_id')
                        /*->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')*/
                        /*->leftJoin('reservations AS Reservation', 'reservations.R_Reservation', '=', 'Reservation.id')*/
                        
                        ->select(['reservations.created_at as created_at','reservations.R_date','reservations.resOwner','reservations.reservedBy as Position',
                                    'reservations.id','reservations.R_price_per_hour', 'reservations.R_hour_count', 'reservations.R_playground_id', 
                                    'reservations.R_total_price','reservations.clubPaid', 'reservations.reservedBy',                                    
                                    'Club.name as Club', 
                                    'Creator.name as Creator', 
                                    'Day.day_format as Day',
                                    'From.hour_format as From',
                                    'To.hour_format as To',
                                    'Playground.c_b_p_name as Playground',
                        ])
                        //->groupBy('reservations.created_at')
                        ->where('reservations.R_playground_owner_id', '=', $request->clubId)
                        ->whereIn('reservations.R_playground_id', $request->playgrounds);
                        if (!empty($request->input('from_date'))) {
                            $reservations->where('reservations.created_at', '>', $request->input('from_date'));
                        }elseif (!empty($request->input('to_date'))) {
                            $reservations->where('reservations.created_at', '<', $request->input('to_date'));
                        }elseif (!empty($request->input('from_date')) && !empty($request->input('to_date'))) {
                            $reservations->whereBetween('reservations.created_at', [$fromDate, $toDate]);
                        }
                        if (!empty($request->input('sort_by'))) {
                            $reservations->orderBy($request->input('sort_by'));
                        }
                        
                        $reservations = $reservations->get();
                        $courts = $request->playgrounds ;
                        //return $courts;
                        return view('club.Reports.Pages.reportsTemplates.courts', compact('reservations', 'fromDate', 'toDate', 'courts')) ;

                        $pdf = \PDF::loadView('club.Reports.Pages.reportsTemplates.courts', compact('reservations', 'fromDate', 'toDate', 'courts'));
                        return $pdf ->download('try.pdf');
        
        
    }

    public static function branches(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
    }

    public static function users(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
    }
    ////////////////////////////// start static query builder //////////////////////////////

    ////////////////////////////// start ajax load parts //////////////////////////////
    public function getReportOf($model = 'reservations')
    {
        $id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        $club = User::find($id) ;
        switch ($model) {
            case 'users':
                $part_title = direction() == 'ltr' ? 'Users' : 'المستخدمين';
                return view('club.Reports.pageParts.createReportOf.Users', compact('club', 'part_title'));

                break;
            case 'branches':
                $part_title = direction() == 'ltr' ? 'Branches' : 'الفروع';
                return view('club.Reports.pageParts.createReportOf.Branches', compact('club', 'part_title'));

                break;
            case 'courts':
                $part_title = direction() == 'ltr' ? 'Courts' : 'الملاعب';
                return view('club.Reports.pageParts.createReportOf.Courts', compact('club', 'part_title'));

                break;
            case 'reservations':
                $part_title = direction() == 'ltr' ? 'Reservations' : 'الحجوزات';
                return view('club.Reports.pageParts.createReportOf.Reservations', compact('club', 'part_title'));

                break;
            default:
                # code...
                break;
        }
    }
    ////////////////////////////// end ajax load parts //////////////////////////////
}
