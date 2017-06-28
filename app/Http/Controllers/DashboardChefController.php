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
        $list_kitchen = User::with(['kitchen.daily_meal' => function($query) use ($day){
            $query->where('day', $day);
            $query->with('daily_dish.detail_dish');
        }])->find(Auth::user()->id);
        dd($list_kitchen);
        $data = array();
        $data['date'] = Carbon::now();
        return view('chef.dashboard', compact('data'));
    }
}
