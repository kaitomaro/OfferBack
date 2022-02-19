<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Shop;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:shops'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'zip_code' => ['required', 'string'],
            'address' => ['required', 'string'],
            'phone' => ['required'],
            'is_vip' => ['nullable'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Shop
     */
    protected function create(array $data)
    {
        if (isset($data['is_vip'])){
            return Shop::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'zip_code' => $data['zip_code'],
                'address' => $data['address'],
                'phone' => $data['phone'],
                'is_vip' => intval($data['is_vip']),
            ]);
        } else{
            return Shop::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'zip_code' => $data['zip_code'],
                'address' => $data['address'],
                'phone' => $data['phone'],
            ]);
        }
        
    }

    public function showRegistrationForm() {
        if (!(Auth::guard('admin')->check())) {
            return redirect('/admin/login');
        }
        return view('admin.auth.register');
    }

    protected function guard()
    {
        return \Auth::guard('admin');
    }
    
}