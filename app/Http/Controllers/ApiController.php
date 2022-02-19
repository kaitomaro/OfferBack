<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Service;
use App\Coupon;
use App\Menu;
use Illuminate\Support\Facades\DB;
use App\Time;
use App\Img;
use App\Earning;
use App\Review;
use App\Favorite;
use Carbon\Carbon;


class ApiController extends Controller
{
    public function show(Request $request, $store_id) {
        $now = Carbon::now();
        $hour = $now->hour;

        if ($request->time != null) {
            $hour = intval($request->time);
        }
        $user_id = 0;
        if ($request->user_id != null) {
            $user_id = intval($request->user_id);
        }

        $store = DB::table('shops')
            ->where('shops.id', intval($store_id))
            ->leftJoin('favorites', function($join) use ($user_id)  {
                $join->on('shops.id', '=', 'favorites.shop_id');
                $join->where('favorites.user_id', '=', $user_id);
            })
            ->select(
                'shops.id as id',
                'shops.name as name',
                'shops.address as address',
                'shops.zip_code as zip_code',
                'shops.opened as opened',
                'shops.category_1 as category_1',
                'shops.category_2 as category_2',
                'shops.lunch_estimated_bottom_price as lunch_estimated_bottom_price',
                'shops.lunch_estimated_high_price as lunch_estimated_high_price',
                'shops.dinner_estimated_bottom_price as dinner_estimated_bottom_price',
                'shops.dinner_estimated_high_price as dinner_estimated_high_price',
                'shops.holiday as holiday',
                'favorites.id as favorite_id'
            )
            ->first();
        $store->closed = $store->opened;
        $coupons = DB::table('coupons')
            ->where('coupons.shop_id', $store_id)
            ->where('coupons.display', '=', 1)
            ->leftJoin('services', function($join) use ($store_id)  {
                $join->on('coupons.service_id', '=', 'services.id');
                $join->where('services.shop_id', '=', $store_id);
            })
            ->leftJoin('times', function($join) use ($store_id)  {
                $join->on('coupons.time_type', '=', 'times.time_type');
                $join->where('times.shop_id', '=', $store_id);
            })
            ->select(
                'services.id as id',
                'services.image_path as image_path',
                'services.price as price',
                'services.name as name',
                'services.service_type as service_type',
                'services.bill_type as bill_type',
                'coupons.id as coupon_id',
                'coupons.time_id as time_id',
                'coupons.shop_id as shop_id',
                'coupons.discount as discount',
                'coupons.display as display',
                'coupons.first_time_discount as first_time_discount',
                'coupons.telephone_reservation as telephone_reservation',
                'coupons.discount_type as discount_type',
                'coupons.time_type as time_type',
                'times.time_type as t_type',
                'times.start_time as start_time',
                'times.end_time as end_time',
                'times.monday as monday',
                'times.tsuesday as tsuesday',
                'times.wednesday as wednesday',
                'times.thursday as thursday',
                'times.friday as friday',
                'times.saturday as saturday',
                'times.sunday as sunday'
            )
            ->get();
        

        $discount = [];
        $divided_coupons = [];

        for ($i=0; $i < 24; $i++) { 
            $divided_coupon = [];
            $key = 0;
            if ($hour + $i < 24) {
                $key = $hour + $i;
            } else {
                $key = $hour + $i - 24;
            }
            $max_discount_element = 4;
            foreach ($coupons as $k => $value) {
                if ($value->time_id == $key || $value->time_id == $key + 24) {

                    if ($value->discount_type == 1) {
                        if (15 <= $value->discount) {
                            $value->priority = 1;
                        } elseif (10 <= $value->discount) {
                            $value->priority = 2;
                        } elseif (1 <= $value->discount) {
                            $value->priority = 3;
                        } else {
                            $value->priority = 4;
                        }
                    } else {
                        if ($value->discount >= 500) {
                            $value->priority = 1;
                        } elseif ($value->discount >= 50) {
                            $value->priority = 2;
                        } elseif ($value->discount >= 10) {
                            $value->priority = 3;
                        } else {
                            $value->priority = 4;
                        }
                    }

                    if ($now->isSunday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->monday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->sunday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->saturday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if ($now->isMonday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->tsuesday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->monday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->sunday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if ($now->isTuesday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->wednesday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->tsuesday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->monday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if($now->isWednesday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->thursday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->wednesday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->tsuesday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if($now->isThursday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->friday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->thursday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->wednesday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if($now->isFriday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->saturday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->friday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->thursday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if($now->isSaturday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->sunday) {
                                $value->priority = 4;
                            } else {
                                $divided_coupon[] = $value;
                            }
                        } else {
                            if ($value->saturday) {
                                $value->priority = $value->priority;
                                $divided_coupon[] = $value;
                            } elseif ($value->friday) {
                                if ($value->time_id < 24) {
                                    $value->priority = 4;
                                } else {
                                    $divided_coupon[] = $value;
                                }
                            } else {
                                $value->priority = 4;
                            }
                        }
                    }

                    if ($value->priority <= $max_discount_element) {
                        $shop = $value;
                        $max_discount_element = $value->priority;
                    }
                }
            }

            if ($store->opened == 0) {
                $devided_coupons[$i] = [];
                $discount[] = 4;
            } else {
                if ($max_discount_element == 1) {
                    $discount[] = 1;
                } elseif ($max_discount_element == 2) {
                    $discount[] = 2;
                } elseif ($max_discount_element == 3) {
                    $discount[] = 3;
                } else {
                    $discount[] = 4;
                }
                $divided_coupons[$i] = $divided_coupon;
            }
        }
        
        $imgs = Img::where('shop_id', $store_id)
        ->select(
            'id', 'shop_id', 'image_name', 'sort_num'
        )
        ->get();
        return response()->json(
            [
                'store' => $store,
                'imgs' => $imgs,
                'discount' => $discount,
                'coupons' => $divided_coupons,
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function menu (Request $request, $store_id) {
        $menus = Menu::where('shop_id', $store_id)
        ->select(
            'id', 'name', 'shop_id', 'menu_type', 'price', 'detail'
        )->get();

        return response()->json(
            $menus,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function detail (Request $request, $store_id) {
 
        $store = Shop::find($store_id,[
            'id', 
            'name', 
            'address', 
            'zip_code', 
            'phone', 
            'sentence', 
            'top_image', 
            'sns', 
            'hp', 
            'payment_options', 
            'number_of_seats',
            'opened',
            'is_vip',
            'twitter',
            'facebook',
            'instagram'
        ]);

        $store->closed = $store->opened;

        $time1 = Time::where('shop_id', $store_id)
        ->where(function($query) 
        {
            $query->where('time_type', 1)
            ->orWhere('time_type', 2);
        })
        ->select(
            'id', 'shop_id', 
            'start_time', 'end_time', 
            'monday', 'tsuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'time_type'
        )
        ->get();

        $time2 = Time::where('shop_id', $store_id)
        ->where(function($query) 
        {
            $query->where('time_type', 3)
            ->orWhere('time_type', 4);
        })
        ->select(
            'id', 'shop_id', 
            'start_time', 'end_time', 
            'monday', 'tsuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'time_type'
        )
        ->get();
        
        return response()->json(
            [
                'store' => $store,
                'time1' => $time1,
                'time2' => $time2
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );

    }

    public function use_coupon (Request $request, $store_id, $user_id) {
        $request->validate([
            'coupon_id' => 'required',
            'time' => 'required',
            'people' => 'required',
            'bill_type' => 'required',
            'name' => 'required',
            'service_id' => 'required',
            'service_type' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'discount_type' => 'required',
        ]);

        $today = Earning::where('shop_id', intval($store_id))
        ->where('user_id', intval($user_id))
        ->where('created_at', '>=', Carbon::today()->toDateString())
        ->select(
            'user_id',
            'shop_id',
            'created_at'
        )
        ->first();

        $earning = null;
        if ($today == null) {
            $earning = new Earning();
            $earning->user_id = intval($user_id);
            $earning->shop_id = intval($store_id);
            $earning->name = $request->name;
            $earning->service_id = intval($request->service_id);
            $earning->service_type = intval($request->service_type);
            $earning->price = intval($request->price);
            $earning->discount = intval($request->discount);
            $earning->discount_type = intval($request->discount_type);
            $earning->bill_type = intval($request->bill_type);
            $earning->time_type = intval($request->time);
            $earning->coupon_id = intval($request->coupon_id);
            $earning->people = intval($request->people);
            $earning->save();
        }
        
        return response()->json(
            $earning,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function create_review (Request $request, $store_id, $user_id) {
        $request->validate([
            'rate' => 'required',
            'sentence' => 'required'
        ]);

        $review = new Review();
        $review->rate = (double)$request->rate;
        $review->shop_id = $store_id;
        $review->user_id = $user_id;
        $review->sentence = $request->sentence;
        $review->save();

        return response()->json(
            $review,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function get_review (Request $request, $store_id) {
        $reviews = DB::table('reviews')
        ->where('reviews.shop_id', intval($store_id))
        ->leftJoin('users', function($join) {
            $join->on('reviews.user_id', '=', 'users.id');
        })
        ->orderBy('reviews.created_at','desc')
        ->select(
            'reviews.rate as rate',
            'reviews.sentence as sentence',
            'reviews.shop_id as shop_id',
            'reviews.user_id as user_id',
            'reviews.created_at as created_at',
            'users.name as name',
        )
        ->get();

        return response()->json(
            $reviews,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    public function update_favorite (Request $request, $store_id, $user_id) {
        $favorite = Favorite::where('shop_id',intval($store_id))
        ->where('user_id', intval($user_id))
        ->first();
        if (empty($favorite)) {
            $favorite = new Favorite();
            $favorite->user_id = intval($request->user_id);
            $favorite->shop_id = intval($request->store_id);
            $favorite->save();
        } else {
            $favorite->delete();
        }

        return response()->json(
            $favorite,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }
}
