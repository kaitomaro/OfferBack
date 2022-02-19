<?php

namespace App\Http\Controllers\Store;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\Service;
use App\Menu;
use App\Coupon;
use App\Earning;
use App\Img;
use App\Time;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendBasicRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\ObjectUploader;
use Aws\S3\Exception\S3Exception;
use App;


class StoresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index(Request $request) {
	    $shop = Shop::find(Auth::guard('shop')->id());
        $services = Service::where('shop_id', $shop->id)->get();
        $coupons_first = [];
        $coupons_second = [];
        $coupons_third = [];
        $coupons_fourth = [];
        $first_start_time = null;
        $first_end_time = null;
        $second_start_time = null;
        $second_end_time = null;
        $third_start_time = null;
        $third_end_time = null;
        $fourth_start_time = null;
        $fourth_end_time = null;
        $menus = Menu::where('shop_id', $shop->id)->get();
        $time1 = Time::where('shop_id', $shop->id)->where('time_type', 1)->first();
        $time2 = Time::where('shop_id', $shop->id)->where('time_type', 2)->first();
        $time3 = Time::where('shop_id', $shop->id)->where('time_type', 3)->first();
        $time4 = Time::where('shop_id', $shop->id)->where('time_type', 4)->first();


        if ($time1 != null){
            $first_start_time = explode (":", $time1->start_time);
            $first_end_time = explode (":", $time1->end_time);
            if (intval($first_start_time[0]) > intval($first_end_time[0])){
                $additional_hour = intval($first_end_time[0]) + 24;
                $first_end_time[0] = strval($additional_hour);
            }
            for ($i=intval($first_start_time[0]); $i <= intval($first_end_time[0]); $i++) { 
                $service = DB::table('services')
                ->where('coupons.time_type', '=', 1)
                ->join('coupons', 'services.id', '=', 'coupons.service_id')
                ->where('services.shop_id', $shop->id)->where('coupons.time_id', $i)
                ->get();
                $coupons_first[$i] = count($service);
            }
        }
        if ($time2 != null){
            $second_start_time = explode (":", $time2->start_time);
            $second_end_time = explode (":", $time2->end_time);
            if (intval($second_start_time[0]) > intval($second_end_time[0])){
                $additional_hour = intval($second_end_time[0]) + 24;
                $second_end_time[0] = strval($additional_hour);
            }
            for ($i=intval($second_start_time[0]); $i <= intval($second_end_time[0]); $i++) { 
                $service = DB::table('services')
                ->where('coupons.time_type', '=', 2)
                ->join('coupons', 'services.id', '=', 'coupons.service_id')
                ->where('services.shop_id', $shop->id)->where('coupons.time_id', $i)
                ->get();
                $coupons_second[$i] = count($service);
            }
        }
        if ($time3 != null){
            $third_start_time = explode (":", $time3->start_time);
            $third_end_time = explode (":", $time3->end_time);
            if (intval($third_start_time[0]) > intval($third_end_time[0])){
                $additional_hour = intval($third_end_time[0]) + 24;
                $third_end_time[0] = strval($additional_hour);
            }
            for ($i=intval($third_start_time[0]); $i <= intval($third_end_time[0]); $i++) { 
                $service = DB::table('services')
                ->where('coupons.time_type', '=', 3)
                ->join('coupons', 'services.id', '=', 'coupons.service_id')
                ->where('services.shop_id', $shop->id)->where('coupons.time_id', $i)
                ->get();
                $coupons_third[$i] = count($service);
            }
        }
        if ($time4 != null){
            $fourth_start_time = explode (":", $time4->start_time);
            $fourth_end_time = explode (":", $time4->end_time);
            if (intval($fourth_start_time[0]) > intval($fourth_end_time[0])){
                $additional_hour = intval($fourth_end_time[0]) + 24;
                $fourth_end_time[0] = strval($additional_hour);
            }
            for ($i=intval($fourth_start_time[0]); $i <= intval($fourth_end_time[0]); $i++) { 
                $service = DB::table('services')
                ->where('coupons.time_type', '=', 4)
                ->join('coupons', 'services.id', '=', 'coupons.service_id')
                ->where('services.shop_id', $shop->id)->where('coupons.time_id', $i)
                ->get();
                $coupons_fourth[$i] = count($service);
            }
        }

        $special_coupon = DB::table('services')
        ->join('coupons', 'services.id', '=', 'coupons.service_id')
        ->where('coupons.shop_id', '=',$shop->id)
        ->where('coupons.time_id', 100)
        ->first();

