<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use App\Menu;
use App\Http\Requests\MenuRequest;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:shop');
    }

    public function index() {
        $shop = Shop::find(Auth::guard('shop')->id());
        $drink_menus = Menu::where('shop_id', $shop->id)->where('menu_type', 1)->get();
        $food_menus = Menu::where('shop_id', $shop->id)->where('menu_type', 2)->get();
        $course_menus = Menu::where('shop_id', $shop->id)->where('menu_type', 3)->get();
        $lunch_menus = Menu::where('shop_id', $shop->id)->where('menu_type', 4)->get();

        return view('store/menus/index')->with([
            "drink_menus" => $drink_menus,
            "food_menus" => $food_menus,
            "course_menus" => $course_menus,
            "lunch_menus" => $lunch_menus
         ]);
    }

    public function create(MenuRequest $request) {
        $shop = Shop::find(Auth::guard('shop')->id());
        
        if ($request->input('add_drink_button') != null) {
            if ($request->input('drink_name') == null || $request->input('drink_price') == null) {
                return redirect('/store/menus');
            }
            $menu = new Menu();
            $menu->name = $request->input('drink_name');
            $menu->price = intval($request->input('drink_price'));
            $menu->menu_type = 1;
            $menu->shop_id = $shop->id;
            $menu->save();
        } elseif ($request->input('add_food_button') != null){
            if ($request->input('food_name') == null || $request->input('food_price') == null) {
                return redirect('/store/menus');
            }
            $menu = new Menu();
            $menu->name = $request->input('food_name');
            $menu->price = intval($request->input('food_price'));
            $menu->menu_type = 2;
            $menu->shop_id = $shop->id;
            $menu->save();
        } elseif ($request->input('add_lunch_button') != null){
            if ($request->input('lunch_name') == null || $request->input('lunch_price') == null) {
                return redirect('/store/menus');
            }
            $menu = new Menu();
            $menu->name = $request->input('lunch_name');
            $menu->price = intval($request->input('lunch_price'));
            $menu->menu_type = 4;
            $menu->shop_id = $shop->id;
            $menu->save();
        }
        elseif($request->input('add_course_button') != null){
            if ($request->input('course_name') == null || $request->input('course_price') == null) {
                return redirect('/store/menus');
            }
            $menu = new Menu();
            if ($request->input('course_detail') != null) {
                $menu->detail = $request->input('course_detail');
            }
            $menu->name = $request->input('course_name');
            $menu->price = intval($request->input('course_price'));
            $menu->menu_type = 3;
            $menu->shop_id = $shop->id;
            $menu->save();
        }
        elseif($request->input('update_food_menu') != null){
            $menu = Menu::find(intval($request->input('id')));
            $menu->name = $request->input('name')[$request->input('id')];
            $menu->price = $request->input('price')[$request->input('id')];
            $menu->save();
        } elseif($request->input('update_drink_menu') != null){
            $menu = Menu::find(intval($request->input('id')));
            $menu->name = $request->input('name')[$request->input('id')];
            $menu->price = $request->input('price')[$request->input('id')];
            $menu->save();
        } elseif($request->input('update_lunch_menu') != null){
            $menu = Menu::find(intval($request->input('id')));
            $menu->name = $request->input('name')[$request->input('id')];
            $menu->price = $request->input('price')[$request->input('id')];
            $menu->save();
        } 
         elseif($request->input('update_course_menu') != null){
            $menu = Menu::find(intval($request->input('id')));
            if ($request->input('detail') != null) {
                $menu->detail = $request->input('detail')[$request->input('id')];
            }
            $menu->name = $request->input('name')[$request->input('id')];
            $menu->price = $request->input('price')[$request->input('id')];
            $menu->save();
        } elseif($request->input('delete_menu') != null){
            $menu = Menu::find(intval($request->input('delete_menu')));
            $menu->delete();
        }
        
        return redirect('/store/menus');
    }
}
