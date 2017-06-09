<?php

namespace App\Http\Controllers;

use App\Models\DailyMeal\DailyMeal;
use App\Models\UserKitchen\UserKitchen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChefController extends Controller
{
    //
    public function __construct()
    {
        //Something
    }


    /**
     * Get list kitchen of chef with id login
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $user_login = Auth::user()->id;

        $list_kitchen = User::with([
            'kitchen' => function($query) use ($user_login){
                $query->where('status', 1)->where('role', 3);
                $query->with(['daily_meal']);
            }])->find($user_login);
//        if(empty($list_kitchen)){
//            return redirect()->back()->withErrors('Không tồn tại bếp');
//        }
        $data = array();
        $data['user'] = Auth::user();
        $data['kitchen'] = array();
        foreach ($list_kitchen->kitchen as $index => $kitchen){
            $data_item = array();
            $data_item['index'] = $index+1;
            $data_item['name'] = $kitchen->name;
            $data_item['id'] = $kitchen->id;
            $data_item['status'] = $kitchen->status;
            $data_item['money'] = $kitchen->money;
            $data_item['address'] = $kitchen->address;
            $data_item['created_by'] = $kitchen->created_by;
            $data_item['updated_by'] = $kitchen->updated_by;
            $data_item['count_meal'] = count($kitchen->daily_meal);
            $data['kitchen'][] = $data_item;
        }
        return view('chef.index', compact('data'));
    }

    public function dailyMeals($kitchen_id){
        $now = Carbon::now()->format('Y-m-d');
        $start_day = Carbon::createFromFormat('Y-m-d H:i:s', $now.' 00:00:01')->format('Y-m-d H:i:s');
        $end_day = Carbon::createFromFormat('Y-m-d H:i:s', $now.' 23:59:59')->format('Y-m-d H:i:s');
        $data = DailyMeal::with([
            'daily_dish' => function($query){
                $query->where('status', 1);
                $query->with(['detail_dish']);
            },
            'kitchen'
            ])
            ->where('id_kitchen', $kitchen_id)
            ->where('day', '>', $start_day)
            ->where('day', '<', $end_day)
            ->where('status', 1)->get();
        dd($data);
    }
}
