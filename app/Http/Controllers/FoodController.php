<?php

namespace App\Http\Controllers;

use App\User;
use App\Food;
use App\FoodCategory;
use App\Supplier;
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
        $categories = FoodCategory::where('active', 1)->get();
        $suppliers = Supplier::where('status', 1)->get();
        return view('food.add', compact(['categories', 'suppliers']));
    }
    
    public function edit($food_id){
        $categories = FoodCategory::where('active', 1)->get();
        $food = Food::find($food_id);
        $suppliers = Supplier::where('status', 1)->get();
        return view('food.edit', compact(['food', 'categories', 'suppliers']));
    }
    
    public function delete($food_id){
        $food = Food::find($food_id)->delete();
        return redirect()->route('admin.food.index')->withFlashSuccess('Xóa s?n ph?m thành công');
    }
    
    public function duplicate(Request $request, $food_id){
        $food = Food::find($food_id);
        $new_food = $food->replicate();
        $new_food->save();
        return redirect()->route('admin.food.edit', $new_food->id)->with([
            'message'    => 'Sao chép s?n ph?m thành công',
            'alert-type' => 'success',
        ]);;
    }
    
    public function store(Request $request){
        $data_input = $request->only(['name', 'description', 'unit', 'quantity', 'price', 'id_category', 'id_supplier', 'status']);
        
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
        $data_input['created_by'] = Auth::user()->id;
        $data_input['updated_by'] = Auth::user()->id;
        
        
        Food::insert($data_input);
        
        return redirect()->route('admin.food.index')->withFlashSuccess('Thêm sản phẩm thành công');
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
        return redirect()->route('admin.food.index')->withFlashSuccess('C?p nh?t s?n ph?m thành công');
    }
    
}
