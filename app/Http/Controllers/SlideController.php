<?php

namespace App\Http\Controllers;

use Session;
use Redirect;
use App\User;
use App\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        return view('slide.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_input = $request->only(['heading', 'description', 'button', 'url', 'active']);
        $data_input['image'] = null;
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
                }
            }
        }
        
        Slide::insert($data_input);
        
        return redirect()->route('slide.index')->withFlashSuccess('Thêm thành công');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('slide.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data_input = $request->only(['heading', 'description', 'button', 'url', 'active']);
        
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
        
        $slide = Slide::find($id);
        $slide->update($data_input);
        $slide->save();

        // redirect
        Session::flash('message', 'Cập nhật thành công');
        return redirect()->route('slide.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);
        $slide->delete();
        return back()->with('info', 'Xóa thành công');
    }
}
