<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('backend.districts.index', ['districts' => District::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.districts.create', ['isShown' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'district_name'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                District::createOrUpdateDistrict($request);
            });
            Toastr::success('District created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        return view('backend.districts.create', ['district' => $district, 'isShown' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(District $district, Request $request)
    {
        return view('backend.districts.create', ['district' => $district, 'isShown' => false ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'district_name'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                District::createOrUpdateDistrict($request, $id);
            });
            Toastr::success('District updated successfully.');
            return redirect(route('districts.index'));
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $district->delete();
        return back()->with('success', 'District deleted successfully.');
    }
}
