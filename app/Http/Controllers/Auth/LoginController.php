<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->addViewData([
            'alerts' =>  [
                'info'  =>  'Enter your login information',
            ]
        ]);
    }

    public function showLoginForm()
    {
        return view('auth.login')->with($this->viewData);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        $attempt = [
            'email'                 => $request->email,
            'password'              => $request->password,
            'status'                => 0,
            'block'                 => 0
        ];
        if (Auth::attempt($attempt, $request->remember)) {
            // if successful, then redirect to their intended location
            return redirect()->intended('/dashboard');
        }

        //return $this->sendFailedLoginResponse($request);
        return redirect()->back()->withInput($request->only('email', 'remember'))->with('alerts',['error_'  =>  "Wrong user details!"]);

    }

    /*public function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }*/
}
