<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kitchen\Kitchen;

class KitchenController extends Controller
{
    //
    public function __construct()
    {

    }

    public function index()
    {
        $all_kitchen = Kitchen::with('users')->where('status', 1)->get();
    }
}
