<?php

namespace App\Http\Controllers\Admin;

use App\Shop;
use App\Menu;
use App\Service;
use App\Coupon;
use App\Img;
use App\Time;
use App\Device;
use App\Loto;
use App\Notice;
use App\Earning;
use Carbon\Carbon;
use App\EmailChange;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Aws\Sns\Exception\SnsException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Mail\ChangeEmailMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
	public function __construct(){
      $this->middleware('auth:admin');
	}

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
	public function index(){
    $shops = Shop::all();
		return view('admin.home',['shops'=> $shops]);
	}

	public function show(Request $request, $shop_id){
    $shop = Shop::find(intval($shop_id));
    $menus = Menu::where('shop_id', $shop_id)->get();
    $services = Service::where('shop_id', $shop_id)->get();
    $coupons = Coupon::where('shop_id', $shop_id)->get();
    $images =  Img::where('shop_id', $shop_id)->get();
    $times =  Time::where('shop_id', $shop_id)->get();
    return view(
      'admin.show',
      [
        'shop'=> $shop,
        'menus'=> $menus,
        'services'=> $services,
        'coupons'=> $coupons,
        'images'=> $images,
        'times'=> $times,
      ]
    );
	}

  public function notify() {
    $lotos = DB::table('lotos')
    ->where('lotos.kind_of_prize', "!=", 0)
    ->where('lotos.sent', "=", 0)
    ->get();
        
    return view(
      'admin.notify', 
      [
          'lotos' => $lotos
      ]
    );
  }


  public function show_prize_notify(Request $request, $loto_id) {
    $loto = DB::table('lotos')
    ->where('lotos.id', "=", intval($loto_id))
    ->first();
        
    return view(
      'admin.notify_prize', 
      [
          'loto' => $loto
      ]
    );
  }

  public function send_prize_notify(Request $request) {
    $notice = new Notice();
    $notice->title = $request->title;
    $notice->body = $request->body;
    $notice->user_id = intval($request->user_id);
    $notice->save();
    $loto = Loto::find(intval($request->loto_id));

    $device = Device::where('user_id', intval($request->user_id))->first();
    if ($device != null) {
      $endPointArn = array("EndpointArn" => $device->arn);
      try {
        $json = array(
          'MessageStructure' => 'json',
          'TargetArn' => $device->arn,
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
    $loto->sent = 1;
    $loto->save();

    return redirect('/admin/notify');
  }
  

  public function create_notify(Request $request) {
    if ($request->leave_or_not != null) {
      $notice = new Notice();
      $notice->title = $request->title;
      $notice->body = $request->body;
      $notice->save();
    }

    try {
      $message = array(
        "default" => $request->title,
        "APNS" => json_encode(array(
          "aps" => array(
            "alert" => array(
              "title" => $request->title,
              "body" => $request->body
            ),
            "sound" => "default",
            "badge" => "default",
            "category" => null
          )
          )),
          "APNS_SANDBOX" => json_encode(array(
            "aps" => array(
              "alert" => array(
                "title" => $request->title,
                "body" => $request->body
              ),
              "sound" => "default",
              "badge" => "default",
              "category" => null
            )
          ))
      );

      $sns = App::make('aws')->createClient('sns');
      $topic = config('aws.Sns.topic');
      $sns->publish(array(
        'Message' => (string) json_encode($message),
        'MessageStructure' => 'json',
        'TopicArn' => $topic,
      ));
      

    } catch (SnsException $e) {
        // Log::info($e->getMessage());
        return $e;
    }

    return redirect('/admin/home');
  }

  public function mail(Request $request, $shop_id) {
    $shop = Shop::find(intval($shop_id));
    return view(
      'admin.mail',
      [
        'shop'=> $shop
      ]
    );
  }

  public function fee(Request $request, $shop_id) {

    $shop = Shop::find(intval($shop_id));

    $start = "=2021-07-01";
    $date = Carbon::now();
    $end = $date->format('Y-m-d');

    $earning = Earning::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as yearmonth'), DB::raw('count(*) as count'), DB::raw('sum(people) as people_sum'),DB::raw('sum(people) * 30 as earning'))
    ->groupby('yearmonth')
    ->where('shop_id', $shop->id)
    ->get();
    
    return view(
        'admin/bills/index', 
        [
            'shop' =>$shop,
            'earning' =>$earning,
        ]
    );
  }

  public function fee_datail (Request $request, $shop_id, $month_id) {

      $shop = Shop::find(intval($shop_id));
      $year_month = explode("-", $month_id);

      $earnings = Earning::whereYear('created_at', intval($year_month[0]))
      ->whereMonth('created_at', intval($year_month[1]))
      ->orderBy('created_at')
      ->where('shop_id', $shop->id)
      ->get();

      $year_and_month = $year_month[0]."年".$year_month[1]."月";

      return view(
          'admin/bills/detail', 
          [
              'shop' =>$shop,
              'earnings' =>$earnings,
              'year_and_month' => $year_and_month
          ]
      );
  }

  public function earnings(Request $request) {
    $start = "=2021-07-01";
    $date = Carbon::now();
    $end = $date->format('Y-m-d');

    $earning = Earning::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as yearmonth'), DB::raw('count(*) as count'), DB::raw('sum(people) as people_sum'),DB::raw('sum(people) * 30 as earning'))
    ->groupby('yearmonth')
    ->get();
    
    return view(
        'admin/earnings/index', 
        [
            'earning' =>$earning,
        ]
    );
  }

  public function earning_detail (Request $request, $month_id) {

    $year_month = explode("-", $month_id);

    $earnings = DB::table('earnings')
    ->whereYear('earnings.created_at', intval($year_month[0]))
    ->whereMonth('earnings.created_at', intval($year_month[1]))
    ->leftJoin('shops', function($join) {
      $join->on('shops.id', '=', 'earnings.shop_id');
    })
    ->select(
      'earnings.people as people',
      'earnings.created_at as created_at',
      'earnings.name as coupon_name',
      'shops.name as name',
    )
    ->orderBy('earnings.created_at')
    ->get();

    $year_and_month = $year_month[0]."年".$year_month[1]."月";

    return view(
        'admin/earnings/detail', 
        [
            'earnings' =>$earnings,
            'year_and_month' => $year_and_month
        ]
    );
  }

  public function change_mail(Request $request, $shop_id) {
    $shop = Shop::find(intval($shop_id));
    $shop->name = $request->name;
    // $shop->email = $request->email;
    $shop->phone = $request->phone;
    $shop->address = $request->address;
    $shop->zip_code = $request->zip_code;
    $shop->instagram = $request->instagram;
    $shop->facebook = $request->facebook;
    $shop->twitter = $request->twitter;
    $shop->sns = $request->sns;
    $shop->holiday = $request->holiday;
    $shop->lunch_estimated_bottom_price = $request->input('lunch_estimated_bottom_price');
    $shop->lunch_estimated_high_price = $request->input('lunch_estimated_high_price');
    $shop->dinner_estimated_high_price = $request->input('dinner_estimated_high_price');
    $shop->dinner_estimated_bottom_price = $request->input('dinner_estimated_bottom_price');
    $shop->latitude = $request->input('latitude');
    $shop->longitude = $request->input('longitude');

    $shop->save();
    if ($shop->email != $request->email) {
      $token = hash_hmac(
        'sha256',
        $request->email,
        env('APP_KEY')
      );
      $domain = env('APP_URL');
      $tmp_mail = new EmailChange();
      $tmp_mail->email = $request->email;
      $tmp_mail->shop_id = $shop->id;
      $tmp_mail->token = $token;
      $tmp_mail->save();
      $urls = [
        'hi' => URL::temporarySignedRoute(
            'hello.hi',
            now()->addMinutes(60*24*3),
            [
              'from' => "Eatap",
              'token' => $token
            ]
        )
      ];
      $mail = new ChangeEmailMail($request, $urls);
      Mail::to($request->email)
        ->send($mail);
    }
    
    return redirect('/admin/show/'.$shop_id);
  }
}