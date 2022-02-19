<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use App\Time;
use App\Coupon;
use App\Favorite;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index(Request $request) {
        
        $now = Carbon::now();
        $hour = $now->hour;
        $shop_ids = Shop::select('id')->get();
        $shops = [];
        $category = intval($request->category);
        if ($request->time != null) {
            $hour = intval($request->time);
        }
        $user_id = 0;

        if ($request->user_id != null) {
            $user_id = intval($request->user_id);
        }

        foreach ($shop_ids as $key => $shop_id) {
            $shop;
            $id = $shop_id['id'];
            if ($category == 0) {
                $shop = DB::table('shops')
                ->where('shops.id', '=', $shop_id['id'])
                ->leftJoin('coupons', function($join) use ($hour) {
                    $join->on('shops.id', '=', 'coupons.shop_id')
                    ->where(function($query) use ($hour)
                    {
                        $query->where('coupons.time_id', '=', $hour)
                        ->orWhere('coupons.time_id', '=', $hour + 24);
                    })
                    ->where('coupons.display', '=', 1);
                })
                ->leftJoin('times', function($join) use ($id)  {
                    $join->on('coupons.time_type', '=', 'times.time_type');
                    $join->where('times.shop_id', '=', $id);
                })
                ->leftJoin('favorites', function($join) use ($user_id)  {
                    $join->on('shops.id', '=', 'favorites.shop_id');
                    $join->where('favorites.user_id', '=', $user_id);
                })
                ->select(
                    'shops.id as id',
                    'shops.name as name',
                    'shops.address as address',
                    'shops.zip_code as zip_code',
                    'shops.top_image as top_image',
                    'shops.opened as opened',
                    'shops.category_1 as category_1',
                    'shops.category_2 as category_2',
                    'shops.latitude as latitude',
                    'shops.longitude as longitude',
                    'shops.lunch_estimated_bottom_price as lunch_estimated_bottom_price',
                    'shops.lunch_estimated_high_price as lunch_estimated_high_price',
                    'shops.dinner_estimated_bottom_price as dinner_estimated_bottom_price',
                    'shops.dinner_estimated_high_price as dinner_estimated_high_price',
                    'coupons.id as coupon_id',
                    'coupons.time_id as time_id',
                    'coupons.discount as discount',
                    'coupons.display as display',
                    'coupons.first_time_discount as first_time_discount',
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
                    'times.sunday as sunday',
                    'favorites.id as favorite_id'
                    )
                ->get();
            } else {
                $shop = DB::table('shops')
                ->where('shops.id', '=', $shop_id['id'])
                ->where(function($query) use ($category)
                {
                    $query->where('category_1', '=', $category)
                          ->orWhere('category_2', '=', $category);
                })
                ->leftJoin('coupons', function($join) use ($hour) {
                    $join->on('shops.id', '=', 'coupons.shop_id')
                    ->where(function($query) use ($hour)
                    {
                        $query->where('coupons.time_id', '=', $hour)
                        ->orWhere('coupons.time_id', '=', $hour + 24);
                    })
                    ->where('coupons.display', '=', 1);
                })
                ->leftJoin('times', function($join) use ($id)  {
                    $join->on('coupons.time_type', '=', 'times.time_type');
                    $join->where('times.shop_id', '=', $id);
                })
                ->leftJoin('favorites', function($join) use ($user_id)  {
                    $join->on('shops.id', '=', 'favorites.shop_id');
                    $join->where('favorites.user_id', '=', $user_id);
                })
                ->select(
                    'shops.id as id',
                    'shops.name as name',
                    'shops.address as address',
                    'shops.zip_code as zip_code',
                    'shops.top_image as top_image',
                    'shops.opened as opened',
                    'shops.category_1 as category_1',
                    'shops.category_2 as category_2',
                    'shops.latitude as latitude',
                    'shops.longitude as longitude',
                    'shops.lunch_estimated_bottom_price as lunch_estimated_bottom_price',
                    'shops.lunch_estimated_high_price as lunch_estimated_high_price',
                    'shops.dinner_estimated_bottom_price as dinner_estimated_bottom_price',
                    'shops.dinner_estimated_high_price as dinner_estimated_high_price',
                    'coupons.id as coupon_id',
                    'coupons.time_id as time_id',
                    'coupons.discount as discount',
                    'coupons.display as display',
                    'coupons.first_time_discount as first_time_discount',
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
                    'times.sunday as sunday',
                    'favorites.id as favorite_id'
                    )
                ->get();
            }
            $max_discount_element = 4;
            if (count($shop) >= 2) {
                foreach ($shop as $key => $row) {
                    $row->closed = $row->opened;
                    if ($row->discount_type == 1) {
                        if (15 <= $row->discount) {
                            $row->priority = 1;
                        } elseif(10 <= $row->discount){
                            $row->priority = 2;
                        } elseif(1 <= $row->discount){
                            $row->priority = 3;
                        } else {
                            $row->priority = 4;
                        }
                    } else {
                        if (500 <= $row->discount) {
                            $row->priority = 1;
                        } elseif(50 <= $row->discount){
                            $row->priority = 2;
                        } elseif(10 <= $row->discount){
                            $row->priority = 3;
                        } else {
                            $row->priority = 4;
                        }
                    }

                    if ($now->isSunday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->monday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->sunday) {
                                $row->discount = $row->discount;
                            } elseif ($row->saturday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->discount = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if ($now->isMonday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->tsuesday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->monday) {
                                $row->discount = $row->discount;
                            } elseif ($row->sunday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if ($now->isTuesday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->wednesday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->tsuesday) {
                                $row->discount = $row->discount;
                            } elseif ($row->monday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if($now->isWednesday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->thursday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->wednesday) {
                                $row->discount = $row->discount;
                            } elseif ($row->tsuesday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if($now->isThursday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->friday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->thursday) {
                                $row->discount = $row->discount;
                            } elseif ($row->wednesday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if($now->isFriday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->saturday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->friday) {
                                $row->discount = $row->discount;
                            } elseif ($row->thursday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if($now->isSaturday()) {
                        if ($row->time_id < $now->hour) {
                            if (!$row->sunday) {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        } else {
                            if ($row->saturday) {
                                $row->discount = $row->discount;
                            } elseif ($row->friday) {
                                if ($row->time_id < 24){
                                    $row->priority = 4;
                                    $row->coupon_id = null;
                                }
                            } else {
                                $row->priority = 4;
                                $row->coupon_id = null;
                            }
                        }
                    }

                    if ($row->opened == 0) {
                        $row->priority = 4;
                    }

                    if ($row->priority <= $max_discount_element) {
                        $shop = $row;
                        $max_discount_element = $row->priority;
                    }
                }
                unset($shop->sunday);
                unset($shop->monday);
                unset($shop->tsuesday);
                unset($shop->wednesday);
                unset($shop->thursday);
                unset($shop->friday);
                unset($shop->saturday);
                unset($shop->start_time);
                unset($shop->end_time);
                unset($shop->time_type);
                unset($shop->t_type);
                $shops[] = $shop;
            } else {
                foreach ($shop as $key => $value) {

                    if ($value->discount_type == 1) {
                        if (15 <= $value->discount) {
                            $value->priority = 1;
                        } elseif(10 <= $value->discount){
                            $value->priority = 2;
                        } elseif(1 <= $value->discount){
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

                    if($now->isSunday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->monday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->sunday) {
                                $value->discount = $value->discount;
                            } elseif ($value->saturday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    } 

                    if ($now->isMonday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->tsuesday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->monday) {
                                $value->discount = $value->discount;
                            } elseif ($value->sunday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }

                    if ($now->isTuesday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->wednesday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->tsuesday) {
                                $value->discount = $value->discount;
                            } elseif ($value->monday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }

                    if($now->isWednesday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->thursday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->wednesday) {
                                $value->discount = $value->discount;
                            } elseif ($value->tsuesday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }

                    if($now->isThursday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->friday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->thursday) {
                                $value->discount = $value->discount;
                            } elseif ($value->wednesday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }

                    if($now->isFriday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->saturday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->friday) {
                                $value->discount = $value->discount;
                            } elseif ($value->thursday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }

                    if($now->isSaturday()) {
                        if ($value->time_id < $now->hour) {
                            if (!$value->sunday) {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        } else {
                            if ($value->saturday) {
                                $value->discount = $value->discount;
                            } elseif ($value->friday) {
                                if ($value->time_id < 24){
                                    $value->priority = 4;
                                    $value->coupon_id = null;
                                }
                            } else {
                                $value->priority = 4;
                                $value->coupon_id = null;
                            }
                        }
                    }
                    $value->closed = $value->opened;

                    if ($value->opened == 0) {
                        $value->priority = 4;
                    }

                    unset($value->sunday);
                    unset($value->monday);
                    unset($value->tsuesday);
                    unset($value->wednesday);
                    unset($value->thursday);
                    unset($value->friday);
                    unset($value->saturday);
                    unset($value->start_time);
                    unset($value->end_time);
                    unset($value->time_type);
                    unset($value->t_type);
                    $shops[] = $value;
                }
            }
        }
		return response()->json(
            $shops,
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }
}
