<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Model\User;
use App\Model\playerProfile;
use App\Model\ClubProfile;
use App\Model\clubBranche;
use App\Mail\player\VerifyMail;
use Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use Auth ;
class RegisterController extends Controller
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
            'type' => 'required|string',
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
                'name'                  => $data['name'],
                'email'                 => $data['email'],
                'slug'                  => $slug,
                'type'                  => $data['type'],
                'user_is_active'        => 1,
                'our_is_active'         => 0,
                'active_code'           => $activateCode,
                'password'              => bcrypt($data['password']),
                ]);

             clubProfile::create(['c_user_id'       => $user->id,
                                  'c_country'       => getCountry()

                                ]) ;
             clubBranche::create(['c_b_user_id'     => $user->id, 
                                    'c_b_name'      => $data['name'].'-Main-Branch',
                                    'c_b_country'   => getCountry()
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
                'verified'          => 0,
                'active_code'       => $activateCode,
                'password'          => bcrypt($data['password']),
                'verify'            => str_random(40),
                ]);

            playerProfile::create(['p_user_id'              => $user->id,
                                   'p_country'              => getCountry(),
                                   'p_preferred_gender'     => 0,
                                   'p_gender'               => 0,
                                ]) ;

            Mail::to($user->email)->send(new VerifyMail($user));
            $redirectTo = $user->type == 1 ? '/home' : 'club/' .$user->slug . '/complete_profile';
            return $user ;
        }
    }

    public function verifyUser($token)
    {
        $User = User::where('verify', $token)->first() ;
        $verifyUser = $User->verify ;
        if( $verifyUser ){
            $user = User::where('verify', $token)->first();
            if($user->verified == 0) {
                $user->verified = 1;
                $user->save();
                $en_status = 'Your e-mail is verified. You can now login.' ;
                $ar_status = 'تم التأكد من الإيميل الخاص بك يمكنك تسجيل الدخول الان' ;
                $status = direction() == 'ltr' ? $en_status : $ar_status ;
            }else{
                $en_status = 'Your e-mail is verified. You can now login.' ;
                $ar_status = 'تم التأكد من الإيميل الخاص بك يمكنك تسجيل الدخول الان' ;
                $status = direction() == 'ltr' ? $en_status : $ar_status ;
            }
        }else{
            $en_warning = 'Sorry your email cannot be identified.' ;
            $ar_warning = 'للأسف لا يمكننا التعرف علي الإيميل الخاص بك' ;
            $warning = direction() == 'ltr' ? $en_warning : $ar_warning ;
            return redirect('/login')->with('warning', $warning);
        }

        return redirect('/login')->with('status', $status);
    }


    /**
     * The user has been registered. overrided function itis exist in ( RegistersUsers )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        $en_status = 'We sent you an activation code. Check your email and click on the link to verify.' ;
        $ar_status = 'لقد تم ارسال كود التحقق على اللإيميل الخاص بك ,من فضلك راجع الإيميل واضغط على رابط التأكد لتأكيد حسابك' ;
        $status = direction() == 'ltr' ? $en_status : $ar_status ;
        return redirect('/login')->with('status', $status);
    }

}
