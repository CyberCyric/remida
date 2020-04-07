<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
    protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(\Illuminate\Http\Request $request)
    {
         return [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'active' => 1,
            'deleted' => 0
        ];
    }

    protected function attemptLogin(Request $request)
    {
        return Auth::attempt(
            $this->credentials($request) + ["active" => '1'] + ["deleted" => '0'],
            $request->filled('remember')
        );
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password', 'active');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }


    protected function setUserSession($user, $isAdmin)
    {        
        session(
            [
                'user' => $user,
                'isAdmin' => $isAdmin
            ]
        );
    }

     protected function authenticated(Request $request, $user)
    {
        DB::connection()->enableQueryLog();
        $usuario = DB::table('users')
                    ->where('email', '=', $request->email)
                    ->get();

        if ($usuario[0]->role == 'A') {
            $this->setUserSession($user, true); 
        } else {
            $this->setUserSession($user, false);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
