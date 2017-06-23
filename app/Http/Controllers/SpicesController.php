<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecisUser\SpicesUser;
use App\Food;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

class SpicesController extends Controller
{
    public function __construct()
    {

    }
    /*
     *  Get all spices of kitchen
     */
    public function index(){
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
        return view('spices.index',compact('all_spices'));
    }
    /*
     *  Get all spices of kitchen
     */
    public function delete($id){
        SpicesUser::where('id',$id)->update(['status'=>3]);
        return redirect()
            ->back()
            ->with([
                'message' => 'Hủy gia vị thành công.',
                'alert-type' => 'success',
            ]);
    }
}
