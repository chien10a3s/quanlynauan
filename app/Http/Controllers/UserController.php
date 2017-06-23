<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
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
        $all_food = Food::with('supplier')->where('status', 1)->get();
        $info_meal = DailyMeal::with(['daily_dish', 'daily_dish.detail_dish'])->where('id', $id)->first();
        if (is_null($info_meal)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bữa ăn được chỉnh sửa.',
                    'alert-type' => 'error',
                ]);
        }
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if (count($item_food->supplier) > 0) {
                    $name = $item_food->supplier->name;
                }
                $option[$name][$item_food->id] = $item_food->name . ' ( ' . number_format($item_food->price) . ' VND ) / '.$item_food->unit;
            }
        }
        return view('meal.view', compact('option', 'info_meal'));
    }

    public function add()
    {
        $all_food = Food::with('supplier')->where('status', 1)->get();
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if (count($item_food->supplier) > 0) {
                    $name = $item_food->supplier->name;
                }
                $option[$name][$item_food->id] = $item_food->name . ' ( ' . number_format($item_food->price) . ' VND ) / '.$item_food->unit;
            }
        }
        return view('meal.add', compact('get_all_thuc_pham', 'option'));
    }

    public function store(Request $request)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) <= 0) {
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
            $date = Carbon::createFromFormat('d/m/Y', $input['date'])->format('Y-m-d');
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }
        //Kiểm tra ngày đăng ký đã tồn tại hay chưa
        $check_date = DailyMeal::where('day', $date)->first();
        if (!is_null($check_date)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Đăng ký không thành công. Đã có đăng ký cho ngày hiện tại.',
                    'alert-type' => 'error',
                ]);
        }
        //Kiểm tra ngày đăng ký có nhỏ hơn ngày hiện tại hay không
        if (Carbon::createFromFormat('d/m/Y', $input['date'])->timestamp < Carbon::now()->timestamp) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Đăng ký không thành công. Ngày đăng ký không được nhỏ hơn ngày hiện tại.',
                    'alert-type' => 'error',
                ]);
        }
        $number_eat = (int)$input['number_of_meals'];
        $money_eat = (int)$input['money'];

        if (isset($input['uyquyen'])){
            $data_create_daily_meal = [];
            $data_create_daily_meal['id_kitchen'] = $id_kitchen;
            $data_create_daily_meal['day'] = $date;
            $data_create_daily_meal['number_of_meals'] = $number_eat;
            $data_create_daily_meal['money_meals'] = $money_eat;
            $data_create_daily_meal['status'] = 0;
            $data_create_daily_meal['is_permission'] = 1;
            $data_create_daily_meal['id_parent'] = 0;
            $data_create_daily_meal['created_by'] = Auth::user()->id;
            $data_create_daily_meal['updated_by'] = Auth::user()->id;
            $data_create_daily_meal['created_at'] = Carbon::now();

            DailyMeal::insertGetId($data_create_daily_meal);
            return redirect()
                ->route('user.account.orderhistory')
                ->with([
                    'message' => 'Đăng ký món ăn thành công.',
                    'alert-type' => 'success',
                ]);
        }else{
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
                    $data_create_daily_meal['is_permission'] = 0;
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
//                            dd($item_ing);
                            $number = $arr_number[$key_ing];
//                            $unit = $arr_unit[$key_ing];


                            //Lưu thông tin chi tiết của món ăn
                            $arr_dish_detail = [];

                            $arr_dish_detail['id_daily_dish'] = $id_daily_dish;
                            $arr_dish_detail['id_food'] = $name_ingredient;
                            $arr_dish_detail['name'] = $name_ingredient;
                            $arr_dish_detail['number'] = $number;
                            $arr_dish_detail['unit'] = 1;
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
                    return redirect()
                        ->back()
                        ->with([
                            'message' => 'Đăng ký không thành công. Vui lòng điền đầy đủ thông tin đăng ký.',
                            'alert-type' => 'error',
                        ]);
                }
                DB::commit();
                return redirect()
                    ->route('user.account.orderhistory')
                    ->with([
                        'message' => 'Đăng ký món ăn thành công.',
                        'alert-type' => 'success',
                    ]);
            }
        }
        return redirect()
            ->back()
            ->with([
                'message' => 'Đăng ký không thành công. Không có món ăn được chọn.',
                'alert-type' => 'error',
            ]);
    }

    public function edit($id)
    {
        $all_food = Food::with('supplier')->where('status', 1)->get();
        $info_meal = DailyMeal::with(['daily_dish', 'daily_dish.detail_dish'])->where('id', $id)->first();
//        dd($info_meal);
        if (is_null($info_meal)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bữa ăn được chỉnh sửa.',
                    'alert-type' => 'error',
                ]);
        }
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if (count($item_food->supplier) > 0) {
                    $name = $item_food->supplier->name;
                }
                $option[$name][$item_food->id] = $item_food->name . ' ( ' . number_format($item_food->price) . ' VND ) / '.$item_food->unit;
            }
        }
        return view('meal.edit', compact('option', 'info_meal'));
    }
    public function double($id)
    {
        $all_food = Food::with('supplier')->where('status', 1)->get();
        $info_meal = DailyMeal::with(['daily_dish', 'daily_dish.detail_dish'])->where('id', $id)->first();
//        dd($info_meal);
        if (is_null($info_meal)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Không có bữa ăn được chỉnh sửa.',
                    'alert-type' => 'error',
                ]);
        }
        $option = [];
        if (count($all_food) > 0) {
            foreach ($all_food as $item_food) {
                $name = "";
                if (count($item_food->supplier) > 0) {
                    $name = $item_food->supplier->name;
                }
                $option[$name][$item_food->id] = $item_food->name . ' ( ' . number_format($item_food->price) . ' VND ) / '.$item_food->unit;
            }
        }
        return view('meal.double', compact('option', 'info_meal'));
    }

    public function update(Request $request, $id)
    {
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) <= 0) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Cập nhật không thành công. Tài khoản chưa được gán bếp.',
                    'alert-type' => 'error',
                ]);
        }
        foreach ($user_kitchen as $item_kitchen) {
            $id_kitchen = $item_kitchen->id;
        }
        $input = $request->all();
        if ($input['date'] != "") {
            $date = Carbon::createFromFormat('d/m/Y', $input['date'])->format('Y-m-d');
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }
        //Kiểm tra ngày đăng ký đã tồn tại hay chưa
        $check_date = DailyMeal::where('day', $date)->where('id', '<>', $id)->first();
        if (!is_null($check_date)) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Đăng ký không thành công. Đã có đăng ký cho ngày hiện tại.',
                    'alert-type' => 'error',
                ]);
        }
        //Kiểm tra ngày đăng ký có nhỏ hơn ngày hiện tại hay không
        if (Carbon::createFromFormat('d/m/Y', $input['date'])->timestamp < Carbon::now()->timestamp) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Đăng ký không thành công. Ngày đăng ký không được nhỏ hơn ngày hiện tại.',
                    'alert-type' => 'error',
                ]);
        }
        $number_eat = (int)$input['number_of_meals'];
        $money_eat = (int)$input['money'];


        if (isset($input['uyquyen'])){
            //Xóa chi tiết bữa ăn
            $this->delete($id, false);

            //Cập nhật lại bữa ăn
            $data_create_daily_meal = [];
            $data_create_daily_meal['id_kitchen'] = $id_kitchen;
            $data_create_daily_meal['day'] = $date;
            $data_create_daily_meal['number_of_meals'] = $number_eat;
            $data_create_daily_meal['money_meals'] = $money_eat;
            $data_create_daily_meal['status'] = 0;
            $data_create_daily_meal['is_permission'] = 1;
            $data_create_daily_meal['id_parent'] = 0;
            $data_create_daily_meal['updated_by'] = Auth::user()->id;
            $data_create_daily_meal['updated_at'] = Carbon::now();

            DailyMeal::where('id', $id)->update($data_create_daily_meal);
            return redirect()
                ->route('user.account.orderhistory')
                ->with([
                    'message' => 'Cập nhật món ăn thành công.',
                    'alert-type' => 'success',
                ]);
        }
        //Số lượng món ăn
        $number_dish = @$input['tenmon'];
        if (count($number_dish) > 0) {
            DB::beginTransaction();
            try {
                //Xóa chi tiết bữa ăn
                $this->delete($id, false);
                // Lưu vào Bảng thực đơn hàng ngày daily_meals
                $data_create_daily_meal = [];
                $data_create_daily_meal['id_kitchen'] = $id_kitchen;
                $data_create_daily_meal['day'] = $date;
                $data_create_daily_meal['number_of_meals'] = $number_eat;
                $data_create_daily_meal['money_meals'] = $money_eat;
                $data_create_daily_meal['status'] = 0;
                $data_create_daily_meal['id_parent'] = 0;
                $data_create_daily_meal['is_permission'] = 0;
                $data_create_daily_meal['updated_by'] = Auth::user()->id;
                $data_create_daily_meal['updated_at'] = Carbon::now();

                DailyMeal::where('id', $id)->update($data_create_daily_meal);

                foreach ($number_dish as $key => $item) {
                    $name_dish = $item;//Tên Món ăn
                    $name_note = $input['ghi_chu'][$key];//Ghi chú
                    $name_recipe = $input['cong_thuc'][$key];//Công thức
                    $arr_ingredient = $input['nguyen_lieu'][$key];//Nguyên liệu
                    $arr_number = $input['so_luong'][$key];//Số lượng của nguyên liệu
//                    $arr_unit = $input['don_vi'][$key];//Đơn vị của số lượng

                    // Lưu vào bảng Món ăn cho thực đơn
                    $data_create_daily_dish = [];
                    $data_create_daily_dish['id_daily_meal'] = $id;
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
//                        $unit = $arr_unit[$key_ing];


                        //Lưu thông tin chi tiết của món ăn
                        $arr_dish_detail = [];

                        $arr_dish_detail['id_daily_dish'] = $id_daily_dish;
                        $arr_dish_detail['id_food'] = $name_ingredient;
                        $arr_dish_detail['name'] = $name_ingredient;
                        $arr_dish_detail['number'] = $number;
                        $arr_dish_detail['unit'] = 1;
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
                dd($e);
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Đăng ký không thành công. Vui lòng điền đầy đủ thông tin đăng ký.',
                        'alert-type' => 'error',
                    ]);
            }
            DB::commit();
            return redirect()
                ->route('user.account.orderhistory')
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

    public function delete($id_meal, $delete_meal = true)
    {
        $info_meal = DailyMeal::where('id', $id_meal)->first();
        if (Carbon::now()->timestamp < Carbon::createFromFormat('Y-m-d H:i:s', Carbon::parse($info_meal->day)->format('Y-m-d') . "09:00:00")->timestamp) {
            $all_id_dailydish = DailyDish::where('id_daily_meal', $id_meal)->pluck('id');
            try {
                //Xóa chi tiết của món ăn
                DishDetail::whereIn('id_daily_dish', $all_id_dailydish)->delete();
                //Xóa món ăn của thực đơn
                DailyDish::where('id_daily_meal', $id_meal)->delete();
                if ($delete_meal) {
                    //Xóa thực đơn
                    DailyMeal::where('id', $id_meal)->delete();
                }
                return redirect()
                    ->route('user.account.orderhistory')
                    ->with([
                        'message' => 'Xóa đăng ký thành công.',
                        'alert-type' => 'success',
                    ]);
            } catch (\Exception $e) {
                return redirect()
                    ->back()
                    ->with([
                        'message' => 'Xóa không thành công. Có lỗi trong quá trình thực hiện.',
                        'alert-type' => 'error',
                    ]);
            }
        }
        return redirect()
            ->back()
            ->with([
                'message' => 'Xóa không thành công. Có lỗi trong quá trình thực hiện.',
                'alert-type' => 'error',
            ]);
    }

    public function checkDate(Request $request)
    {
        $date = Input::get('date');
        if ($date) {
            $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }
        //Kiểm tra ngày đăng ký đã tồn tại hay chưa
        $check_date = DailyMeal::where('day', $date)->first();
        if (!is_null($check_date)) {
            return response()->json([
                'name' => 'Đăng ký không thành công. Đã có đăng ký cho ngày hiện tại.',
                'state' => 0
            ]);
        }
        //Kiểm tra ngày đăng ký có nhỏ hơn ngày hiện tại hay không
        if (Carbon::createFromFormat('Y-m-d', $date)->timestamp < Carbon::now()->timestamp) {
            return response()->json([
                'name' => 'Đăng ký không thành công. Ngày đăng ký không nhỏ hơn ngày hiện tại.',
                'state' => 0
            ]);
        }
        return response()->json([
            'name' => 'OK',
            'state' => 1
        ]);
    }


    public function checkDateUpdate()
    {
        $date = Input::get('date');
        $id = Input::get('id');
        if ($date) {
            $date = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }
        //Kiểm tra ngày đăng ký đã tồn tại hay chưa
        $check_date = DailyMeal::where('day', $date)->where('id', '<>', $id)->first();
        if (!is_null($check_date)) {
            return response()->json([
                'name' => 'Đăng ký không thành công. Đã có đăng ký cho ngày hiện tại.',
                'state' => 0
            ]);
        }
        //Kiểm tra ngày đăng ký có nhỏ hơn ngày hiện tại hay không
        if (Carbon::createFromFormat('Y-m-d', $date)->timestamp < Carbon::now()->timestamp) {
            return response()->json([
                'name' => 'Đăng ký không thành công. Ngày đăng ký không nhỏ hơn ngày hiện tại.',
                'state' => 0
            ]);
        }
        return response()->json([
            'name' => 'OK',
            'state' => 1
        ]);
    }

    public function getLisstMeal($user_id = null)
    {
        $day_of_week = [1=>"Thứ 2",2=>"Thứ 3",3=>"Thứ 4",4=>"Thứ 5",5=>"Thứ 6",6=>"Thứ 7",7=>"Chủ nhật"];
        $user_kitchen = Auth::user()->kitchen;
        if (count($user_kitchen) < 0) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Tài khoản chưa có bếp quản lý.',
                    'alert-type' => 'error',
                ]);
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
            ->get();
        return view('meal.ajax_list_meal',compact('all_meal','day_of_week'));
    }
}
