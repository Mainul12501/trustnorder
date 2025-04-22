<?php

namespace App\Http\Controllers;

use App\helper\ViewHelper;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            $banners = Banner::where(['status' => 1])->latest()->get();
        } else {
            $banners = Banner::latest()->get();
        }

        return ViewHelper::checkViewForApi(['banners' => $banners], 'backend.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.banners.create', ['isShown' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                Banner::createOrUpdateBanner($request);
            });
            Toastr::success('Banner created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Banner $banner)
    {
        return view('backend.banners.create', ['banner' => $banner, 'isShown' => true, ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner, Request $request)
    {
        return view('backend.banners.create', ['banner' => $banner, 'isShown' => false, ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
//            'image'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                Banner::createOrUpdateBanner($request, $id);
//                $gasStation->gasStationEmployeeRoles()->detach();
            });
            Toastr::success('Banner updated successfully.');
            return redirect(route('banners.index'));
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
//        GasStationEmployee::find($id)->delete();

        $banner->delete();
        return back()->with('success', 'Banner deleted successfully.');
    }
}
