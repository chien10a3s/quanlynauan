<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Models\DailyMeal\DailyMeal;
use App\Models\Feedback\Feeback;
use App\Models\Kitchen\Kitchen;
use App\Models\UserKitchen\UserKitchen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                $query->with(['detail_dish.food']);
            }
        ])
            ->where('id_kitchen', $kitchen_id)
            ->where('day', '=', $day)
            ->where('status', 1)->get();
        $data['date'] = $day;
        $data['kitchen_id'] = $kitchen_id;
        return view('chef.meal', compact('data'));
    }

    public function ajaxMeals($kitchent_id, Request $request)
    {
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
        if (!isset($daily_meal_id)) {
            return redirect()->back()->withErrors('Không tìm thấy dữ liệu');
        }
        $total_meal_chef = str_replace(',', '', $request->total_meal_chef);
        if (DailyMeal::where('id', $daily_meal_id)->update(['total_meal_chef' => $total_meal_chef])) {
            return redirect()->back()->withErrors('Cập nhật dữ liệu thành công');
        }
        return redirect()->back()->with([
            'message' => 'Cập nhật thành công',
            'alert-type' => 'success',
        ]);
    }

    /**
     * Get all feedback of chef
     * @param Request $request
     * @param $kitchen_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getFeedback(Request $request, $kitchen_id)
    {
        if (isset($request->day)) {
            $request_day = Carbon::createFromFormat('d/m/Y', $request->day);
            $day = Carbon::parse($request_day)->format('Y-m-d');
        } else {
            $day = Carbon::now()->format('Y-m-d');
        }
        $daily_meal_id = isset($request->daily_meal_id) ? $request->daily_meal_id : 0;
        $data = array();
        $data['kitchen'] = Kitchen::find($kitchen_id);

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
        $data['daily_meal_id'] = $daily_meal_id;
        $feedback = Feeback::with([
            'create_user',
            'child' => function ($query) use ($daily_meal_id) {
                $query->where('daily_meal_id', $daily_meal_id);
                $query->with('create_user');
            }])
//            ->where('parent_id', 0)
            ->where('daily_meal_id', $daily_meal_id)->get();
        $data['feedback'] = array();
        foreach ($feedback as $key => $fee){
            $item = array();
            $item['user'] = $fee->create_user->name;
            $item['id'] = $fee->id;
            $item['avatar'] = CommonHelper::getPublicImagePath($fee->create_user->avatar);
            $item['date'] = (isset($fee->date)) ? \Carbon\Carbon::parse($fee->date)->format('H:i d/m/Y') : null;
            $item['content'] = $fee->content;
            $item['parent_id'] = $fee->parent_id;
            $item['child'] = array();
            foreach ($fee->child as $key2 => $chil){
                $item_child = array();
                $item_child['user'] = $chil->create_user->name;
                $item_child['id'] = $chil->id;
                $item_child['avatar'] = CommonHelper::getPublicImagePath($chil->create_user->avatar);
                $item_child['date'] = (isset($chil->date)) ? \Carbon\Carbon::parse($chil->date)->format('H:i d/m/Y') : null;
                $item_child['content'] = $chil->content;
                $item_child['parent_id'] = null;
                $item['child'][$key2] = $item_child;
            }
            $data['feedback'][$key] = $item;
        }
        $data['count_feedback'] = count(Feeback::where('daily_meal_id', $daily_meal_id)->get());
        return view('chef.feedback', compact('data'));
    }

    /**
     * Save feedback ajax
     * @param Request $request
     * @return array
     */
    public function storeFeedback(Request $request)
    {
        $id_kitchen = $request->id_kitchen;
        $daily_meal_id = $request->daily_meal_id;
        $parent_id = $request->parent_id;

        //Save to db
        $data_insert = array();
        $data_insert['content'] = $request['content'];
        $data_insert['title'] = '';
        $data_insert['id_kitchen'] = $id_kitchen;
        $data_insert['daily_meal_id'] = $daily_meal_id;
        $data_insert['date'] = Carbon::now();
        $data_insert['parent_id'] = $parent_id;
        $data_insert['status'] = 1;
        $data_insert['created_by'] = Auth::user()->id;
        $data_insert['updated_by'] = Auth::user()->id;
        $data_insert['created_at'] = Carbon::now();
        $data_insert['updated_at'] = Carbon::now();
        $data_new = Feeback::create($data_insert);

        //Get data new insert to append in view
        $data = array();
        $feedback = Feeback::with([
            'create_user',
            'child' => function ($query) use ($daily_meal_id) {
                $query->where('daily_meal_id', $daily_meal_id);
                $query->with('create_user');
            }])->find($data_new->id);

        $item = array();
        $item['user'] = $feedback->create_user->name;
        $item['id'] = $feedback->id;
        $item['avatar'] = CommonHelper::getPublicImagePath($feedback->create_user->avatar);
        $item['date'] = (isset($feedback->date)) ? \Carbon\Carbon::parse($feedback->date)->format('H:i d/m/Y') : null;
        $item['content'] = $feedback->content;
        $item['parent_id'] = $parent_id;
        $data['feedback'] = $item;

        //Count all feedback
        $data['count_feedback'] = count(Feeback::where('daily_meal_id', $daily_meal_id)->get());
        return $data;
    }

    /**
     * Spice manager
     * @param $kitchen_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function spice($kitchen_id)
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
        $all_spices = User::with(['kitchen' => function ($query) use ($kitchen_id) {
            return $query->where('id_kitchen', $kitchen_id);
        }, 'kitchen.food'])
            ->where('id', Auth::user()->id)
            ->get();
        return view('chef.spice', compact('all_spices'));
    }
}
