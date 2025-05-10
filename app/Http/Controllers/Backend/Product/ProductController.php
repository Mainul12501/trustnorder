<?php

namespace App\Http\Controllers\Backend\Product;

use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Backend\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->type == 'regular')
        {
            $products = Product::orderBy('id', 'desc')->where(['is_discounted' => 0, 'is_featured' => 0])->orderBy('id', 'desc')->get();
        }
        elseif ($request->type == 'discounted')
        {
            $products = Product::where(['status' => 1, 'is_discounted' => 1])->orderBy('id', 'desc')->get();
        }
        elseif ($request->type == 'featured')
        {
            $products = Product::where(['status' => 1, 'is_featured' => 1])->orderBy('id', 'desc')->get();
        }
        else {
            $products = Product::where(['status' => 1])->orderBy('id', 'desc')->get();
        }
        return view('backend.product.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('backend.product.products.create', ['isShown' => false, 'categories' => Product\Category::where(['status' => 1])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'  => 'required',
            'product_name'  => 'required',
        ]);
        try {
            DB::transaction(function () use ($request){
                Product::createOrUpdateProduct($request);
            });
            Toastr::success('Product created successfully.');
            return redirect(isset($request->redirect_url) ? $request->redirect_url : route('products.index'));
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product, Request $request)
    {
        if (str()->contains(url()->current(), '/api/'))
        {
            $product->sub_images = json_decode($product->sub_images);
        }
        return ViewHelper::checkViewForApi(['product' => $product, 'isShown' => true, 'categories' => Product\Category::where(['status' => 1])->get()],'backend.product.products.create');
        return view('backend.product.products.create', ['product' => $product, 'isShown' => true, 'categories' => Product\Category::where(['status' => 1])->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, Request $request)
    {
        return view('backend.product.products.create', ['product' => $product, 'isShown' => false, 'categories' => Product\Category::where(['status' => 1])->get()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category_id'  => 'required',
            'product_name'  => 'required',
        ]);

        try {
            DB::transaction(function () use ($request, $id){
                Product::createOrUpdateProduct($request, $id);
            });
            Toastr::success('Product updated successfully.');
            return redirect(isset($request->redirect_url) ? $request->redirect_url : route('products.index'));
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
//        GasStationEmployee::find($id)->delete();

        $product->delete();
        return back()->with('success', 'Product deleted successfully.');
    }
}
