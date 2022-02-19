<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use App\Earning;
use App\Contact;
use App\Notice;
use App\Device;
use App\Mark;
use App\Loto;
use App\Mail\SendContactMail;
use App\Mail\ThankForContactMail;
use App\Mail\SendLotoMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Aws\Sns\Exception\SnsException;
use Illuminate\Support\Facades\App;

class UserController extends Controller
{
    public function show(Request $request, $user_id) {
        $user = User::find(intval($user_id));
        return response()->json(
            $user,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function update(Request $request, $user_id) {
        $user = User::find(intval($user_id));
        $request->validate([
            'name' => 'required'
        ]);
        $user->name = $request->name;
        if ($request->gender != null) {
            $user->gender = $request->gender;
        } else {
            $user->gender = "";
        }

        if ($request->job != null) {
            $user->job = $request->job;
        } else {
            $user->job = "";
        }

        if ($request->dob != null) {
            $user->dob = $request->dob;
        } else {
            $user->dob = "";
        }
        
        if ($request->favarite_area != null) {
            $user->favarite_area = $request->favarite_area;
        }

        if ($request->favarite_area2 != null) {
            $user->favarite_area2 = $request->favarite_area2;
        } else {
            $user->favarite_area2 = "";
        }
        $user->save();

        return response()->json(
            $user,
            200,[],
            JSON_UNESCAPED_UNICODE
        );

    }

    public function history(Request $request, $user_id) {
        $earnings = DB::table('earnings')
        ->where('earnings.user_id', intval($user_id))
        ->leftJoin('shops', function($join)  {
            $join->on('earnings.shop_id', '=', 'shops.id');
        })
        ->select(
            'earnings.user_id as user_id',
            'earnings.shop_id as shop_id',
            'earnings.created_at as created_at',
            'earnings.people as people',
            'earnings.discount as discount',
            'earnings.discount_type as discount_type',
            'earnings.service_type as service_type',
            'earnings.name as menu_name',
            'shops.name as name',
            'shops.top_image as top_image',
        )
        ->latest()
        ->get();
        return response()->json(
            $earnings,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function check_today(Request $request, $store_id, $user_id) {

        $today = Earning::where('shop_id', intval($store_id))
        ->where('user_id', intval($user_id))
        ->where('created_at', '>=', Carbon::today()->toDateString())
        ->select(
            'user_id',
            'shop_id',
            'created_at'
        )
        ->get();

        $history = Earning::where('shop_id', intval($store_id))
        ->where('user_id', intval($user_id))
        ->select(
            'user_id',
            'shop_id',
            'created_at'
        )
        ->get();
            
        return response()->json(
            [
                'today' => $today,
                'history' => $history
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function contact(Request $request, $user_id) {
        $user = User::find(intval($user_id));
        $contact = new Contact();
        $contact->name = $user->name;
        $contact->email = $user->email;
        $contact->sentence = $request->sentence;
        $contact->save();

        Mail::to("contact@eatap.co.jp")
        ->send(new SendContactMail($contact->name, $contact->email, $contact->sentence));

        Mail::to($user->email)
        ->send(new ThankForContactMail($contact->name, $contact->sentence));

        return response()->json(
            $user,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }


    public function change_pass (Request $request, $user_id) {
        $request->validate([
            'pass' => 'required',
            'new_pass' => 'required'
        ]);

        $user = User::find(intval($user_id));
        if (Hash::check($request->pass, $user->password)) {
            $user->password = Hash::make($request->new_pass);
            $user->save();
        } else {
            return ['errors' => 'パスワードが正しくありません。'];
        }

		return response()->json(
            $user,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function get_notice (Request $request, $user_id) {
        $notices = DB::table('notices')
        ->where('notices.user_id', 0)
        ->orwhere('notices.user_id', intval($user_id))
        ->leftJoin('marks', function($join) use($user_id) {
            $join->on('notices.id', '=', 'marks.notice_id')
            ->where('marks.user_id', '=', intval($user_id));
        })
        ->select(
            'notices.id as id',
            'notices.sender_id as sender_id',
            'notices.title as title',
            'notices.body as body',
            'notices.created_at as created_at',
            'marks.id as marks_id'
        )
        ->latest()
        ->get();

        return response()->json(
            $notices,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function get_my_page (Request $request, $user_id) {
        $notices = DB::table('notices')
        ->where('notices.user_id', 0)
        ->orwhere('notices.user_id', intval($user_id))
        ->get();
        $marks = Mark::where('user_id', intval($user_id))
        ->get();
        $not_read_mark = 0;
        if (count($notices) == count($marks)) {
            $not_read_mark = 0;
        } else {
            $not_read_mark = 1;
        }

        $earnings = Earning::where('user_id', intval($user_id))->get();
        $lotos = Loto::where('user_id', intval($user_id))->get();
        $have_loto = 0;
        if (count($earnings) == count($lotos)) {
            $have_loto = 0;
        } else {
            $have_loto = 1;
        }

        return response()->json(
            [
                'not_read_mark' => $not_read_mark,
                'have_loto' => $have_loto
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function get_amount_of_lotos (Request $request, $user_id) {
        $earnings = Earning::where('user_id', intval($user_id))->get();
        $lotos = Loto::where('user_id', intval($user_id))->get();
        $amount_of_lotos = 0;
        $amount_of_lotos = count($earnings) - count($lotos);

        return response()->json(
            $amount_of_lotos,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function read_article (Request $request) {
        $read = Mark::where('user_id', $request->user_id)
        ->where('notice_id', $request->notice_id)
        ->first();

        if ($read == null) {
            $read = new Mark();
            $read->user_id = $request->user_id;
            $read->notice_id = $request->notice_id;
            $read->save();
        }

        return response()->json(
            $read,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function read_articles(Request $request) {
        $user_id = intval($request->user_id);

        $notices = DB::table('notices')
        ->where('notices.user_id', 0)
        ->orwhere('notices.user_id', $user_id)
        ->leftJoin('marks', function($join) use($user_id) {
            $join->on('notices.id', '=', 'marks.notice_id')
            ->where('marks.user_id', '=', $user_id);
        })
        ->select(
            'notices.id as id',
            'notices.sender_id as sender_id',
            'notices.title as title',
            'notices.body as body',
            'notices.created_at as created_at',
            'marks.id as marks_id'
        )
        ->latest()
        ->get();

        foreach ($notices as $key => $notice) {
            if ($notice->marks_id == null) {
                $read = new Mark();
                $read->user_id = $user_id;
                $read->notice_id = $notice->id;
                $read->save();
                $notice->marks_id = $read->id;
            }
        }
        
        return response()->json(
            $notices,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function create_loto (Request $request, $user_id) {
        $loto = new Loto();
        $loto->user_id = intval($user_id);
        $loto->kind_of_prize = intval($request->kind_of_prize);
        $loto->amount_of_money = intval($request->amount_of_money);
        
        if ($loto->kind_of_prize != 0) {
            $notice = new Notice();
            $notice->title = "クーポンくじで".$loto->kind_of_prize."等に当選しました。";
            $notice->body = "EatapからAmazonギフト券が送られます。"."\n"."コードが送信されますのでしばらくお待ちください。";
            $notice->user_id = intval($user_id);
            $notice->save();
            $loto->notice_id = $notice->id;
            Mail::to("loto@eatap.co.jp")
            ->send(new SendLotoMail(intval($user_id), $loto->amount_of_money, $loto->kind_of_prize));
            $userDeviceTokens = Device::where('user_id', intval($user_id))->get();
            foreach ($userDeviceTokens as $key => $userDeviceToken) {
                $endPointArn = array("EndpointArn" => $userDeviceToken->arn);
                try {
                  $json = array(
                    'MessageStructure' => 'json',
                    'TargetArn' => $userDeviceToken->arn,
                    'Message' => json_encode(array(
                      "default" => $notice->body,
                      "APNS" => json_encode(array(
                        "aps" => array(
                          "alert" => array(
                            "title" => $notice->title,
                            "body" => $notice->body
                          ),
                          "sound" => "default",
                          "badge" => "default",
                          "category" => null
                        )
                        )),
                        "APNS_SANDBOX" => json_encode(array(
                            "aps" => array(
                              "alert" => array(
                                "title" => $notice->title,
                                "body" => $notice->body
                              ),
                              "sound" => "default",
                              "badge" => "default",
                              "category" => null
                            )
                          ))
                    ))
                  );
                  $sns = App::make('aws')->createClient('sns');
                  $sns->publish($json);
                  
                } catch (SnsException $e) {
                    // Log::info($e->getMessage());
                    return $e;
                }
            }
        }
        $loto->save();

        return response()->json(
            $loto,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }
}