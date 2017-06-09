<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

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
}
