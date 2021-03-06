<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;

use App\DataTables\EventsDatatable;

use App\Model\Event ;

class AdminEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(EventsDatatable $event)
    {
        return $event->render('admin.Events.index', ['title' => 'Events Control']);
    }

     public function singleClubDetails(Event $Event)
    {
        $Event = Event::with('creator')
                    ->with('candidate')
                    ->with('eventSport')
                    ->with('eventPlayground')
                    ->with('expectedPlaygrounds')
                    ->with('EventReservation')
                    ->with('EventDay')
                    ->with('EventFrom')
                    ->with('EventTo')
                    ->with('SubEvents')
                    ->with('EventRate')
                    ->with('EventResult')
                    ->where('id', $Event->id)
                            ->firstOrFail();
        //return $Event ;
        return view('admin.Events.Pages.AdminEvent', compact('Event'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $Event = Event::with('creator')
                    
                    ->where('id', $id)
                            ->firstOrFail();
        //return $Event ;
        return view('admin.Events.Pages.AdminEvent', compact('Event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   /* public function changeActivationStatus()
    {
        User::where('id', request()->target)
            ->where('type', 2)
            ->update(['our_is_active' => request()->status]);
            
        session()->flash('Success', trans('admin.updated_record'));
        return back() ;
    }*/
}
