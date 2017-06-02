<?php

namespace App\Http\Controllers;

use App\Models\Kitchen\Kitchen;
use Illuminate\Http\Request;
use App\Http\Requests\AddKitchen;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        $all_kitchen = Kitchen::with('users')->get();
        return view('kitchen.index', compact('all_kitchen'));
    }

    public function add()
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
            return redirect()->back()->withErrors('Mã bếp đã tồn tại');
        }
        Kitchen::insert($data_create);
        return redirect()->route('admin.kitchen.index')->withFlashSuccess('Thêm mới bếp thành công');
    }

    public function edit($id){
        $data = Kitchen::where('id', $id)->first();
        return view('kitchen.edit', compact('data'));
    }
    public function update(Request $request,$id)
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

        Kitchen::where('id',$id)->update($data_create);
        return redirect()->route('admin.kitchen.index')->withFlashSuccess('Cập nhật bếp thành công');
    }
    public function delete($id)
    {
        Kitchen::where('id', $id)->delete();
        return redirect()->back()->withFlashSuccess('Xóa bếp thành công');
    }

    private function checkExistCode($code)
    {
        $data = Kitchen::where('code', $code)->first();
        if (is_null($data)) {
            return true;
        }
        return false;
    }
}