        $images = Img::where('shop_id', $shop->id)->get();
		return view('store/index')->with([
           'shop' => $shop,
           "services" => $services,
           "images" => $images,
           "first_start_time" => $first_start_time,
           "first_end_time" => $first_end_time,
           "second_start_time" => $second_start_time,
           "second_end_time" => $second_end_time,
           "third_start_time" => $third_start_time,
           "third_end_time" => $third_end_time,
           "fourth_start_time" => $fourth_start_time,
           "fourth_end_time" => $fourth_end_time,
           "coupons_first" => $coupons_first,
           "coupons_second" => $coupons_second,
           "coupons_third" => $coupons_third,
           "coupons_fourth" => $coupons_fourth,
           "time1" => $time1,
           "time2" => $time2,
           "time3" => $time3,
           "time4" => $time4,
           "menus" => $menus,
           "special_coupon" => $special_coupon,
        ]);
    }

    public function basic(){
        $shop = Shop::find(Auth::guard('shop')->id());
        $time1 = Time::where('shop_id', $shop->id)->where('time_type', 1)->first();
        $time2 = Time::where('shop_id', $shop->id)->where('time_type', 2)->first();
        $time3 = Time::where('shop_id', $shop->id)->where('time_type', 3)->first();
        $time4 = Time::where('shop_id', $shop->id)->where('time_type', 4)->first();
        
        return view(
            'store/basics/basic', 
            [
                'shop' => $shop,
                'time1' => $time1,
                'time2' => $time2,
                'time3' => $time3,
                'time4' => $time4
            ]
        );
    }

    public function get_operation() {
        $s3 = App::make('aws')->createClient('s3');
        $file_name = 'stores_operation.pdf';
        $pdf_path = 'pdf/' . $file_name;

        $result = $s3->getObject([
            'Bucket' => 'eatapbucket',
            'Key'    => $pdf_path
        ]);

        return response($result["Body"], 200)
            ->header('Content-Type', 'application/pdf');
		// return view('files/store_operation');
    }

    public function update_basic(SendBasicRequest $request) {
        $shop = Shop::find(Auth::guard('shop')->id());
        $img_x = $request->input('top_image_x');
        $img_y = $request->input('top_image_y');
        $img_width = $request->input('top_image_width');
        $img_height = $request->input('top_image_height');
        if (file_exists($request->file('image'))) {
            if($request->file('image')->isValid()) {
                $now = date_format(Carbon::now(), 'YmdHis');
                $file = $request->file('image');
                $mime = $file->getMimeType();
                $name = $shop->id;
                $name = $now . '_top_image_' . $name;
                $image = Image::make($file);
                $image->orientate();
                $image->crop($img_width, $img_height, $img_x, $img_y);
                $image->resize(360, 360);
                $s3 = App::make('aws')->createClient('s3');

                if ($shop->top_image != null) {
                    $result = $s3->deleteObject([
                        'Bucket' => config('filesystems.disks.s3.bucket'),
                        'Key'    => $shop->top_image
                    ]);
                }

                $s3->putObject(array(
                    'Bucket'     => config('filesystems.disks.s3.bucket'),
                    'Key'        => "top_image/".$name,
                    'Body'       =>  (string) $image->encode(),
                    'ContentType' => $mime,
                    'ACL'        => 'public-read'
                ));
                $shop->top_image = "top_image/".$name;
            }
        }

        if ($request->input('first_start_time') != null && $request->input('first_end_time') != null){
            $time = Time::where('shop_id', $shop->id)->where('time_type', 1)->first();
            if ($time == null ){
                $time = new Time();
            }
            if ($request->input('sunday1') != null) {
                $time->sunday = 1;
            } else {
                $time->sunday = 0;
            }

            if ($request->input('monday1') != null) {
                $time->monday = 1;
            }else {
                $time->monday = 0;
            }

            if ($request->input('tsuesday1') != null) {
                $time->tsuesday = 1;
            } else {
                $time->tsuesday = 0;
            }

            if ($request->input('wednesday1') != null) {
                $time->wednesday = 1;
            }else {
                $time->wednesday = 0;
            }

            if ($request->input('thursday1') != null) {
                $time->thursday = 1;
            }else {
                $time->thursday = 0;
            }

            if ($request->input('friday1') != null) {
                $time->friday = 1;
            }else {
                $time->friday = 0;
            }

            if ($request->input('saturday1') != null) {
                $time->saturday = 1;
            } else {
                $time->saturday = 0;
            }

            $time->start_time = $request->input('first_start_time');
            $time->end_time = $request->input('first_end_time');
            $time->time_type = 1;
            $time->shop_id = $shop->id;
            $time->save();
            $first_time_coupons = Coupon::where('shop_id', $shop->id)->where('time_type', 1)->get();
            foreach ($first_time_coupons as $key => $coupon) {
                if ($coupon->time_id >= 24) {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id - 24 <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                } else {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                }
            }

        } else {
            $time = Time::where('shop_id', $shop->id)->where('time_type', 1)->delete();
            $coupon = Coupon::where('shop_id', $shop->id)->where('time_type', 1)->update(['display' => 0]);
        }

        if ($request->input('second_start_time') != null && $request->input('second_end_time') != null){
            $time = Time::where('shop_id', $shop->id)->where('time_type', 2)->first();
            if ($time == null ){
                $time = new Time();
            }
            if ($request->input('sunday1') != null) {
                $time->sunday = 1;
            } else {
                $time->sunday = 0;
            }

            if ($request->input('monday1') != null) {
                $time->monday = 1;
            }else {
                $time->monday = 0;
            }

            if ($request->input('tsuesday1') != null) {
                $time->tsuesday = 1;
            } else {
                $time->tsuesday = 0;
            }

            if ($request->input('wednesday1') != null) {
                $time->wednesday = 1;
            }else {
                $time->wednesday = 0;
            }

            if ($request->input('thursday1') != null) {
                $time->thursday = 1;
            }else {
                $time->thursday = 0;
            }

            if ($request->input('friday1') != null) {
                $time->friday = 1;
            }else {
                $time->friday = 0;
            }

            if ($request->input('saturday1') != null) {
                $time->saturday = 1;
            } else {
                $time->saturday = 0;
            }

            $time->start_time = $request->input('second_start_time');
            $time->end_time = $request->input('second_end_time');
            $time->time_type = 2;
            $time->shop_id = $shop->id;
            $time->save();

            $second_time_coupons = Coupon::where('shop_id', $shop->id)->where('time_type', 2)->get();
            foreach ($second_time_coupons as $key => $coupon) {
                if ($coupon->time_id >= 24) {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id - 24 <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                } else {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                }
            }
        } else {
            $time = Time::where('shop_id', $shop->id)->where('time_type', 2)->delete();
            $coupon = Coupon::where('shop_id', $shop->id)->where('time_type', 2)->update(['display' => 0]);
        }
        
        if ($request->input('third_start_time') != null && $request->input('third_end_time') != null){
            $time = Time::where('shop_id', $shop->id)->where('time_type', 3)->first();
            if ($time == null ){
                $time = new Time();
            }
            if ($request->input('sunday2') != null) {
                $time->sunday = 1;
            } else {
                $time->sunday = 0;
            }

            if ($request->input('monday2') != null) {
                $time->monday = 1;
            }else {
                $time->monday = 0;
            }

            if ($request->input('tsuesday2') != null) {
                $time->tsuesday = 1;
            } else {
                $time->tsuesday = 0;
            }

            if ($request->input('wednesday2') != null) {
                $time->wednesday = 1;
            }else {
                $time->wednesday = 0;
            }

            if ($request->input('thursday2') != null) {
                $time->thursday = 1;
            }else {
                $time->thursday = 0;
            }

            if ($request->input('friday2') != null) {
                $time->friday = 1;
            }else {
                $time->friday = 0;
            }

            if ($request->input('saturday2') != null) {
                $time->saturday = 1;
            } else {
                $time->saturday = 0;
            }

            $time->start_time = $request->input('third_start_time');
            $time->end_time = $request->input('third_end_time');
            $time->time_type = 3;
            $time->shop_id = $shop->id;
            $time->save();
            $third_time_coupons = Coupon::where('shop_id', $shop->id)->where('time_type', 3)->get();
            foreach ($third_time_coupons as $key => $coupon) {
                if ($coupon->time_id >= 24) {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id - 24 <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                } else {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                }
            }
        } else {
            $time = Time::where('shop_id', $shop->id)->where('time_type', 3)->delete();
            $coupon = Coupon::where('shop_id', $shop->id)->where('time_type', 3)->update(['display' => 0]);
        }

        if ($request->input('fourth_start_time') != null && $request->input('fourth_end_time') != null){
            $time = Time::where('shop_id', $shop->id)->where('time_type', 4)->first();
            if ($time == null ){
                $time = new Time();
            }
            if ($request->input('sunday2') != null) {
                $time->sunday = 1;
            } else {
                $time->sunday = 0;
            }

            if ($request->input('monday2') != null) {
                $time->monday = 1;
            }else {
                $time->monday = 0;
            }

            if ($request->input('tsuesday2') != null) {
                $time->tsuesday = 1;
            } else {
                $time->tsuesday = 0;
            }

            if ($request->input('wednesday2') != null) {
                $time->wednesday = 1;
            }else {
                $time->wednesday = 0;
            }

            if ($request->input('thursday2') != null) {
                $time->thursday = 1;
            }else {
                $time->thursday = 0;
            }

            if ($request->input('friday2') != null) {
                $time->friday = 1;
            }else {
                $time->friday = 0;
            }

            if ($request->input('saturday2') != null) {
                $time->saturday = 1;
            } else {
                $time->saturday = 0;
            }

            $time->start_time = $request->input('fourth_start_time');
            $time->end_time = $request->input('fourth_end_time');
            $time->time_type = 4;
            $time->shop_id = $shop->id;
            $time->save();
            $fourth_time_coupons = Coupon::where('shop_id', $shop->id)->where('time_type', 4)->get();
            foreach ($fourth_time_coupons as $key => $coupon) {
                if ($coupon->time_id >= 24) {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id - 24 <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                } else {
                    if ($time->start_time <= $coupon->time_id && $coupon->time_id <= $time->end_time) {
                        continue;
                    }
                    $coupon->display = 0;
                    $coupon->save();
                }
            }
        } else {
            $time = Time::where('shop_id', $shop->id)->where('time_type', 4)->delete();
            $coupon = Coupon::where('shop_id', $shop->id)->where('time_type', 4)->update(['display' => 0]);
        }

        if (
            $request->input('sunday2') == null &&
            $request->input('monday2') == null &&
            $request->input('tsuesday2') == null &&
            $request->input('wednesday2') == null &&
            $request->input('thursday2') == null &&
            $request->input('friday2') == null &&
            $request->input('saturday2') == null
        ) {
            $time3 = Time::where('shop_id', $shop->id)->where('time_type', 3)->first();
            if ($time3 != null) {
                $time3->delete();
            }
            $time4 = Time::where('shop_id', $shop->id)->where('time_type', 4)->first();
            if ($time4 != null) {
                $time4->delete();
            }
        }

        $shop->sns = $request->input('sns');
        $shop->hp = $request->input('hp');
        $shop->lunch_estimated_bottom_price = $request->input('lunch_estimated_bottom_price');
        $shop->lunch_estimated_high_price = $request->input('lunch_estimated_high_price');
        $shop->dinner_estimated_high_price = $request->input('dinner_estimated_high_price');
        $shop->dinner_estimated_bottom_price = $request->input('dinner_estimated_bottom_price');
        $shop->holiday = $request->input('holiday');
        $shop->twitter = $request->input('twitter');
        $shop->facebook = $request->input('facebook');
        $shop->instagram = $request->input('instagram');
        
        if ($request->input('number_of_seats') == null) {
            $shop->number_of_seats = 0;
        } else {
            $shop->number_of_seats = $request->input('number_of_seats');
        }
        $shop->payment_options = $request->input('payment_options');
        $shop->sentence = $request->input('sentence');
        if ($request->input('category_1') != null) {
            $shop->category_1 = intval($request->input('category_1'));
        } else{
            $shop->category_1 = null;
        }
        if ($request->input('category_2') != null) {
            $shop->category_2 = intval($request->input('category_2'));
        }else{
            $shop->category_2 = null;
        }
        
        
        if ($request->input('opened') != null) {
            $shop->opened = 1;
        }else{
            $shop->opened = 0;
        }
        $shop->save();
        return redirect('/store');
    }

    public function fee(Request $request) {
        $shop = Shop::find(Auth::guard('shop')->id());
        $start = "=2021-07-01";
        $date = Carbon::now();
        $end = $date->format('Y-m-d');

        $earning = Earning::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m") as yearmonth'), DB::raw('count(*) as count'), DB::raw('sum(people) as people_sum'),DB::raw('sum(people) * 30 as earning'))
        ->groupby('yearmonth')
        ->where('shop_id', $shop->id)
        ->get();
        
        return view(
            'store/bills/index', 
            [
                'shop' =>$shop,
                'earning' =>$earning,
            ]
        );
    }

    public function fee_datail (Request $request, $month_id) {

        $shop = Shop::find(Auth::guard('shop')->id());
        $year_month = explode("-", $month_id);

        $earnings = Earning::whereYear('created_at', intval($year_month[0]))
        ->whereMonth('created_at', intval($year_month[1]))
        ->orderBy('created_at')
        ->where('shop_id', $shop->id)
        ->get();

        $year_and_month = $year_month[0]."年".$year_month[1]."月";

        return view(
            'store/bills/detail', 
            [
                'shop' =>$shop,
                'earnings' =>$earnings,
                'year_and_month' => $year_and_month
            ]
        );
    }

    public function articles(Request $request) {
        $shop = Shop::find(Auth::guard('shop')->id());

        return view(
            'store/articles/index', 
            [
                'shop' =>$shop
            ]
        );
    }


}
