<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\DishDetail\DishDetail;
use App\Supplier;
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

    /**
     * Get list meal current date in dashboard
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
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
        return view('chef.dashboard', compact('data'));
    }

    /**
     * Get list food current date in dashboard
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function food(Request $request)
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
        });

        //Filter by supplier
        if (isset($request->id_supplier)) {
            $id_supplier = $request->id_supplier;
            $list_food->whereHas('food', function ($query) use ($id_supplier) {
                $query->where('id_supplier', $id_supplier);
            });
        }
        $list_food = $list_food->with([
            'food.supplier',
            'daily_dish.daily_meal.kitchen'
        ])->get();

        //Group food by id
        $all_food_id = array();
        foreach ($list_food as $food) {
            $all_food_id[$food->id_food][] = $food;
        }

        //Get all data food
        $group_food = array();
        foreach ($all_food_id as $id_food => $foods) {
            $item = array();
            foreach ($foods as $key_food => $food) {
                $item['name'] = $food->food->name;
                $item['description'] = $food->food->description;
                $item['number'][] = $food->number;
                $item['image'] = CommonHelper::getPublicImagePath($food->food->image);
                $item['id_supplier'] = $food->food->id_supplier;
                $item['supplier_name'] = @$food->food->supplier->name;
                $item['id_category'] = $food->food->id_category;
                $item['unit'] = $food->food->unit;
                $item['price'] = $food->food->price;
                $item['kitchen'][$key_food] = (isset($food->daily_dish->daily_meal->kitchen) && count($food->daily_dish->daily_meal->kitchen) > 0) ? $food->daily_dish->daily_meal->kitchen : [];
            }
            $item['total_number'] = array_sum($item['number']);
            $item['info'] = $foods;
            $group_food[$id_food] = $item;
        }
        $data = array();
        $data['food'] = $group_food;
        $data['supplier'] = Supplier::where('status', 1)->pluck('name', 'id');
        return view('chef.dashboard_food', compact('data'));
    }
}
