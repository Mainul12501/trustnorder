<?php

namespace App\Http\Controllers\Backend\Product;

use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Backend\Product\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (isset($request->category))
        {
            $categories = Category::where('category_id', $request->category)->latest()->get();
        } else {
            $categories = Category::where('category_id', 0)->latest()->get();
        }
        return view('backend.product.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.product.category.create', ['category_id' => $request->category ?? 0 , 'isShown' => false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                $gasStation = Category::createOrUpdateCategory($request);
            });
            Toastr::success('Category created successfully.');
            return back();
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return ViewHelper::checkViewForApi(['category' => $category, 'isShown' => true, 'category_id' => $request->category ?? 0],'backend.product.category.create');
        return view('backend.product.category.create', ['category' => $category, 'isShown' => true, 'category_id' => $request->category ?? 0]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category, Request $request)
    {
//        return view('backend.home-slider.create', ['homeSlider' => $homePageSlider]);
        return view('backend.product.category.create', ['category' => $category, 'isShown' => false, 'category_id' => $request->get_category ?? 0]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                $gasStation = Category::createOrUpdateCategory($request, Category::find($id));
//                $gasStation->gasStationEmployeeRoles()->detach();
            });
            Toastr::success('Product Category updated successfully.');
            return redirect(route('categories.index'));
        } catch (\Exception $exception)
        {
            return back()->with('error', $exception->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
//        GasStationEmployee::find($id)->delete();

        $category->delete();
        return back()->with('success', 'Category deleted successfully.');
    }
}
