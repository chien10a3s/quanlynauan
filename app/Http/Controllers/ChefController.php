<?php

namespace App\Http\Controllers;

use App\Models\UserKitchen\UserKitchen;
use App\User;
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
    public function index(){
        $user_login = Auth::user()->id;

        $list_kitchen = User::with([
            'kitchen' => function($query) use ($user_login){
                $query->where('status', 1)->where('role', 3);
                $query->with(['daily_meal']);
            }])->find($user_login);
//        if(empty($list_kitchen)){
//            return redirect()->back()->withErrors('Không tồn tại bếp');
//        }
        $data = array();
        $data['user'] = Auth::user();
        $data['kitchen'] = array();
        foreach ($list_kitchen->kitchen as $index => $kitchen){
            $data_item = array();
            $data_item['index'] = $index+1;
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
}
