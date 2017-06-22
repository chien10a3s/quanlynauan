<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TCG\Voyager\Models\Post;
use App\Slide;
use App\BannerGroup;
use App\Testimonial;
/**
 * Class HomeController
 * @package App\Http\Controllers
 */
 

class LandingController extends Controller
{
    public function __construct()
    {
        
    }
    
    public function index()
    {
        $featuredposts = \TCG\Voyager\Models\Post::where(array('status' => 'PUBLISHED', 'featured' => 1))->orderBy('created_at', 'DESC')->limit(3)->get();
        $slides = Slide::where('active', 1)->get();
        $banners = BannerGroup::find(1)->banners;
        $testimonials = Testimonial::where('active',1)->get();
        
        return view('home', compact(['slides', 'featuredposts', 'banners', 'testimonials']));
    }
}