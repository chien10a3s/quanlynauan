<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\Food;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyMeal\DailyMeal;
use App\Models\DailyDish\DailyDish;
use App\Models\DishDetail\DishDetail;
use App\Models\Category\Category;
use DB;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index($id_user = null)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $id_kitchen = 0;
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
        $all_meal = User::with(['kitchen' => function ($query) use ($id_kitchen) {
            return $query->where('id_kitchen', $id_kitchen);
        }, 'kitchen.daily_meal' => function ($query) use ($id_kitchen) {
            return $query->orderBy('day', 'desc');
        }])
            ->where('id', Auth::user()->id)
            ->take(10)
            ->get();
        return view('meal.index', compact('all_meal'));
    }

    public function view($id)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return back()->withErrors('Không có bếp quản lý');
        }
        $meal = DailyMeal::with('daily_dish', 'daily_dish.detail_dish')
            ->where('id', $id)
            ->first();

        $all_food = Food::get();
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if ($item_food->id_supplier == 1) {
                    $name = "Big C";
                } elseif ($item_food->id_supplier == 2) {
                    $name = "Vinmart";
                }
                $option[$name][$item_food->id] = $item_food->name;
            }
        }
        return view('meal.add', compact('get_all_thuc_pham', 'option'));
    }

    public function add()
    {
        $all_food = Food::get();
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if ($item_food->id_supplier == 1) {
                    $name = "Big C";
                } elseif ($item_food->id_supplier == 2) {
                    $name = "Vinmart";
                }
                $option[$name][$item_food->id] = $item_food->name;
            }
        }
        return view('meal.add', compact('get_all_thuc_pham', 'option'));
    }

    public function store(Request $request)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) <= 0 ) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Đăng ký không thành công. Tài khoản chưa được gán bếp.',
                    'alert-type' => 'error',
                ]);
        }
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
        $input = $request->all();
        if ($input['date'] != "") {
            $date = Carbon::createFromFormat('d/m/Y', $input['date'])->format('Y/m/d');
        } else {
            $date = Carbon::now()->format('Y/m/d');
        }
        $number_eat = (int)$input['number_of_meals'];
        $money_eat = (int)$input['money'];

        //Số lượng món ăn
        $number_dish = $input['tenmon'];
        if (count($number_dish) > 0) {
            DB::beginTransaction();
            try {
                // Lưu vào Bảng thực đơn hàng ngày daily_meals
                $data_create_daily_meal = [];
                $data_create_daily_meal['id_kitchen'] = $id_kitchen;
                $data_create_daily_meal['day'] = $date;
                $data_create_daily_meal['number_of_meals'] = $number_eat;
                $data_create_daily_meal['money_meals'] = $money_eat;
                $data_create_daily_meal['status'] = 0;
                $data_create_daily_meal['id_parent'] = 0;
                $data_create_daily_meal['created_by'] = Auth::user()->id;
                $data_create_daily_meal['updated_by'] = Auth::user()->id;
                $data_create_daily_meal['created_at'] = Carbon::now();

                $id_daily_meal = DailyMeal::insertGetId($data_create_daily_meal);

                foreach ($number_dish as $key => $item) {
                    $name_dish = $item;//Tên Món ăn
                    $name_note = $input['ghi_chu'][$key];//Ghi chú
                    $name_recipe = $input['cong_thuc'][$key];//Công thức
                    $arr_ingredient = $input['nguyen_lieu'][$key];//Nguyên liệu
                    $arr_number = $input['so_luong'][$key];//Số lượng của nguyên liệu
                    $arr_unit = $input['don_vi'][$key];//Đơn vị của số lượng

                    // Lưu vào bảng Món ăn cho thực đơn
                    $data_create_daily_dish = [];
                    $data_create_daily_dish['id_daily_meal'] = $id_daily_meal;
                    $data_create_daily_dish['name'] = $name_dish;
                    $data_create_daily_dish['cooking_note'] = $name_recipe;
                    $data_create_daily_dish['note'] = $name_note;
                    $data_create_daily_dish['status'] = 0;
                    $data_create_daily_dish['created_by'] = Auth::user()->id;
                    $data_create_daily_dish['updated_by'] = Auth::user()->id;
                    $data_create_daily_dish['created_at'] = Carbon::now();

                    $id_daily_dish = DailyDish::insertGetId($data_create_daily_dish);
                    foreach ($arr_ingredient as $key_ing => $item_ing) {
                        $name_ingredient = $item_ing;//id nguyên liệu
                        $number = $arr_number[$key_ing];
                        $unit = $arr_unit[$key_ing];


                        //Lưu thông tin chi tiết của món ăn
                        $arr_dish_detail = [];

                        $arr_dish_detail['id_daily_dish'] = $id_daily_dish;
                        $arr_dish_detail['id_food'] = $name_ingredient;
                        $arr_dish_detail['name'] = $name_ingredient;
                        $arr_dish_detail['number'] = $number;
                        $arr_dish_detail['unit'] = $unit;
                        $arr_dish_detail['money'] = 0;
                        $arr_dish_detail['status'] = 0;
                        $arr_dish_detail['created_by'] = Auth::user()->id;
                        $arr_dish_detail['updated_by'] = Auth::user()->id;
                        $arr_dish_detail['created_at'] = Carbon::now();
                        DishDetail::insertGetId($arr_dish_detail);
                    }
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Đăng ký không thành công. Vui lòng điền đầy đủ thông tin đăng ký.',
                        'alert-type' => 'error',
                    ]);
            }
            DB::commit();
            return redirect()
                ->route('admin.user.index')
                ->with([
                    'message' => 'Đăng ký món ăn thành công.',
                    'alert-type' => 'success',
                ]);
        }
        return redirect()
            ->back()
            ->with([
                'message' => 'Đăng ký không thành công. Không có món ăn được chọn.',
                'alert-type' => 'error',
            ]);
    }
}
