<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $rules = $request->validate([
            'first_name'        => "required",
            'last_name'         => "required",
            'role'              => "required",
            'email'             => "required|email|regex:^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$^|unique:users",
            'password'          => "required",
            'confirm_password'  => 'required|same:password',
        ]);
        try {
            $users = User::create([
                                    'first_name'        => $request->first_name,
                                    'last_name'         => $request->last_name,
                                    'role'              => $request->role,
                                    'email'             => $request->email,
                                    'password'          => $request->password,
                                    'confirm_password'  => $request->confirm_password,
                                ]);

            $role = $request->role;
            if($role == 'User') {
                $email    = $request->email;
                $password = $request->password;
                $user = User::where('email', $email)->first();
                if(!empty($user)) {
                    if((['email' => $email , 'password' => $password])) {
                        if($email == $user->email && $password == $user->password) {
                            Auth::login($user);
                            return redirect('/dashboard');
                        }
                    }
                }
            } else {
                return view('auth.login');
            }
        } catch(Exception $e) {
            return 'Unable to create USER!!<a href='.URL('register').'>Back to Register !!</a>';
        }
    }
}
