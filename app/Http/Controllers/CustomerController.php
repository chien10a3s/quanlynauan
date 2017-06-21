<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;
use TCG\Voyager\Models\Category;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function index(){
        return view('customer.index');
    }
    
    public function food(){
        return view('customer.food');
    }
    
    public function orderHistory(){
        return view('customer.orderhistory');
    }
    
    public function transaction(){
        return view('customer.transaction');
    }
    
}