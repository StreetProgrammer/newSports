<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;
//use App\Http\Controllers\App\User ;
use Storage ;

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

class ClubEmployeeController extends Controller
{
    /*
    * function to display all club users form
    */
    public function allUsers(ClubUsersDatatable $users)
    {   //return 1 ;
        return $users->render('club.Persons.index', ['title' => trans('club.all_club_users')]);
    }

    /*
    * function to display create user form
    */
    public function createUser()
    {
        //echo "nice";
        $title = trans('club.add_new_user') ;
        $governorate = Governorate::with('areas')->get();
        $id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        $club = User::find($id) ;
        return view('club.Persons.Pages.create', compact('title', 'club', 'Sports', 'governorate'));
    }

    /*
    * function to store user [ admin / manager ]
    */
    public function storeUser(Request $request)
    {
        //return $request ;
        $data = $this->validate(request(),
                [
                    'name'      => 'required|min:6',
                    'email'     => 'required|email|unique:users',
                    'password'  => 'required|min:6',
                ],
                [],
                [
                    'name'      => 'Name',
                    'email'     => 'E-mail',
                    'password'  => 'Password',
                ]);
        $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
        $slug = str_slug($data['name'] . '-' . $slugCode, '-');
        $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);

        $data['password']           =   bcrypt(request('password')) ;
        $data['slug']               =   $slug ;
        $data['type']               =   $request->type ;
        $data['club_id']            =   $request->clubId ;
        $data['user_is_active']     =   1 ;
        $data['our_is_active']      =   1 ;
        $data['active_code']        =   $activateCode ;

        //return $data ;
        $user = User::create($data) ;
        if ( $request->type == 4 && !empty($request->playgrounds) ) {
            $user->playgrounds()->sync($request->playgrounds) ;
        }

        session()->flash('Success', trans('club.addedSuccessfully'));
        //return redirect(url('club/users')) ;

        return redirect(url('club/users/all')) ;
        //return view('club.Persons.Pages.create', compact('title', 'club', 'Sports', 'governorate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = User::find($id);
        $id = (Auth::user()->type == 2) ? Auth::id() : Auth::user()->club_id ;
        $club = User::find($id) ;
        $title = trans('club.edit_club_user');
        return view('club.Persons.Pages.edit', compact('club', 'user', 'title')) ;
    }

    /*
    * function to update user [ admin / manager ]
    */
    public function updateUser(Request $request, $id)
    {
        //return$request ;
        $data = $this->validate(request(),
                [
                    'name'      => 'required',
                    'email'     => 'required|email|unique:users,id,' . $id,
                    'password'  => 'sometimes|min:6|nullable',
                ],
                [],
                [
                    'name'      => 'Name',
                    'email'     => 'E-mail',
                    'password'  => 'Password',
                ]);
        $data['password'] = bcrypt($request->password) ;
        if (request()->has('user_is_active')) {
            $data['user_is_active'] = $request->user_is_active ;
        }else{
            $data['user_is_active'] = 0 ;
        }

        $user = User::where('id', $id)->update($data) ;
        if ( $request->type == 4 ) {
            User::find($id)->playgrounds()->sync($request->playgrounds) ;
        }
        session()->flash('Success', trans('club.updatedSuccessfully'));
        return redirect(url('club/users/all')) ;
        //return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUser($id)
    {
        //return $id;
        $user = User::find($id) ;

        if ( $user->type == 4 ) {
            DB::table('playground_user')->where('user_id', '=', $id)->delete();
        }



        session()->flash('Success', trans('club.deletedSuccessfully'));
        return redirect()->back() ;
    }

    public function multipleDestroyUsers(Request $request)
    {
        //return $request ;
        if ( is_array(request('item')) ) {
            foreach (request('item') as $id) {
                $user = User::find($id) ;

                if ( $user->type == 4 ) {
                    DB::table('playground_user')->where('user_id', '=', $id)->delete();
                }
                $user->delete() ;
            }

        } else {
            $user = User::find(request('item')) ;

            if ( $user->type == 4 ) {
                DB::table('playground_user')->where('user_id', '=', $id)->delete();
            }
            $user->delete() ;
        }
        session()->flash('Success', 'User Acoount(s) Deleted Successfully');
        return redirect()->back() ;

    }
}
