<?php

namespace App\Http\Controllers;

use App\User;
use App\Food;
use TCG\Voyager\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Facades\Voyager;
use DB;
class FoodController extends Controller
{
    public function __construct(){}
    
    public function index(){
        $foods = Food::all();
        return view('food.list', compact('foods'));
    }
    
    public function add(){
        $categories = Category::all();
        return view('food.add', compact('categories'));
    }
    
    public function edit($food_id){
        $categories = Category::all();
        $food = Food::find($food_id);
        return view('food.edit', compact('categories'), compact('food'));
    }
    
    public function delete($food_id){
        $food = Food::find($food_id)->delete();
        return redirect()->route('admin.food.index')->withFlashSuccess('X�a s?n ph?m th�nh c�ng');
    }
    
    public function duplicate(Request $request, $food_id){
        $food = Food::find($food_id);
        $new_food = $food->replicate();
        $new_food->save();
        return redirect()->route('admin.food.edit', $new_food->id)->with([
            'message'    => 'Sao ch�p s?n ph?m th�nh c�ng',
            'alert-type' => 'success',
        ]);;
    }
    
    public function store(Request $request){
        
        $fullFilename = null;
        $resizeWidth = 800;
        $resizeHeight = null;
        $file = $request->file('image');
        $filename = Str::random(20);
        $fullPath = 'food/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();

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
                $status = 'Image successfully uploaded!';
                $fullFilename = $fullPath;
            } else {
                $status = 'Upload Fail: Unknown error occurred!';
            }
        } else {
            $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
        }
        
        $data_input = $request->only(['name', 'description', 'unit', 'quantity', 'price', 'id_category', 'id_supplier', 'status']);
        $data_input['created_by'] = Auth::user()->id;
        $data_input['updated_by'] = Auth::user()->id;
        $data_input['image'] = $fullFilename;
        
        Food::insert($data_input);
        
        return redirect()->route('admin.food.index')->withFlashSuccess('Th�m s?n ph?m th�nh c�ng');
    }
    
    public function update(Request $request, $food_id)
    {
        $data_input = $request->only(['name', 'description', 'unit', 'quantity', 'price', 'id_category', 'id_supplier', 'status']);
        $data_input['created_by'] = Auth::user()->id;
        $data_input['updated_by'] = Auth::user()->id;
        if($request->hasFile('image')){
            $fullFilename = null;
            $resizeWidth = 800;
            $resizeHeight = null;
            $file = $request->file('image');
            $filename = Str::random(20);
            $fullPath = 'food/'.date('F').date('Y').'/'.$filename.'.'.$file->getClientOriginalExtension();
    
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
                    $status = 'Image successfully uploaded!';
                    $fullFilename = $fullPath;
                } else {
                    $status = 'Upload Fail: Unknown error occurred!';
                }
            } else {
                $status = 'Upload Fail: Unsupported file format or It is too large to upload!';
            }

            $data_input['image'] = $fullFilename;
        }
        
        Food::find($food_id)->update($data_input);
        return redirect()->route('admin.food.index')->withFlashSuccess('C?p nh?t s?n ph?m th�nh c�ng');
    }
    
}
