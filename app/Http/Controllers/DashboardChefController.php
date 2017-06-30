<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\DishDetail\DishDetail;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardChefController extends Controller
{
    //
    public function __construct()
    {
        // do something
    }

    public function index()
    {
        $day = Carbon::now()->format('Y-m-d');
        $user_kitchen = Auth::user()->kitchen;
        $list_kitchen = User::with(['kitchen.daily_meal' => function ($query) use ($day) {
            $query->where('day', $day);
            $query->with('daily_dish.detail_dish');
        }])->find(Auth::user()->id);
//        dd($list_kitchen);
        $data = array();
        $data['date'] = Carbon::now();
        return view('chef.dashboard', compact('data'));
    }

    public function meal()
    {
        $day = Carbon::now()->format('Y-m-d');
        $user_kitchen = Auth::user()->kitchen;
        $list_kitchen = User::with(['kitchen.daily_meal' => function ($query) use ($day) {
            $query->where('day', $day);
            $query->with('daily_dish.detail_dish.food');
        }])->find(Auth::user()->id);
        if (is_null($list_kitchen->kitchen)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }


        $data = array();
        $data['date'] = Carbon::now();
        $data['kitchen'] = array();
        $data['count_meal'] = 0;
        foreach ($list_kitchen->kitchen as $kitchen) {
            if (count($kitchen->daily_meal) > 0) {
                foreach ($kitchen->daily_meal as $meal) {
                    $data['count_meal'] += 1;
                }
                $data['kitchen'][] = $kitchen;
            }
        }
//        foreach ($list_kitchen->kitchen as $kitchen) {
//            $item_kitchen = array();
//            $item_kitchen['id'] = $kitchen->id;
//            $item_kitchen['name'] = $kitchen->name;
//            $item_kitchen['money'] = $kitchen->money;
//            $item_kitchen['avatar'] = $kitchen->avatar;
//            $item_kitchen['address'] = $kitchen->address;
//            $item_kitchen['note'] = $kitchen->note;
//            if (count($kitchen->daily_meal) > 0) {
//                foreach ($kitchen->daily_meal as $daily) {
//                    $item_daily = array();
//                    $item_daily['id'] = $daily->id;
//                    $item_daily['day'] = $daily->day;
//                    $item_daily['number_of_meals'] = $daily->number_of_meals;
//                    $item_daily['money_meals'] = $daily->money_meals;
//                    $item_daily['total_meal_chef'] = $daily->total_meal_chef;
//                    $item_daily['status'] = $daily->status;
//                    $item_daily['is_permission'] = $daily->is_permission;
//                    if(count($daily->daily_dish) > 0){
//                        foreach ($daily->daily_dish as $dish) {
//                            $item_dish = array();
//                            $item_dish['id'] = $dish->id;
//                            $item_dish['name'] = $dish->name;
//                            $item_dish['cooking_note'] = $dish->cooking_note;
//                            $item_dish['note'] = $dish->note;
//                            if(count($dish->detail_dish) > 0){
//                                foreach ($dish->detail_dish as $detail) {
//                                    $item_detail_dish = array();
//                                    $item_detail_dish['id'] = $detail->id;
//                                    $item_detail_dish['food_id'] = $detail->food_id;
//                                    $item_detail_dish['name'] = $detail->name;
//                                    $item_detail_dish['number'] = $detail->number;
//                                    $item_detail_dish['unit'] = $detail->unit;
//                                    $item_detail_dish['money'] = $detail->money;
//                                    $item_dish['detail_dish'][] = $item_detail_dish;
//                                }
//                            }
//                            $item_daily['daily_dish'][] = $item_dish;
//                        }
//                    }
//                    $item_kitchen['daily_meal'][] = $item_daily;
//                }
//                $data['kitchen'][] = $item_kitchen;
//            }
//        }
        return view('chef.dashboard', compact('data'));
    }

    public function food()
    {
        $user_kitchen = Auth::user()->kitchen;
        $day = Carbon::now()->format('Y-m-d');
        if (is_null($user_kitchen)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        $kitchen_id_arr = array();
        foreach ($user_kitchen as $item_kitchen) {
            $kitchen_id_arr[] = $item_kitchen->id;
        }

        $list_food = DishDetail::whereHas('daily_dish', function ($query) use ($kitchen_id_arr, $day) {
            $query->whereHas('daily_meal', function ($query) use ($kitchen_id_arr, $day) {
                $query->where('day', $day)->whereIn('id_kitchen', $kitchen_id_arr);
            });
        })->with([
            'food',
            'daily_dish.daily_meal.kitchen'
        ])->get();

        //Group food by id
        $all_food_id = array();
        foreach ($list_food as $food){
            $all_food_id[$food->id_food][] = $food;
        }

        //Get all data food
        $group_food = array();
        foreach ($all_food_id as $id_food => $foods){
            $item = array();
            foreach ($foods as $key_food => $food){
                $item['name'] = $food->food->name;
                $item['description'] = $food->food->description;
                $item['image'] = CommonHelper::getPublicImagePath($food->food->image);
                $item['unit'] = $food->unit;
                $item['number'][] = $food->number;
            }
            $item['total_number'] = array_sum($item['number']);
            $item['info'] = $foods;
            $group_food[$id_food] = $item;
        }
        dd($group_food);
        return view('chef.dashboard', compact('data'));
    }
}
