<?php

namespace App\Http\Controllers;

use Session;
use App\FoodCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foodcategories = FoodCategory::where('active', 1)->get();
        return view('foodcategory.index', compact('foodcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('foodcategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_input = $request->only(['name', 'description','slug' , 'active']);
        $data_input['created_by'] = Auth::user()->id;
        $data_input['updated_by'] = Auth::user()->id;
        
        Foodcategory::insert($data_input);
        
        return redirect()->route('foodcategory.index')->withFlashSuccess('Thêm thành công');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $foodCategory = FoodCategory::find($id);
        return view('foodcategory.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $foodCategory = FoodCategory::find($id);
        
        $foodCategory->name         = $request->input('name');
        $foodCategory->description  = $request->input('description');
        $foodCategory->slug         = $request->input('slug');
        $foodCategory->active       = $request->input('active');
        $foodCategory->updated_by   = Auth::user()->id;
        
        $foodCategory->save();

        Session::flash('message', 'C?p nh?t thành công');
        return redirect()->route('foodcategory.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FoodCategory  $foodCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FoodCategory $foodCategory)
    {
        //
    }
}
