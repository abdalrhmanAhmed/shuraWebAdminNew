<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
// use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    protected function validateLogin(Request $request)
    {
        // return $request->all();
    $user = User::where($this->username(), '=', $request->input($this->username()))->first();
    if ($user && ! $user->isActive == 1) {
        throw ValidationException::withMessages([$this->username() => __('الحساب غير مفعل')]);
    }
    $request->validate([
        $this->username() => 'required|string',
        'password' => 'required|string',
        ]);
    }
    /**
     * 
     *
     * @override guard 
     */
    protected function guard()
    {
        return Auth::guard('web');
    }
}
