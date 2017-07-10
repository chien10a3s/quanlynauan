<?php

namespace App\Http\Controllers;

use App\Models\Kitchen\Kitchen;
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
use App\Models\Feedback\Feeback;
use App\Helpers\CommonHelper;

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

    public function transaction(Request $request)
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
            $all_log = Kitchen::with(['log'=>function($query){
                return $query->where('action_type',4)->orderBy('updated_at','desc')->first();
            }])
                ->where('id',$id_kitchen)
                ->first();
            return view('customer.transaction',compact('all_log'));
        }
        //Get all log

        $all_log = Kitchen::with(['log'=>function($query){
            return $query->where('action_type',4)->orderBy('updated_at','desc')->first();
        }])
            ->where('id',$id_kitchen)
            ->first();
        return view('customer.transaction',compact('all_log'));
    }
    
    public function feedback()
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $kitchen_id = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $kitchen_id = $item_kitchen->id;
        }
        $daily_meal_id = Input::get('daily_meal_id');

        $data = array();
//        $data['kitchen'] = Kitchen::find($kitchen_id);

//        $data['date'] = $day;
//        $data['kitchen_id'] = $kitchen_id;

        $data['meals'] = DailyMeal::with([
            'daily_dish' => function ($query) {
                $query->where('status', 1);
                $query->with(['detail_dish']);
            }
        ])
            ->where('id', $daily_meal_id)
            ->get();
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
//        dd($data);
        return view('customer.feedback',compact('data'));
    }

    public function storeFeedback(Request $request)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $id_kitchen = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
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
//=======
        return view('customer.feedback');
//>>>>>>> a754064628f92d12d1fb28913f962bec4e689dd7
    }
    
}