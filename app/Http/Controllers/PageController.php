<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Page;
class PageController extends Controller
{
    public function show($slug)
    {
        $latestposts = \TCG\Voyager\Models\Post::where('status', 'PUBLISHED')->orderBy('created_at', 'DESC')->limit(2)->get();
        
        $page = Page::where('slug',$slug)->first();
        if(!$page){
           return view('404');
        }
        return view('page', compact('latestposts', 'page'));
    }
}
