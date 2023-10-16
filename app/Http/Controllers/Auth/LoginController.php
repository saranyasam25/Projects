<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{

    public function login(Request $request) {
        $rules = $request->validate([
            'email'    => 'required',
            'password' => 'required',
        ]);

        $email    = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if(!empty($user)) {
            if((['email' => $email , 'password' => $password])) {
                if($email == $user->email && $password == $user->password) {
                    Auth::login($user);

                    return redirect('/dashboard');
                }else {
                    return Redirect::back()->withErrors('Invalid email or password.');
                }
            }else {
                return Redirect::back()->withErrors('Invalid email or password.');
            }
        } else {
            return Redirect::back()->withErrors('Invalid email address.');
        }
    }

    public function forgotPassword(Request $request) {

        $rules = $request->validate([
            'email'            => 'required',
            'password'         => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $email = $request->email;
        $pass  = $request->password;
        $confi = $request->confirm_password;

        $user = User::where('email', $email)->first();
        if($user){
            $users = User::where('email', $email)
                            ->update([
                                'password'          => $request->password,
                                'confirm_password'  => $request->confirm_password,
                            ]);
            return view('auth.login');
        }else{
            return Redirect::back()->withErrors('Invalid email address.');
        }
    }

    public function logout() {
        Auth::logout();
        return;
    }
}
