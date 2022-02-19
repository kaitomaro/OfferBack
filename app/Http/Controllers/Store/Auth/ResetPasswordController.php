<?php

namespace App\Http\Controllers\Store\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::STORE_HOME;
    public function __construct()
    {
        $this->middleware('guest:shop');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('store.auth.passwords.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    protected function guard()
    {
        return \Auth::guard('shop');
    }

    public function broker()
    {
        return \Password::broker('shops');
    }
    
}
