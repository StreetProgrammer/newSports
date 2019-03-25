<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller ;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;

use App\Model\Admin ;
use App\Mail\AdminResertPassword;
use Carbon\Carbon;
use DB;
use Mail;

class AdminAuth extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }

    public function dologin()
    {
    	$rememberme = request('rememberme') == 1 ? true: false ;
    	if (auth()->guard('adminGuard')->attempt(['email' => request('email'), 'password' => request('password'), 'our_is_active' => 1], $rememberme)) {
            if(session()->has('taragetPage')){
                $taragetPage = session()->get('taragetPage');
                session()->forget('taragetPage');
                return redirect( $taragetPage ) ;
            }
    		return redirect('admin');
            //return redirect()->back();
    	} else{

    		session()->flash('error', trans('admin.inccorrect_information_login'));
    		return redirect('admin/login');
    	}

    	
    }

    public function logout()
    {
    	auth()->guard('adminGuard')->logout();
    	return redirect('admin/login');
    }

    public function forgot_password()
    {
    	return view('admin.forgot_password');
    }

    public function forgot_password_post($value='')
    {
    	$admin = Admin::where('email', request('email'))->first();
    	if (!empty($admin)) {

    		$token = app('auth.password.broker')->createToken($admin);
    		$data = DB::table('password_resets')->insert([
    			'email' =>$admin->email,
    			'token' => $token,
    			'created_at' => Carbon::now(),
    		]);

            Mail::to($admin->email)->send(new AdminResertPassword(['data' => $admin, 'token' => $token]));
            session()->flash('success', trans('admin.the_link_reset_sent'));
    		return back();

    	}
    	return back();
    }

    public function reset_password($token)
    {
        $check_token = DB::table('password_resets')
                                ->where('token', $token)
                                ->where('created_at', '>', Carbon::now()->subHours(2))
                                 ->first();
         //return $check_token ;
        if (!empty($check_token)) {
            return view('admin.reset_password', ['data' => $check_token]);
        } else {
            return redirect(aurl('forgot/password'));
        }
        
    }

    public function reset_password_post($token)
    {

        $this->validate(request(),[
            'password'                  => 'required|confirmed',
            'password_confirmation'     => 'required'
        ], [], [
            'password'                  => 'Password',
            'password_confirmation'     => 'Confirmation Password'
        ]);
        $check_token = DB::table('password_resets')
                                ->where('token', $token)
                                ->where('created_at', '>', Carbon::now()->subHours(2))
                                 ->first();
         //return $check_token ;
        if (!empty($check_token)) {
            $admin = Admin::where('email', $check_token->email)
                            ->update(['email' => $check_token->email, 
                                      'password' => bcrypt(request('password'))
                                    ]);
            DB::table('password_resets')->where('email', request('email'))->delete();
            //admin()->login($admin);
            admin()->attempt(['email' => $check_token->email, 'password' => request('password')], true);
            return redirect(aurl());
        }else{
            return redirect(aurl('forgot/password'));
        }
    }

}
