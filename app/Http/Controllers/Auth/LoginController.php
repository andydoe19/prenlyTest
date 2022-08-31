<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * This function is called when login page displays.
     * It saves the previous url in the session, so user can return to that page upon login
     */
    public function showLoginForm()
    {
        if(!session()->has('from')){
            session()->put('from', url()->previous());
        }
        return view('auth.login');
    }


    /**
     * Once user is successfully authenticated, this function is called
     * And it return the user back to the page he/she was on before loging in
     */
    public function authenticated($request, $user)
    {
        return redirect(session()->pull('from',$this->redirectTo));
    }
}
