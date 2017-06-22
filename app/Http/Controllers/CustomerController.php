<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Str;
use App\Food;
use App\Models\DailyMeal\DailyMeal;
use DB;

class CustomerController extends Controller
{
    public function index()
    {
        $day = Carbon::now()->format('Y-m-d');
        $info_meal = DailyMeal::with(['daily_dish', 'daily_dish.detail_dish'])->where('day', $day)->first();

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
        return view('customer.orderhistory');
    }

    public function transaction()
    {
        return view('customer.transaction');
    }

}