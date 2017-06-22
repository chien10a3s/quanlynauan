<?php

namespace App\Http\Controllers;

use App\Models\DailyMeal\DailyMeal;
use App\Models\Feedback\Feeback;
use App\Models\Kitchen\Kitchen;
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
    public function index()
    {
        $user_login = Auth::user()->id;

        $list_kitchen = User::with([
            'kitchen' => function ($query) use ($user_login) {
                $query->where('status', 1)->where('role', 3);
                $query->with(['daily_meal']);
            }])->find($user_login);
//        if(empty($list_kitchen)){
//            return redirect()->back()->withErrors('Không tồn tại bếp');
//        }
        $data = array();
        $data['user'] = Auth::user();
        $data['kitchen'] = array();
        foreach ($list_kitchen->kitchen as $index => $kitchen) {
            $data_item = array();
            $data_item['index'] = $index + 1;
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

    /**
     * Get list daily meal by date and kitchen_id
     * @param Request $request
     * @param $kitchen_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function dailyMeals(Request $request, $kitchen_id)
    {
        if (isset($request->day)) {
            $request_day = Carbon::createFromFormat('d/m/Y', $request->day);
            $day = Carbon::parse($request_day)->format('Y-m-d');
        } else {
            $day = Carbon::now()->format('Y-m-d');
        }
        $data = array();
        $data['kitchen'] = Kitchen::find($kitchen_id);
        $data['meals'] = DailyMeal::with([
            'daily_dish' => function ($query) {
                $query->where('status', 1);
                $query->with(['detail_dish']);
            }
        ])
            ->where('id_kitchen', $kitchen_id)
            ->where('day', '=', $day)
            ->where('status', 1)->get();
        $data['date'] = $day;
        $data['kitchen_id'] = $kitchen_id;
        return view('chef.meal', compact('data'));
    }

    public function ajaxMeals($kitchent_id, Request $request){
        if (isset($request->date)) {
            $request_date = Carbon::createFromFormat('d/m/Y', $request->date);
            $day = Carbon::parse($request_date)->format('Y-m-d');
        }
        $meals_date = DailyMeal::with([
            'daily_dish' => function ($query) {
                $query->where('status', 1);
                $query->with(['detail_dish']);
            }
        ])
            ->where('id_kitchen', $kitchent_id)
            ->where('day', '=', $day)
            ->where('status', 1)->get();
        return $meals_date;
    }

    /**
     * Update total money when go to market
     * @param Request $request
     * @param $daily_meal_id
     */
    public function updateMoneyChef(Request $request, $daily_meal_id)
    {
        if(!isset($daily_meal_id)){
            return redirect()->back()->withErrors('Không tìm thấy dữ liệu');
        }
        $total_meal_chef = str_replace(',', '', $request->total_meal_chef);
        if(DailyMeal::where('id', $daily_meal_id)->update(['total_meal_chef' => $total_meal_chef])){
            return redirect()->back()->withErrors('Cập nhật dữ liệu thành công');
        }
        return redirect()->back()->withErrors('Đã xảy ra lỗi');
    }

    /**
     * Get all feedback of chef
     * @param Request $request
     * @param $kitchen_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeedback(Request $request, $kitchen_id){
        if (isset($request->day)) {
            $request_day = Carbon::createFromFormat('d/m/Y', $request->day);
            $day = Carbon::parse($request_day)->format('Y-m-d');
        } else {
            $day = Carbon::now()->format('Y-m-d');
        }
        $data = array();
        $data['kitchen'] = Kitchen::find($kitchen_id);
        $data['feedback'] = Feeback::with(['create_user'])
            ->where('id_kitchen', $kitchen_id)
            ->where('date',  $day)->get();
        $data['date'] = $day;
        $data['kitchen_id'] = $kitchen_id;

        $data['meals'] = DailyMeal::with([
            'daily_dish' => function ($query) {
                $query->where('status', 1);
                $query->with(['detail_dish']);
            }
        ])
            ->where('id_kitchen', $kitchen_id)
            ->where('day', '=', $day)
            ->where('status', 1)->get();
        return view('chef.feedback', compact('data'));
    }

    public function spice($kitchen_id){
        $user_kitchen = Auth::user()->kitchen;
        if (is_null($user_kitchen)){
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        $kitchen_id_arr = array();
        foreach ($user_kitchen as $item_kitchen){
            $kitchen_id_arr[] = $item_kitchen->id;
        }
        if(!in_array($kitchen_id, $kitchen_id_arr)){
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        $all_spices = User::with(['kitchen' => function ($query) use ($kitchen_id) {
            return $query->where('id_kitchen', $kitchen_id);
        }, 'kitchen.food'])
            ->where('id', Auth::user()->id)
            ->get();
        return view('chef.spice',compact('all_spices'));
    }
}
