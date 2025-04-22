<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\District;
use App\Models\PageContent;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('backend.page-contents.index', ['pageContents' => PageContent::latest()->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.page-contents.create', ['isShown' => false,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'page_type'  => 'required',
            'content'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                PageContent::createOrUpdatePageContent($request);
            });
            Toastr::success('Page Content created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PageContent $pageContent)
    {
        return view('backend.page-contents.create', ['pageContent' => $pageContent, 'isShown' => true]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PageContent $pageContent, Request $request)
    {
        return view('backend.page-contents.create', ['pageContent' => $pageContent, 'isShown' => false ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'page_type'  => 'required',
            'content'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                PageContent::createOrUpdatePageContent($request, $id);
//                $gasStation->gasStationEmployeeRoles()->detach();
            });
            Toastr::success('Page Content updated successfully.');
            return redirect(route('page-contents.index'));
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PageContent $pageContent)
    {
//        GasStationEmployee::find($id)->delete();

        $pageContent->delete();
        return back()->with('success', 'Page Content deleted successfully.');
    }
}
