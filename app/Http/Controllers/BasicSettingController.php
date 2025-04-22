<?php

namespace App\Http\Controllers;

use App\Models\BasicSetting;
use Illuminate\Http\Request;

class BasicSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        return view('backend.basic-setting.index', ['homeSliders' => BasicSetting::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $basicSetting = BasicSetting::first();
        return view('backend.basic-setting.create', ['basicSetting' => $basicSetting ?? null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        BasicSetting::createOrUpdateBasicSettings($request);
        return back()->with('success', 'Basic Setting Created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        return view('backend.basic-setting.create', ['homeSlider' => BasicSetting::find($id), 'isShown' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
//        return view('backend.basic-setting.create', ['homeSlider' => $BasicSetting]);
        return view('backend.basic-setting.create', ['homeSlider' => BasicSetting::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        BasicSetting::createOrUpdateBasicSettings($request, $id);
        return redirect(route('basic-settings.create'))->with('success', 'Basic Setting updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        BasicSetting::find($id)->delete();
//        $BasicSetting->delete();
        return back()->with('success', 'Basic Setting deleted successfully.');
    }
}
