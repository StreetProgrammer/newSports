<?php

namespace App\Http\Controllers\Club;
use App\Http\Controllers\Controller ;
//use App\Http\Controllers\App\User ;
use Storage ;
use Charts ;
use App\Traits\ChartsGenrator ;
use App\Traits\Olddatakepper ;

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
use App\Model\Reservation;

use App\DataTables\Club\ClubUsersDatatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Gate ;

class ClubProfilesController extends Controller
{
    use ChartsGenrator ;
    use Olddatakepper ;
    /*
    *function to handle send data to the app admin to accept or reject club profile
    */
    public function NewClubProfileCreated(Request $request)
    {
        $club = User::find($request->clubId);
        $admins = Admin::all();

        if ($club->our_is_active == 0) {
            \Notification::send($admins, new NewClubRegistered($club));
        } elseif ($club->our_is_active == 3) {
            \Notification::send($admins, new NewClubFixedErr($club));
        }elseif($club->our_is_active == 1){
            \Notification::send($admins, new NewClubEditRequest($club));
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
                                  'c_country'       => $request['c_country'], //getCountry(),
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
                            'c_city' => $request->c_country,
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

    public function index($id)
    {
        $configReservationPercentage = [
                'labels'    => '' ,
                'values'    => '' ,
                'model'     => 'Reservation' ,
                'groupBy'   => 'reservedBy' ,
        ] ;
        $reservationPercentage = self::prepareChart('club', 'home', 'reservationPercentage', $id) ;
        $allReservationByYear = self::prepareChart('club', 'home', 'allReservationByYear', $id) ;
        $allReservationByMonth = self::prepareChart('club', 'home', 'allReservationByMonth', $id) ;
        $allReservation =  self::prepareChart('club', 'home', 'allReservation', $id) ;
        //$reservations = Reservation::where('R_playground_owner_id', Auth::id())->get();
        
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $Sports = Sport::get();

        if (Gate::allows('Owner-Admin-only', Auth::user())) {
            $club = User::where('users.id', '=', $id)
                    //->where('users.id', '=', Auth::user()->id)
                    ->firstOrFail();

            return view('club.home', compact('club', 'Sports', 'governorate', 'countries', 'reservationPercentage', 'allReservationByYear', 'allReservationByMonth', 'allReservation'));
        }elseif(Gate::allows('Manager-only', Auth::user())){
            $club = User::where('users.id', '=', $id)
                    //->where('users.id', '=', Auth::user()->id)
                    ->firstOrFail();

            return view('club.home', compact('club', 'Sports', 'governorate', 'countries'));
        }

    }

     //display club profile
    public function profile($slug)
    {
        $countries = Country::get();
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
        return view('club.Profile.Pages.userProfile', compact('club', 'Sports', 'governorate', 'countries'));
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

    public function OldUpdateProfile(Request $request)
    {
        return $request ;


        if ( !empty($request->password) ) {
            User::where('id', '=', $clubUser->id)->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                            'password'          => bcrypt($request->password),
                        ));
        } else {
            User::where('id', '=', $clubUser->id)->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                        ));
        }

        if (Auth::user()->id == $request->clubId) {
            clubProfile::where('c_user_id', '=', $clubUser->id)
                        ->update(array(
                            'c_phone' => $request->c_phone,
                            'c_city' => $request->c_country,
                            'c_city' => $request->c_city,
                            'c_area' => $request->c_area,
                            'c_address' => $request->c_address,
                            'c_desc' => $request->c_desc,
                        ));
            return $request->name ;
        } else {
            return 'failed' ;
        }
    }

    // update profile info
    public function updateProfile(Request $request)
    {
        $clubUser    = User::find($request->clubId) ;
        $clubProfile = clubProfile::where('c_user_id', '=', $request->clubId)->first();

        $PendingEdit = self::prepare('\App\Model\User', $request->clubId, $clubUser, $request) ;
        
        self::prepare('App\Model\clubProfile', $clubProfile->id, $clubProfile, $request) ;
        // strat update here 
        if ( !empty($request->password) ) {
            User::where('id', '=', $clubUser->id)->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                            'password'          => bcrypt($request->password),
                        ));
        } else {
            User::where('id', '=', $clubUser->id)->update(array(
                            'name'              => $request->name,
                            'email'             => $request->email,
                        ));
        }

        if (Auth::user()->id == $request->clubId) {
            clubProfile::where('c_user_id', '=', $clubUser->id)->update(array(
                            'c_phone' => $request->c_phone, 'c_country' => $request->c_country,
                            'c_city' => $request->c_city, 'c_area' => $request->c_area,
                            'c_address' => $request->c_address, 'c_desc' => $request->c_desc,
                        ));
            //return $request->name ;
        } else {
            return 'failed' ;
        }
        if ($PendingEdit) {

            $PendingEdit = PendingEdit::find($PendingEdit->id) ;
            $admins = Admin::all() ;
            \Notification::send($admins, new NewClubEditRequest($clubUser, $PendingEdit));
            return 'done' ;
         }

    }

    /* 
    * update Club Profile Photo Post for update Club Profile Photo
    *  return response('done', 'imgUrl' or 'false')
    */
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

    /* 
    * Final Simple Get Route
    *  return view('club.Edits.Edits')
    */
     public function updateAllData() 
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();

        return view('club.Edits.Edits',  compact( 'governorate', 'countries'));
    }


    //%%%%%%%%%%%%%%%%%%% Start ajax functions for load partial views %%%%%%%%%%%%%%%%%%//

    public function registerPageTop()
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //return $club ;

        return view('club.register.pageParts.rejectedMessage', compact('club', 'governorate', 'countries')) ;

    }

    public function editMainRegisterInfo($when = '')
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;
        if ($when == 'ear') {
            return view('club.Edits.pageParts.editMainRegisterInfo', compact('club', 'governorate', 'countries')) ;
        } else {
            return view('club.register.pageParts.editMainRegisterInfo', compact('club', 'governorate', 'countries')) ;
        }

    }

    public function registerAddBranch($when = '')
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //ear => edit after register 
        if ($when == 'ear') {
            //return 2 ;
            return view('club.Edits.pageParts.addNewBranch', compact('club', 'governorate', 'countries')) ;
        } else {
            //return 1;
            return view('club.register.pageParts.addNewBranch', compact('club', 'governorate', 'countries')) ;
        }
    }

    public function registerAddPlayground()
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //return $club ;

        return view('club.register.pageParts.addNewPlayground', compact('club', 'governorate', 'countries')) ;
    }
    /*
    * function to load patrial view after A club update main profile info
    */
    public function mainInfoDivLoad()
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.Profile.pageParts.userProfile.mainUserProfileInfo', compact('club', 'governorate', 'countries')) ;
    }

    public function imageinfodivload()
    {
        $countries = Country::get();
        $governorate = Governorate::with('areas')->get();
        $id = Auth::user()->id ;
        $club = User::find($id) ;
        //$club = json_encode($Event) ;
        //return $club ;

        return view('club.Profile.pageParts.userProfile.userProfileImageDiv', compact('club', 'governorate', 'countries')) ;
    }

    //%%%%%%%%%%%%%%%%%%% End ajax functions for load partial views %%%%%%%%%%%%%%%%%%//

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }

    
}
