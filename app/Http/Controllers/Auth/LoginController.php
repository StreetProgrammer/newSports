<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite ;
use App\Model\User;
use App\Model\playerProfile;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo(); 
        }
        //else{
            if (Auth::user()->type == 1) { //if [[ Player ]]
                return '/profile/' .  sm_crypt(Auth::id()) ;
            } 
            elseif(Auth::user()->type == 2) { //if [[ club owner ]]
                return '/club/'.Auth::user()->id ;
            }  
            elseif(Auth::user()->type == 3) { //if [[ club admin ]]
                return '/club/'.Auth::user()->club_id ;
            }  
            elseif(Auth::user()->type == 4) { //if [[ club manager ]]
                return '/club/'.Auth::user()->club_id ;
            }
        //}
        //return Auth::user()->type == 1 ? '/home' : '/club/'.Auth::user()->slug;
        //return property_exists($this, 'redirectTo') && Auth::user()->type == 1 ? $this->redirectTo : '/home';
    }

    /**
     * Redirect the user to the Facebook authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();

        if ($this->findOrCreate($provider, $user) == 1) {
            return redirect('/profile/' . sm_crypt(Auth::id()) );
            //return redirect('/home');
        } else {
            return redirect('/login');
        }
        
        
        //return $user['name'] ;
        
    }

    public function findOrCreate($provider, $user)
    {   
        $authUser = User::Where('email', $user->email)->first();
        if ($authUser) {

            if ($authUser->type == 1 && $authUser->our_is_active == 1) {
                Auth::login($authUser, true);
                return 1;
            } elseif ($authUser->type != 1 || $authUser->our_is_active != 1) {
                return 0 ;
            }
            
        } else {
            $slugCode = substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5);
            $slug = str_slug($user->name . '-' . $slugCode, '-');
            $activateCode = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 8)), 0, 8);
            
            $newuser = User::create([
                'name'              => $user->name,
                'email'             => $user->email,
                'slug'              => $slug,
                'type'              => 1,
                'user_is_active'    => 1,
                'our_is_active'     => 1,
                'verified'          => 1,
                'active_code'       => $activateCode,
                'password'          => bcrypt('secret'),
                'verify'            => str_random(40),
                ]);

            playerProfile::create(['p_user_id'              => $newuser->id,
                                   'p_country'              => getCountry(),
                                   'p_preferred_gender'     => 0,
                                   'p_gender'               => 0,
                                ]) ;
            return 1;
        }
        
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->type == 1) { // make sure the user is a player 
            if ($user->verified == 0) { // check if user is verified or not
                auth()->logout();
                $en_warning = 'You need to confirm your account. We have sent you an activation code, please check your email.' ;
                $ar_warning = 'سوف تحتاج إلى تأكيد حسابك وقد تم ارسال كود التأكيد يرجى مراجعة اللإيميل الخاص بك' ;
                $warning = direction() == 'ltr' ? $en_warning : $ar_warning ;
                return back()->with('warning', $warning);
            }
        }
        return redirect()->intended($this->redirectPath());
        
    }
}
