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
use App\Model\Governorate;
use App\Model\PendingEdit ;

use App\DataTables\ClubUsersDatatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate ;

class ClubProfilesController extends Controller
{
    /*
    *function to handle send data to the app admin to accept or reject club profile
    */
    public function NewClubProfileCreated(Request $request)
    {
        $club = User::find($request->clubId);
        $admins = Admin::all();

        if ($club->our_is_active == 0) {
            //$admins->notify(new NewClubRegistered($club));
            \Notification::send($admins, new NewClubRegistered($club));

        } elseif ($club->our_is_active == 3) {

            \Notification::send($admins, new NewClubFixedErr($club));
        }

        $club->our_is_active = 2 ;

        $club->save();

        Auth::logout();

        return redirect()->back() ;
    }

    // club register first step [ Main Information ]
    public function registerClub(Request $request)
    {
        //return $request ;
        $validator = \Validator::make($request->all(),
                [
                    'type'          => '',
                    'user_img'      => '',
                    'name'          => 'required',
                    'c_phone'       => 'required|min:10',
                    'email'         => 'required|email|unique:users',
                    'c_city'        => 'required',
                    'c_area'        => 'required',
                    'c_address'     => 'required',
                    'password'      => 'required|min:6',
                    'c_desc'        => '',
                    'user_img'      => '',

                ],
                [],
                [
                    'name'      => 'Name',
                    'email'     => 'E-mail',
                    'password'  => 'Password',
                ]);
        // prepare data before create club main account info
       
        
        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()]);
        }elseif (request()->type == 2) {
             $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
        $slug = str_slug($request['name'] . '-' . $slugCode, '-');
        $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);
            //////////// IF Registering User type is Club ////////////
             $user = User::create([
                'name'              => $request['name'],
                'email'             => $request['email'],
                'slug'              => $slug,
                'user_img'          => '',
                'type'              => $request['type'],
                'user_is_active'    => 1,
                'our_is_active'     => 0,
                'active_code'       => $activateCode,
                'password'          => bcrypt($request['password']),
                ]);

             clubProfile::create(['c_user_id'       => $user->id,
                                  'c_phone'          => $request['c_phone'],
                                  'c_country'       => getCountry(),
                                  'c_city'          => $request['c_city'],
                                  'c_area'          => $request['c_area'],
                                  'c_address'       => $request['c_address'],
                                  'c_desc'          => $request['c_desc'],

                                ]) ;
             //for club logo
            if (!empty($request->user_img)) {
                $user_img = $request->user_img;


                list($type, $user_img) = explode(';', $user_img);
                list(, $user_img)      = explode(',', $user_img);


                $user_img = base64_decode($user_img);
                $clubLogo = $user->id . '-' . $user->slug . '-' . time() . '.png';

                $photoclubLogodatabaseRecord = "/profilePhotos/" . $clubLogo;

                Storage::disk('local')->put('public/' . $photoclubLogodatabaseRecord, $user_img);

                User::where('id', '=', $user->id)
                        ->update(array(
                            'user_img'   => $photoclubLogodatabaseRecord,
                        ));
            }

            /*clubBranche::create(['c_b_user_id'     => $user->id,
                                    'c_b_name'      => $data['name'].'-Main-Branch',
                                    'c_b_country'   => 1
                                ]) ;*/
             //return $user ;
            if (auth()->guard('web')->attempt(['email' => request('email'), 'password' => request('password'), 'our_is_active' => 0])) {
                return $user ;
                //return redirect('admin');
            }

        }
    }

    public function updateRegisterClubMainInfo(Request $request)
    {
        //return $request ;
        if ( !empty($request->password) ) {
            User::where('id', '=', Auth::user()->id)
                        ->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                            'password'          => bcrypt($request->password),
                        ));
        } else {
            User::where('id', '=', Auth::user()->id)
                        ->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                        ));
        }



        if (Auth::user()->id == $request->clubId) {
            clubProfile::where('c_user_id', '=', Auth::user()->id)
                        ->update(array(
                            'c_phone' => $request->c_phone,
                            'c_city' => $request->c_city,
                            'c_area' => $request->c_area,
                            'c_address' => $request->c_address,
                            'c_desc' => $request->c_desc,
                            //'p_date' => $request->p_born_date,
                        ));
            return $request->name ;
        } else {
            return 'failed' ;
        }

    }

    // update Club Profile Photo [[ register proccess ]]
    public function updateRegisterClubPhoto(Request $request)
    {
        if (Auth::id() == $request->clubId) {
            $oldProfilePhotoPath = Auth::user()->user_img ;
        }

        $data = $request->user_img;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name = Auth::id() . '-' . Auth::user()->slug . '-' . time() . '.png';

        $photoDatabaseRecord = "/profilePhotos/" . $image_name;

        Storage::disk('local')->put('public/' . $photoDatabaseRecord, $data);

        /*$path = public_path() . $photoDatabaseRecord ;
        file_put_contents($path, $data);*/

        Storage::has($oldProfilePhotoPath)? Storage::delete($oldProfilePhotoPath) :'' ;

        if (Auth::user()->id == $request->clubId) {
            User::where('id', '=', Auth::user()->id)
                        ->update(array(
                            'user_img' => $photoDatabaseRecord,
                        ));
              return response()->json(['success'=>'done','imgUrl'=>Storage::url(Auth::user()->user_img)]);
        } else {
            return 'failed' ;
        }

    }

    //display club for old
    public function index($id)
    {
        //return $id ;
        if (Gate::allows('Owner-Admin-only', Auth::user())) {
            $governorate = Governorate::with('areas')->get();

            $Sports = Sport::get();

            $club = User::where('users.id', '=', $id)
                    //->where('users.id', '=', Auth::user()->id)
                    ->firstOrFail();

            return view('club.home', compact('club', 'Sports', 'governorate'));
        }elseif(Gate::allows('Manager-only', Auth::user())){
            $governorate = Governorate::with('areas')->get();

            $Sports = Sport::get();

            $club = User::where('users.id', '=', $id)
                    //->where('users.id', '=', Auth::user()->id)
                    ->firstOrFail();

            return view('club.home', compact('club', 'Sports', 'governorate'));
        }

    }

     //display club profile
    public function profile($slug)
    {
        $governorate = Governorate::with('areas')->get();

        $Sports = Sport::get();

        $eventsCount = 0 ;

        $expectedEventsCount = 0 ;
        //return $Sports ;

        $club = User::where('users.slug', '=', $slug)
                    ->where('users.id', '=', Auth::user()->id)
                    ->where('users.type', '=', 2)
                    ->firstOrFail();
        foreach ($club->clubPlaygrounds as $playground) {
            $eventsCount = $eventsCount + $playground->playgroundEvents->count() ;
            $expectedEventsCount = $expectedEventsCount + $playground->expectedEvents->count() ;
        }
        //return $expectedEventsCount ;
        return view('club.Profile.Pages.userProfile', compact('club', 'Sports', 'governorate'));
    }

    // update activate status
    public function editClubActivate()
    {
        if (request()->target == Auth::user()->id) {
            User::where('id', request()->target)
            ->where('type', 2)
            ->update(['user_is_active' => request()->status]);

            return 'done';
        } else {
             return 'failed' ;
        }


    	return 2;
    }

    // update profile info
    public function updateProfile(Request $request)
    {
        $clubUser    = User::find(Auth::user()->id) ;
        $clubProfile = clubProfile::where('c_user_id', '=', Auth::user()->id)
                        ->first();
        $display = [] ;
        $oldData = [] ;
        $newData = [] ;

        foreach ($clubUser->toArray() as $CUkey => $CUvalue) {
            if ($request[$CUkey] != $CUvalue && $request->has($CUkey)) {
                $oldData[$CUkey] = $CUvalue ;
                $newData[$CUkey] = $request[$CUkey] ;
            }
        }

        foreach ($clubProfile->toArray() as $CPkey => $CPvalue) {
            if ($request[$CPkey] != $CPvalue && $request->has($CPkey)) {
                $oldData[$CPkey] = $CPvalue ;
                $newData[$CPkey] = $request[$CPkey] ;
            }
        }
        $namesArr = ['name'         => 'name',
                    'c_phone'       => 'phone',
                    'c_city'        => 'city',
                    'c_area'        => 'area',
                    'c_address'     => 'address',
                    'c_desc'        => 'description'
                    ] ;
        $models = ['city'   => ['table' => 'governorates',
                                 'DBname' => 'g_en_name'
                             ],
                    'area'  => ['table' => 'areas',
                                'DBname' => 'a_en_name'
                            ],
                    'sport' => ['table' => '\App\Model\Sport',
                                'DBname' => 'en_sport_name'
                            ]
                ] ;

        $i = 0 ;
        foreach ($oldData as $oldkey => $oldvalue) {

            $display[$i] = array(
                                'name' => $namesArr[$oldkey],
                                'old' => $oldvalue,
                                'new' => $newData[$oldkey]
                            );
            if (array_key_exists($display[$i]['name'],$models)) {
                /*print_r($models[$display[$i]['name']]['table']) ;
                echo "<br>";*/
                //return implode('',$models[$display[$i]['name']]['DBname']) ;
                $display[$i]['old'] = DB::table($models[$display[$i]['name']]['table'])
                                       ->select($models[$display[$i]['name']]['DBname'])
                                       ->where('id', '=', $display[$i]['old'] )
                                       ->first();
                //$display[$i]['old'] = $display[$i]['old']->$models[ $display[$i]['name'] ]['DBname'] ;
                //$display[$i]['old'] = $display[$i]['old'][ $models[$display[$i]['name']]['DBname'] ] ;
                /*$display[$i]['old'] = $models[$display[$i]['name']]['modelPath']::find($oldvalue) ;

                $display[$i]['old'] = $display[$i]['old']->$models[ $display[$i]['name'] ]['DBname'] ;*/
            }


            $i++ ;
        }
        /*for ($i = 0; $i < count($oldData); ++$i) {
            $display[$i] = array($i + 1 => $i + 1, $i + 2 => $i + 2, $i + 3 => $i + 3);
        }*/


        return $display ;
        // create new pending_data record
        $PendingEdit = new PendingEdit;

        $PendingEdit->taraget_model_type = '\App\Model\User';
        $PendingEdit->taraget_model_id   = Auth::id();
        $PendingEdit->user_id            = Auth::id();
        $PendingEdit->old_data           = json_encode($oldData);
        $PendingEdit->new_data           = json_encode($newData);

        $PendingEdit->save();
    	/*$PendingEdit = PendingEdit::create([
                    'taraget_model_type'    => '\App\Model\User',
                    'taraget_model_id'      => Auth::id(),
                    'user_id'               => Auth::id(),
                    'old_data'              => json_encode($oldData) ,
                    'new_data'              => json_encode($newData) ,
            ]);*/
         // send notification to the admins
         if ($PendingEdit) {
            $PendingEdit = PendingEdit::find($PendingEdit->id) ;
            $admins = Admin::all() ;
            //return $admins ;
            \Notification::send($admins, new NewClubEditRequest($clubUser, $PendingEdit));
            return 'done' ;
         } else {
             # code...
         }

         // return result to user

    }

    // update Club Profile Photo
    public function updateClubProfilePhoto(Request $request)
    {
        if (Auth::id() == $request->clubId) {
            $oldProfilePhotoPath = Auth::user()->user_img ;
        }

        $data = $request->image;


        list($type, $data) = explode(';', $data);
        list(, $data)      = explode(',', $data);


        $data = base64_decode($data);
        $image_name = Auth::id() . '-' . Auth::user()->slug . '-' . time() . '.png';

        $photoDatabaseRecord = "/profilePhotos/" . $image_name;

        Storage::disk('local')->put('public/' . $photoDatabaseRecord, $data);

        /*$path = public_path() . $photoDatabaseRecord ;
        file_put_contents($path, $data);*/

        Storage::has($oldProfilePhotoPath)? Storage::delete($oldProfilePhotoPath) :'' ;

        if (Auth::user()->id == $request->clubId) {
            User::where('id', '=', Auth::user()->id)
                        ->update(array(
                            'user_img' => $photoDatabaseRecord,
                        ));
              return response()->json(['success'=>'done','imgUrl'=>Storage::url(Auth::user()->user_img)]);
        } else {
            return 'failed' ;
        }

    }

    // to get page where club can update [ profile - branches - playgrounds ]
     public function updateAllData()
    {
        $governorate = Governorate::with('areas')->get();
;
        return view('club.Edits.Edits',  compact( 'governorate'));

    }
    //%%%%%%%%%%%%%%%%%%% ajax functions for load partial views %%%%%%%%%%%%%%%%%%//

    public function registerPageTop()
    {
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.register.pageParts.rejectedMessage', compact('club', 'governorate')) ;

    }

    public function editMainRegisterInfo($when = '')
    {
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;
        if ($when == 'ear') {
            return view('club.Edits.pageParts.editMainRegisterInfo', compact('club', 'governorate')) ;
        } else {
            return view('club.register.pageParts.editMainRegisterInfo', compact('club', 'governorate')) ;
        }
        
        

    }

    public function registerAddBranch($when = '')
    {
        //return $when ;
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //ear => edit after register 
        if ($when == 'ear') {
            //return 2 ;
            return view('club.Edits.pageParts.addNewBranch', compact('club', 'governorate')) ;
        } else {
            //return 1;
            return view('club.register.pageParts.addNewBranch', compact('club', 'governorate')) ;
        }

    }

    public function registerAddPlayground()
    {
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.register.pageParts.addNewPlayground', compact('club', 'governorate')) ;
    }
    /*
    * function to load patrial view after A club update main profile info
    */
    public function mainInfoDivLoad()
    {
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.Profile.pageParts.userProfile.mainUserProfileInfo', compact('club', 'governorate')) ;
    }

    public function imageinfodivload()
    {
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.Profile.pageParts.userProfile.userProfileImageDiv', compact('club', 'governorate')) ;
    }


    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }

    /////////////////////////////////////////////////////////////////
    /* functions for club users [ display - create - store - update - delete - ] */
    /////////////////////////////////////////////////////////////////

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
