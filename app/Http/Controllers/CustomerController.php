<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Str;
use App\Food;
use App\Models\DailyMeal\DailyMeal;
use App\Models\UserKitchen\UserKitchen;
use Illuminate\Support\Facades\Auth;
use DB;
use App\User;

class CustomerController extends Controller
{
    
    public function dichothu()
    {
        if(!Auth::check()){
            $random_id = strtotime("now");
            $khach = User::create([
                'role_id' => 4, 
                'name' => "Khachhang$random_id", 
                'email' => "example$random_id@gmail.com", 
                'avatar' => 'users/default-avatar.png', 
                'password' => '$2y$10$RKANhAtnpDKKoFL7Y1JBh.8MZORXHfIiNhoB4qVdMlJzJ4QWMhd8O'
            ]);
            
            UserKitchen::create([
                'id_kitchen' => 2,
                'id_user'    => $khach->id,
                'role'       => 2,
                'created_by' => $khach->id,
                'updated_by' => $khach->id,
            ]);
            
            $userdata = array(
    		    'email'    => "example$random_id@gmail.com",
    		    'password' => 'password'
            );
    
            Auth::validate($userdata);
            Auth::attempt($userdata);
        }
        return redirect()->intended('meal-daily/add');
    }
    
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
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) <= 0){
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bếp được gán cho tài khoản.',
                    'alert-type' => 'error',
                ]);
        }
        foreach ($user_kitchen as $item_kitchen){
            $id_kitchen = $item_kitchen->id;
        }
        $all_spices = User::with(['kitchen' => function ($query) use ($id_kitchen) {
            return $query->where('id_kitchen', $id_kitchen);
        }, 'kitchen.food'])
            ->where('id', Auth::user()->id)
            ->get();
        return view('customer.food',compact('all_spices'));
    }

    public function orderHistory(Request $request)
    {
        $input = $request->all();


        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $id_kitchen = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }


        if (!empty($input)){
            $start_date_begin = @$input['start_date'];
            $end_date_begin = @$input['end_date'];

            if ($start_date_begin == null){
                $start_date = "0001-01-01";
            }else{
                $start_date = Carbon::createFromFormat('d/m/Y',$start_date_begin)->format('Y-m-d');
            }

            if ($end_date_begin == null){
                $end_date = Carbon::now()->format('Y-m-d');
            }else{
                $end_date = Carbon::createFromFormat('d/m/Y',$end_date_begin)->format('Y-m-d');
            }
            $all_meal = User::with(['kitchen' => function ($query) use ($id_kitchen) {
                return $query->where('id_kitchen', $id_kitchen);
            }, 'kitchen.daily_meal' => function ($query) use ($id_kitchen,$start_date,$end_date) {
                return $query->where('day','>=',$start_date)
                    ->where('day','<=',$end_date)
                    ->orderBy('day', 'desc');
            }])
                ->where('id', Auth::user()->id)
                ->take(10)
                ->get();
            return view('customer.orderhistory',compact('all_meal','start_date_begin','end_date_begin'));
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
    
    public function feedback()
    {
        return view('customer.feedback');
    }
    
}