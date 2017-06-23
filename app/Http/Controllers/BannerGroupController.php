<?php

namespace App\Http\Controllers;

use App\BannerGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class BannerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bannergroups = BannerGroup::all();
        return view('banners.groupindex', compact('bannergroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banners.groupcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data_input = $request->only(['id', 'name', 'active']);

        BannerGroup::insert($data_input);
        
        return redirect()->route('bannergroup.index')->withFlashSuccess('Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BannerGroup  $bannerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(BannerGroup $bannerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BannerGroup  $bannerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(BannerGroup $bannergroup)
    {
        return view('banners.groupedit', compact('bannergroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BannerGroup  $bannerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BannerGroup $bannergroup)
    {
        $data_input = $request->only(['id', 'name', 'active']);

        $bannergroup->update($data_input);
        $bannergroup->save();

        // redirect
        Session::flash('message', 'C?p nh?t thành công');
        return redirect()->route('banners.groupindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BannerGroup  $bannerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(BannerGroup $bannergroup)
    {
        $bannergroup->delete();
        return back()->with('info', 'Xóa thành công');
    }
}
