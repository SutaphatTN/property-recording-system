<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate($request, ['email' => 'required|email', 'password' => 'required']);
        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            return redirect()->intended(function () {
                if (Auth::user()->role == 'audit') {
                    return route('assetData.index');
                } else {
                    return route('maintenance.index');
                }
            });
        } else {
            return redirect('login')->with('error', "username หรือ password ผิดพลาด");
        }
    }
}
