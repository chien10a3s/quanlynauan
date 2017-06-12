<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\DailyMeal\DailyMeal;
use App\Models\DailyDish\DailyDish;
use App\Models\DishDetail\DishDetail;
use DB;

class UserController extends Controller
{
    public function __construct()
    {

    }

    public function index($id_user = null)
    {
        if (is_null($id_user)) {
            $id_user = Auth::user()->id;
        }
        //Lấy toàn bộ bữa an của tài khoản
        $all_meal = User::with(['kitchen', 'kitchen.daily_meal'])
            ->where('id', $id_user)
            ->first();
    }

    public function add()
    {
        return view('meal.add');
    }

    public function store(Request $request)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (is_null($user_kitchen)) {
            return back()->withErrors('Đăng ký không thành công. Không có bếp được chọn');
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
                        $name_ingredient = $item_ing;//Tên nguyên liệu
                        $number = $arr_number[$key_ing];
                        $unit = $arr_unit[$key_ing];


                        //Lưu thông tin chi tiết của món ăn
                        $arr_dish_detail = [];

                        $arr_dish_detail['id_daily_dish'] = $id_daily_dish;
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
                dd($e);
                DB::rollBack();
                return redirect()->back()->withErrors('Có lỗi trong quá trình thêm mới');
            }
            DB::commit();
            return redirect()->back()->withFlashSuccess('Đăng ký món ăn thành công');
        }
        return back()->withErrors('Đăng ký không thành công. Không có món ăn được chọn');
    }
}
