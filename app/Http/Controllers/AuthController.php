<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserVerifyMail;
use App\Mail\ForgotPassMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'job' => $request->job,
            'dob' => $request->dob
            ]);

        $token = $user->createToken($request->device_name)->plainTextToken;
        Mail::to($user->email)
        ->send(new UserVerifyMail($user->id, $token, $user->name));
        // return $token;
		return response()->json(
            [
                'token' => $token,
                'user_id' => $user->id
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function login(Request $request){
        $request->validate([
            'device_name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            return ['errors' => 'メールアドレスとパスワードが一致しません。'];
        }

        if ($user->email_verified_at == null) {
            return ['errors' => 'ユーザーが未登録です。登録の際に送ったメールリンクを開いてユーザー登録を完了させてください。'];
        }

        return response()->json(
            [
                'token' => $user->createToken($request->device_name)->plainTextToken,
                'user_id' => $user->id
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function logout (Request $request) {
        $request->validate([
            'id' => 'required'
        ]);
        $user = User::find(intval($request->id));
        if ($user) {
            $user->tokens()->delete();
        }

        return response()->json(
            [],
            200,
            [],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function verify(Request $request){
        return view('api.verify');
    }

    public function verify_email(Request $request, $user_id){
        $request->validate([
            'device_name' => 'required'
        ]);
        $user = User::find(intval($user_id));
        $user->email_verified_at = Carbon::now();
        $user->save();
        $user->tokens()->delete();
        
        return response()->json(
            [
                'token' => $user->createToken($request->device_name)->plainTextToken,
                'user_id' => $user->id
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function resend_token(Request $request) {
        $request->validate([
            'device_name' => 'required',
            'email' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return ['errors' => 'メールアドレスが正しくありません。'];
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        Mail::to($user->email)
        ->send(new UserVerifyMail($user->id, $token, $user->name));
        // return $token;
		return response()->json(
            [
                'token' => $token,
                'user_id' => $user->id
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function forget_pass(Request $request){
        $request->validate([
            'email' => 'required'
        ]);
        $random_int = mt_rand(1000, 9999);

        Mail::to($request->email)
        ->send(new ForgotPassMail($random_int));

        return response()->json(
            $random_int,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function change_forget_pass(Request $request) {
        $request->validate([
            'email' => 'required',
            'pass' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->pass);
            $user->save();
        } else {
            return ['errors' => 'メールアドレスが登録されていません。'];
        }
        return response()->json(
            $user,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }
    
}
