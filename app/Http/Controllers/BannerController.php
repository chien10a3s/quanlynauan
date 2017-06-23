<?php

namespace App\Http\Controllers;

use App\Banner;
use App\BannerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Session;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        
        $_groups = BannerGroup::where('active', 1)->get();
        $groups = array();
        foreach($_groups as $group)
            $groups[$group->id] = $group->name;

        return view('banners.index', compact('banners', 'groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $_groups = BannerGroup::where('active', 1)->get();
        $groups = array();
        foreach($_groups as $group)
            $groups[$group->id] = $group->name;
        return view('banners.create',  compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_input = $request->only(['id', 'bannergroup_id', 'image', 'url', 'active']);
        $data_input['image'] = null;
        if($request->hasFile('image')) {        
            $resizeWidth = 1170;
            $resizeHeight = null;
            $file = $request->file('image');
            $filename = Str::random(20);
            $fullPath = 'banner/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();
    
            $ext = $file->guessClientExtension();
            $extension_allow = ['jpeg', 'jpg', 'png', 'gif'];
            if (in_array($ext, $extension_allow)) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
    
                if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $data_input['image'] = $fullPath;
                }
            }
        }
        
        Banner::insert($data_input);
        
        return redirect()->route('banner.index')->withFlashSuccess('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $_groups = BannerGroup::where('active', 1)->get();
        $groups = array();
        foreach($_groups as $group)
            $groups[$group->id] = $group->name;
        return view('banners.edit', compact('banner', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $data_input = $request->only(['bannergroup_id', 'url', 'active']);
        
        if($request->hasFile('image')) {        

            $resizeWidth = 1170;
            $resizeHeight = null;
            $file = $request->file('image');
            $filename = Str::random(20);
            $fullPath = 'slide/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();
    
            $ext = $file->guessClientExtension();
            $extension_allow = ['jpeg', 'jpg', 'png', 'gif'];
            if (in_array($ext, $extension_allow)) {
                $image = Image::make($file)
                    ->resize($resizeWidth, $resizeHeight, function (Constraint $constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode($file->getClientOriginalExtension(), 75);
    
                // move uploaded file from temp to uploads directory
                if (Storage::disk(config('voyager.storage.disk'))->put($fullPath, (string) $image, 'public')) {
                    $data_input['image'] = $fullPath;
                } else {
                    unset($data_input['image']);
                }
            } else {
                unset($data_input['image']);
            }
        }
        
        $banner->update($data_input);
        $banner->save();

        // redirect
        Session::flash('message', 'C?p nh?t th�nh c�ng');
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return back()->with('info', 'X�a th�nh c�ng');
    }
}
