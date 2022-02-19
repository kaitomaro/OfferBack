<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\Service;
use App\Coupon;
use App\Time;
use App\Http\Requests\CouponTimeRequset;
use App\Http\Requests\SpecialCouponRequset;
use App\Http\Requests\CouponRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index() {
        $shop = Shop::find(Auth::guard('shop')->id());
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
                $coupons_first[$i] = $service;
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
                $coupons_second[$i] = $service;
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
                $menu = DB::table('services')
                ->where('coupons.time_type', '=', 3)
                ->join('coupons', 'services.id', '=', 'coupons.service_id')
                ->where('services.shop_id', $shop->id)->where('coupons.time_id', $i)
                ->get();
                $coupons_third[$i] = $menu;
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
                $coupons_fourth[$i] = $service;
            }
        }
    	return view('store/coupons/index', [
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
        ]);

    }
    public function show(Request $request, $time_type, $time_id) {
        $shop = Shop::find(Auth::guard('shop')->id());
        $shop_id = $shop->id;
        $services = DB::table('services')
        ->where('services.shop_id', '=', $shop_id)
        ->leftJoin('coupons', function($join) use ($time_id, $time_type, $shop_id){
            $join->on('services.id', '=', 'coupons.service_id')
            ->where('coupons.time_id', '=', $time_id)
            ->where('coupons.time_type', '=', $time_type)
            ->where('coupons.shop_id', '=', $shop_id);
        })
        ->select(
            'services.id as service_id',
            'services.price as price',
            'services.name as name',
            'services.service_type as service_type',
            'services.shop_id as shop_id',
            'coupons.id as coupon_id',
            'coupons.time_id as time_id',
            'coupons.discount as discount',
            'coupons.display as display',
            'coupons.telephone_reservation as telephone_reservation',
            'coupons.first_time_discount as first_time_discount',
            'coupons.discount_type as discount_type',
            )
        ->get();

        return view('store/coupons/show', [
            'services' => $services,
            'time_id' => $time_id,
            'time_type' => $time_type,
        ]);
    }

    public function update_coupon(CouponRequest $request, $time_type, $time_id) {
        $coupons = Coupon::where('shop_id', Auth::guard('shop')->id())->where('time_id', $time_id)->where('time_type', $time_type)->delete();
        if ($request->input("display") == "on"){
            $display = 1;
        } else{
            $display = 0;
        }
        if ($request->input("menus") != null) {
            foreach ($request->input("menus") as $key => $id) {
                $coupon = new Coupon();
                $coupon->shop_id = Auth::guard('shop')->id();
                $coupon->time_id = $time_id;
                $coupon->time_type = $time_type;
                $coupon->display = $display;
                $coupon->discount = intval($request->input('discount_')[$id]);
                
                if ($request->input('telephone_reservation_'.$id) == "1") {
                    $coupon->telephone_reservation = 1;
                }else{
                    $coupon->telephone_reservation = 0;
                }
                if ($request->input('first_time_discount_'.$id) == "1") {
                    $coupon->first_time_discount = 1;
                }else{
                    $coupon->first_time_discount = 0;
                }

                if ($request->input('discount_way'.$id) == "1") {
                    $coupon->discount_type = 1;
                }else{
                    $coupon->discount_type = 0;
                }
                
                $coupon->service_id = intval($request->input("menus")[$key]);
                $coupon->save();
            }
        }
        return redirect('/store/coupons');
    }
}
