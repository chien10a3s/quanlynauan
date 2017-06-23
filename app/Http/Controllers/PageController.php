<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
class PageController extends Controller
{
    public function show($slug)
    {

        $page = Page::where('slug',$slug)->first();
        if(!$page){
           return view('404');
        }
        return view('page', compact('page'));
    }
}
