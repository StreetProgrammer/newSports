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
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $sortBy = $request->input('sort_by');

        $title = 'Club User Accounts'; // Report title

        $meta = [ // For displaying filters description on header
            'Club User Accounts on' => $fromDate . ' To ' . $toDate,
            'Sort By' => $sortBy
        ];

        $queryBuilder = User::select(['name', 'email', 'created_at']) // Do some querying..
                            ->whereBetween('created_at', [$fromDate, $toDate])
                            ->orderBy($sortBy);

        $columns = [ // Set Column to be displayed
            'Name'      => 'name',
            'Degree'    => function($result) { // You can do if statement or any action do you want inside this closure
                    return ($result->type == 4) ? 'Admin' : 'Manager';
                } ,// if no column_name specified, this will automatically seach for snake_case of column name (will be registered_at) column from query result
            'Name'      => 'name',
            'Account Created At' => 'created_at',
            'Status'    => function($result) { // You can do if statement or any action do you want inside this closure
                return ($result->type == 4) ? 'Status Admin' : 'Status Manager';
            }
        ];

        // Generate Report with flexibility to manipulate column class even manipulate column value (using Carbon, etc).
        return PdfReport::of($title, $meta, $queryBuilder, $columns)
                        ->editColumn('Account Created At', [ // Change column class or manipulate its data for displaying to report
                            'displayAs' => function($result) {
                                return $result->created_at->format('d M Y');
                            },
                            'class' => 'left'
                        ])
                        ->editColumns(['Degree', 'Name'], [ // Mass edit column
                            'class' => 'bold'
                        ])
                        ->showTotal([ // Used to sum all value on specified column on the last table (except using groupBy method). 'point' is a type for displaying total with a thousand separator
                            'Total Balance' => 'point' // if you want to show dollar sign ($) then use 'Total Balance' => '$'
                        ])
                        //->limit(20) // Limit record to be showed
                        ->stream(); // other available method: download('filename') to download pdf / make() that will producing DomPDF / SnappyPdf instance so you could do any other DomPDF / snappyPdf method such as stream() or download()
    }
}
