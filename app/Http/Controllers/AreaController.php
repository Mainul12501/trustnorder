<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Backend\Product\Category;
use App\Models\District;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('backend.areas.index', ['areas' => Area::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.areas.create', ['isShown' => false, 'districts' => District::where(['status' => 1])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area_name'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                Area::createOrUpdateArea($request);
            });
            Toastr::success('Area created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Area $area)
    {
        return view('backend.areas.create', ['area' => $area, 'isShown' => true, 'districts' => District::where(['status' => 1])->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area, Request $request)
    {
        return view('backend.areas.create', ['area' => $area, 'isShown' => false, 'districts' => District::where(['status' => 1])->get() ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'area_name'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                Area::createOrUpdateArea($request, $id);
//                $gasStation->gasStationEmployeeRoles()->detach();
            });
            Toastr::success('Area updated successfully.');
            return redirect(route('areas.index'));
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
//        GasStationEmployee::find($id)->delete();

        $area->delete();
        return back()->with('success', 'Area deleted successfully.');
    }

    public function getAreasByDistrictId(District $district)
    {
        return response()->json([
            'status'    => 'success',
            'areas'      => Area::where(['district_id' => $district->id, 'status' => 1])->get()
        ]);
    }
}
