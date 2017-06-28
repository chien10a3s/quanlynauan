<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $query->with('daily_dish.detail_dish');
        }])->find(Auth::user()->id);
        if(is_null($list_kitchen->kitchen)){
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        dd($list_kitchen->kitchen);
        $data = array();
        $data['date'] = Carbon::now();
        $data['kitchen'] = $list_kitchen->kitchen;
        $data['kitchen'] = array();
        foreach ($list_kitchen->kitchen as $kitchen){
            $item = array();
            $item['name'] = $kitchen->name;
            $item['money'] = $kitchen->money;
            $item['address'] = $kitchen->address;
            $item['avatar'] = $kitchen->avatar;
        }

        return view('chef.dashboard', compact('data'));
    }

    public function food()
    {

    }
}
