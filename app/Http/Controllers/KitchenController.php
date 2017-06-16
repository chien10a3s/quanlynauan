<?php

namespace App\Http\Controllers;

use App\Models\Kitchen\Kitchen;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\AddKitchen;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use DB;

class KitchenController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Voyager::model('User')->find(Auth::id());
            if ($user->hasPermission('browse_kitchens')) {
                return $next($request);
            }
            return redirect()
                ->back()
                ->with([
                    'message' => 'Not permission.',
                    'alert-type' => 'error',
                ]);
        });
    }

    public function index()
    {
        $all_kitchen = Kitchen::with('users')->get();
        return view('kitchen.index', compact('all_kitchen'));
    }

    public function detail($id)
    {
        $data = Kitchen::where('id', $id)->first();
        return view('kitchen.detail', compact('data'));
    }

    public function user($id)
    {
        //Lấy toàn bộ đầu bếp
        $all_chef = User::where('role_id', 3)->pluck('name', 'id');
        $all_chef[0] = "Chọn đầu bếp";

        //Lấy toàn bộ khách hàng
        $all_user = User::where('role_id', 2)->pluck('name', 'id');
        $all_user[0] = "Chọn khách hàng";

        $data = Kitchen::with('users')->where('id', $id)->first();
        if (is_null($data)) {
            return redirect()->back()->withErrors('Không tồn tại bếp');
        }
        //Lấy user
        $id_chef = 0;
        $id_user = 0;
        if (count($data->users) > 0) {
            foreach ($data->users as $item_user) {
                if ($item_user->role_id == 2) {
                    $id_user = $item_user->id;
                }
                if ($item_user->role_id == 3) {
                    $id_chef = $item_user->id;
                }
            }
        }
        return view('kitchen.update_user', compact('data', 'all_chef', 'all_user', 'id_chef', 'id_user'));
    }

    public function updateUser(Request $request, $id)
    {
        $data_input = $request->all();
        $data_create_chef = [];
        $data_create_user = [];

        //Insert đầu bếp
        $data_create_chef['id_kitchen'] = $id;
        $data_create_chef['id_user'] = $data_input['chef'];
        $data_create_chef['role'] = 3;

        $data_create_user['id_kitchen'] = $id;
        $data_create_user['id_user'] = $data_input['user'];
        $data_create_user['role'] = 2;

        $is_commit = true;
        $check_exist_user = $this->checkExistUserInKitchen($id, 2);;
        $check_exist_chef = $this->checkExistUserInKitchen($id, 3);
        DB::beginTransaction();
        try {
            if ($data_input['chef'] != 0) {
                //Kiểm tra tài khoản ĐẦU BẾP đã được gán cho bếp hay chưa
                if (is_null($check_exist_chef)) {
                    $data_create_chef['created_by'] = Auth::user()->id;
                    $data_create_chef['updated_by'] = Auth::user()->id;
                    DB::table('user_kitchens')->insert($data_create_chef);
                } else {
                    $data_create_chef['updated_by'] = Auth::user()->id;
                    DB::table('user_kitchens')->where('id', $check_exist_chef->id)->update($data_create_chef);
                }
            } else {
                DB::table('user_kitchens')
                    ->where('id_kitchen', $id)
                    ->where('role', 3)
                    ->delete();
            }
            if ($data_input['user'] != 0) {
                //Kiểm tra tài khoản KHÁCH HÀNG đã được gán cho bếp hay chưa
                if (is_null($check_exist_user)) {
                    $data_create_user['created_by'] = Auth::user()->id;
                    $data_create_user['updated_by'] = Auth::user()->id;
                    DB::table('user_kitchens')->insert($data_create_user);
                } else {
                    $data_create_user['updated_by'] = Auth::user()->id;
                    DB::table('user_kitchens')->where('id', $check_exist_user->id)->update($data_create_user);
                }
            } else {
                DB::table('user_kitchens')
                    ->where('id_kitchen', $id)
                    ->where('role', 2)
                    ->delete();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $is_commit = false;
            return redirect()
                ->route('admin.kitchen.index')
                ->with([
                    'message' => 'Cập nhật tài khoản không thành công.',
                    'alert-type' => 'error',
                ]);
        }
        DB::commit();
        return redirect()
            ->route('admin.kitchen.index')
            ->with([
                'message' => 'Cập nhật tài khoản thành công.',
                'alert-type' => 'success',
            ]);

    }

    public function add($id)
    {
        return view('kitchen.add');
    }

    public function store(Request $request)
    {
        $data_input = $request->all();
        $data_create = [];
        $data_create['code'] = $data_input['code'];
        $data_create['name'] = $data_input['name'];
        $data_create['status'] = $data_input['status'];
        $data_create['note'] = $data_input['note'];
        $data_create['address'] = $data_input['address'];
        $data_create['money'] = $data_input['money'];
        $data_create['created_by'] = Auth::user()->id;
        $data_create['updated_by'] = Auth::user()->id;
        /*
         * Check exist code
         */
        if (!$this->checkExistCode($data_input['code'])) {
            return redirect()
                ->back()
                ->with([
                    'message' => 'Mã bếp đã tồn tại.',
                    'alert-type' => 'error',
                ]);
        }
        Kitchen::insert($data_create);
        return redirect()
            ->route('admin.kitchen.index')
            ->with([
                'message' => 'Thêm mới bếp thành công.',
                'alert-type' => 'success',
            ]);
    }

    public function edit($id)
    {
        $data = Kitchen::where('id', $id)->first();
        return view('kitchen.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data_input = $request->all();
        $data_create = [];
        $data_create['name'] = $data_input['name'];
        $data_create['status'] = $data_input['status'];
        $data_create['note'] = $data_input['note'];
        $data_create['address'] = $data_input['address'];
        $data_create['money'] = $data_input['money'];
        $data_create['created_by'] = Auth::user()->id;
        $data_create['updated_by'] = Auth::user()->id;

        Kitchen::where('id', $id)->update($data_create);
        return redirect()
            ->route('admin.kitchen.index')
            ->with([
                'message' => 'Cập nhật bếp thành công.',
                'alert-type' => 'success',
            ]);
    }

    public function delete($id)
    {
        Kitchen::where('id', $id)->delete();
        return redirect()
            ->route('admin.kitchen.index')
            ->with([
                'message' => 'Xóa bếp thành công.',
                'alert-type' => 'success',
            ]);
    }

    private function checkExistCode($code)
    {
        $data = Kitchen::where('code', $code)->first();
        if (is_null($data)) {
            return true;
        }
        return false;
    }

    private function checkExistUserInKitchen($id_kitchen, $role)
    {
        return DB::table('user_kitchens')
            ->where('id_kitchen', $id_kitchen)
//            ->where('id_user', $id_user)
            ->where('role', $role)
            ->first();
    }
}
