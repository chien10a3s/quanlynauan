<?php

namespace App\Http\Controllers;

use App\Food;
use App\Models\FoodOver\FoodOver;
use App\Models\Kitchen\Kitchen;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $data['food_over'] = FoodOver::with(['kitchen', 'food'])->where('kitchen_id', $kitchen_id)->get();
        $data['food'] = Food::get();
        $data['kitchen_id'] = $kitchen_id;
        $data['kitchen'] = Kitchen::find($kitchen_id);
        return view('chef.food_over.index', compact('data'));
    }

    public function update($food_over_id, Request $request)
    {
        $data_update = array();
        $data_update['food_id'] = $request->food_id;
        $data_update['quantity'] = $request->quantity;
        $data_update['unit'] = $request->unit;
        $data_update['date'] = Carbon::createFromFormat('d/m/Y H:i:s', $request->date);
        $data_update['description'] = $request->description;
        $data_update['status'] = $request->status;
        if(FoodOver::where('id', $food_over_id)->update($data_update)){
            return redirect()
                ->back()
                ->with([
                    'message' => 'Cập nhật dữ liệu thành công',
                    'alert-type' => 'success',
                ]);
        }else{
            return redirect()
                ->back()
                ->with([
                    'message' => 'Có lỗi xảy ra, vui lòng kiểm tra lại',
                    'alert-type' => 'error',
                ]);
        }
    }
}
