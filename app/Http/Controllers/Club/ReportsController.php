<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;
//use App\Http\Controllers\App\User ;
use Storage ;
use PdfReport;

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
        $title = direction() == 'ltr' ? 'creat_report' : 'أنشئ تقرير' ;
        $governorate = Governorate::with('areas')->get();
        $id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        $club = User::find($id) ;
        return view('club.Reports.Pages.create', compact('title', 'club', 'Sports', 'governorate') );
    }

    public function displayReport(Request $request)
    {
        //return $request ;
        
        
        $model = $request->type ;
        return self::prepareQuery($model, $request) ;
    }

   

    ////////////////////////////// start static query builder //////////////////////////////
    public static function prepareQuery($model, Request $request)
    {   
        //$fromDate = $request->input('from_date');
        //$toDate = $request->input('to_date');
        //$sortBy = $request->input('sort_by');
        //$id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        //$club = User::find($id) ;
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
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Reservations Report';

        $meta = [ // For displaying filters description on header
            'Club User Accounts on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $queryBuilder = DB::table('reservations')
                        ->leftJoin('users AS Club', 'reservations.R_playground_owner_id', '=', 'Club.id')
                        ->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')
                        ->leftJoin('users AS Creator', 'reservations.R_creator_id', '=', 'Creator.id')
                        ->leftJoin('events AS Event', 'reservations.R_event_id', '=', 'Event.id')
                        ->leftJoin('days AS Day', 'reservations.R_day', '=', 'Day.day_id')
                        ->leftJoin('hours AS From', 'reservations.R_from', '=', 'From.hour_id')
                        ->leftJoin('hours AS To', 'reservations.R_to', '=', 'To.hour_id')
                        /*->leftJoin('playgrounds AS Playground', 'reservations.R_playground_id', '=', 'Playground.id')*/
                        /*->leftJoin('reservations AS Reservation', 'reservations.R_Reservation', '=', 'Reservation.id')*/
                        
                        ->select(['reservations.created_at as created_at','reservations.id', 
                                    'Club.name as Club', 
                                    'Creator.name as Creator', 
                                    'Day.day_format as Day',
                                    'From.hour_format as From',
                                    'To.hour_format as To',
                                    'Playground.c_b_p_name as Playground',

                        ])
                        ->where('reservations.R_playground_owner_id', '=', $request->clubId)
                        ->whereBetween('reservations.created_at', [$fromDate, $toDate])
                        ->orderBy($sortBy);
                        //->get();
        
        $columns = [ // Set Column to be displayed
            'Club'      => 'Club',
            'Degree'    => function($result) { // You can do if statement or any action do you want inside this closure
                    return ($result->Creator == 4) ? 'Admin' : $result->Creator ;
                } ,// if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Club'      => 'Club',
            'Created At' => 'created_at',
        ];

        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                        ->editColumn('Created At', [ // Change column class or manipulate its data for displaying to report
                            'displayAs' => function($result) {
                                return $result->created_at->format('M Y');
                            },
                            'class' => 'left'
                        ])
                        ->editColumns(['Degree', 'Name'], [ // Mass edit column
                            'class' => 'bold'
                        ])
                        ->groupBy('created_at')
                        ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                            'No' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])
                        //->limit(20) // Limit record to be showed
                        ->stream(); 
    }

    public static function courts($model, Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
    }

    public static function branches($model, Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');
    }

    public static function users($model, Request $request)
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
                return view('club.Reports.pageParts.createReportOf.Users', compact('club'));

                break;
            case 'branches':
                return view('club.Reports.pageParts.createReportOf.Branches', compact('club'));

                break;
            case 'courts':
                return view('club.Reports.pageParts.createReportOf.Courts', compact('club'));

                break;
            case 'reservations':
                return view('club.Reports.pageParts.createReportOf.Reservations', compact('club'));

                break;
            default:
                # code...
                break;
        }
    }
    ////////////////////////////// end ajax load parts //////////////////////////////
}
