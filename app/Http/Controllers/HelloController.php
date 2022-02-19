<?php

namespace App\Http\Controllers;

use App\Shop;
use App\EmailChange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;


class HelloController extends Controller
{
    public function get_hello_mail(Request $request) {

        $token = $request->token;
        $signature = $request->signature;
        $tmp_mail = EmailChange::where('token',$token)->first();

        return view(
            'store/hello', 
            [
                'signature' => $signature,
                'tmp_mail' => $tmp_mail
            ]
        );
    }

    public function start_store_account(Request $request) {

        $token = $request->token;
        $shop_id = intval($request->shop_id);
        $email = $request->email;
        $tmp_mail = EmailChange::where('token', $token);
        $tmp_mail->delete();
        $shop = Shop::find($shop_id);
        if ($shop == null) {
            return redirect('/');
        }
        $shop->email_verified_at = Carbon::now();
        $shop->email = $email;
        $shop->save();

        return redirect('/store');
    }
    
}
