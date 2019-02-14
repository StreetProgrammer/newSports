<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\playerProfile;
use App\Model\ClubProfile;
use App\Model\clubBranche;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

use Auth ;
class OldRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:255|min:4',
            'email' => 'required|string|email|max:255|unique:users',
            'type' => '',
            'password' => 'required|string|min:3|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //return $data['type'] ;
        $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
        $slug = str_slug($data['name'] . '-' . $slugCode, '-');
        $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);

        if ($data['type'] == 2) {
            //////////// IF Registering User type is Club////////////
             $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'slug' => $slug,
                'type' => $data['type'],
                'user_is_active' => 1,
                'our_is_active' => 0,
                'active_code' => $activateCode,
                'password' => bcrypt($data['password']),
                ]);

             clubProfile::create(['c_user_id'    => $user->id,
                                  'c_country'  => 1

                                ]) ;
             clubBranche::create(['c_b_user_id'     => $user->id, 
                                    'c_b_name'      => $data['name'].'-Main-Branch',
                                    'c_b_country'   => 1
                                ]) ;
             return $user ;
        }elseif($data['type'] == 1){  
            //////////// IF Registering User type is Player////////////
            $user = User::create([
                'name'              => $data['name'],
                'email'             => $data['email'],
                'slug'              => $slug,
                'type'              => $data['type'],
                'user_is_active'    => 1,
                'our_is_active'     => 1,
                'active_code'       => $activateCode,
                'password'          => bcrypt($data['password']),
                ]);

            playerProfile::create(['p_user_id' => $user->id,
                                   'p_country'  => 1
                                ]) ;

            
            //$redirectTo = $user->type == 1 ? '/home' : '/club/'.$user->slug;
            $redirectTo = $user->type == 1 ? '/home' : 'club/' .$user->slug . '/complete_profile';
            return $user ;
            //return Auth::user()->type == 1 ? '/home' : '/club/'.Auth::user()->slug;
        }
    }
}
