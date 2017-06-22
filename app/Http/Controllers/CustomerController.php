<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Str;
use App\Food;
use App\Models\DailyMeal\DailyMeal;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;

class CustomerController extends Controller
{
    public function index()
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $id_kitchen = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
        $day = Carbon::now()->format('Y-m-d');
        $info_meal = DailyMeal::with(['daily_dish', 'daily_dish.detail_dish'])
            ->where('day', $day)
            ->where('id_kitchen', $id_kitchen)
            ->first();
//        dd($day);

        /*
         * all food
         */
        $all_food = Food::with('supplier')->where('status', 1)->get();
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $option[$item_food->id]['name'] = $item_food->name;
                $option[$item_food->id]['price'] = $item_food->price;
                $option[$item_food->id]['unit'] = $item_food->unit;
            }
        }

        return view('customer.index', compact('info_meal','option'));
    }

    public function food()
    {
        return view('customer.food');
    }

    public function orderHistory()
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $id_kitchen = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
        $all_meal = User::with(['kitchen' => function ($query) use ($id_kitchen) {
            return $query->where('id_kitchen', $id_kitchen);
        }, 'kitchen.daily_meal' => function ($query) use ($id_kitchen) {
            return $query->orderBy('day', 'desc');
        }])
            ->where('id', Auth::user()->id)
            ->take(10)
            ->get();
        return view('customer.orderhistory',compact('all_meal'));
    }

    public function transaction()
    {
        return view('customer.transaction');
    }

}