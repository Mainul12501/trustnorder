<?php

namespace App\Http\Controllers\Backend\Users;

use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.all-users.index', ['users' => User::where(['role' => 'user'])->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.all-users.create', ['isShown' => false, 'districts' => District::where(['status' => 1])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'mobile'    => 'required',
            'password'  => 'required'
        ]);
        try {
            DB::transaction(function () use ($request){
                $gasStation = User::createOrUpdateUser($request);
            });
            Toastr::success('User updated successfully.');
            return redirect(route('users.index'));
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return ViewHelper::checkViewForApi(['user' => User::find($id), 'isShown' => true, 'districts' => District::where(['status' => 1])->get()], 'backend.all-users.create');
        return view('backend.all-users.create', ['user' => User::find($id), 'isShown' => true, 'districts' => District::where(['status' => 1])->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('backend.all-users.create', ['user' => User::find($id), 'isShown' => false, 'districts' => District::where(['status' => 1])->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required',
            'mobile'    => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                User::createOrUpdateUser($request, $id);
            });
            if (str()->contains(url()->current(), '/api/'))
            {
                return response()->json(['success' => 'User updated successfully.'], 200);
            }
            Toastr::success('User updated successfully.');
            return redirect(route('users.index'));
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        Toastr::success('User deleted successfully.');
        return back();
    }

    public function registeredUserDetails(Request $request)
    {
        return response()->json(ViewHelper::loggedUser());
    }
}
