<?php

namespace App\Http\Controllers;

use App\Models\FoodOver\FoodOver;
use App\Models\Kitchen\Kitchen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodOverController extends Controller
{
    //
    public function __construct()
    {
        // do something
    }

    public function index($kitchen_id)
    {
        $user_kitchen = Auth::user()->kitchen;
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
        if (!in_array($kitchen_id, $kitchen_id_arr)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        $data = array();
        $data['food'] = FoodOver::with(['kitchen', 'food'])->where('kitchen_id', $kitchen_id)->get();
        $data['kitchen_id'] = $kitchen_id;
        $data['kitchen'] = Kitchen::find($kitchen_id);
        return view('chef.food_over.index', compact('data'));
    }
}
