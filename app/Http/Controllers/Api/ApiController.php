<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Backend\Product;
use App\Models\Backend\Product\Category;
use App\Models\BasicSetting;
use App\Models\District;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getActiveCategories(Request $request)
    {
        return response()->json([
            'categories'    => Category::where(['status' => 1, 'category_id' => 0])->get(),
        ]);
    }
    public function getActiveSubCategories(Category $category)
    {
        return response()->json([
            'categories'    => Category::where(['status' => 1, 'category_id' => $category->id])->get(),
        ]);
    }
    public function getActiveDistricts(Request $request)
    {
        return response()->json([
            'districts'    => District::where(['status' => 1])->get(),
        ]);
    }
    public function getActiveAreasByDistrict($districtId)
    {
        return response()->json([
            'areas'    => Area::where(['status' => 1, 'district_id' => $districtId])->get(),
        ]);
    }
    public function getActiveProductsByCategory($categoryId)
    {
        return response()->json([
            'products'    => Product::where(['status' => 1, 'category_id' => $categoryId])->get(),
        ]);
    }
    public function getActiveProducts(Request $request)
    {
        $products = Product::query()->where(['status' => 1, 'is_featured' => 0, 'is_discounted' => 0]);
        if (isset($request->search))
        {
            $products = $products->where(function ($query) use ($request) {
                $query->where('product_name', 'LIKE', "%$request->search%")
                    ->orWhereHas('category', function ($categoryQuery) use ($request) {
                        $categoryQuery->where('name', 'LIKE', "%$request->search%");
                    });
            });
        }
        if (isset($request->category))
        {
            $products = $products->where(['category_id' => $request->category]);
        }
//        if (isset($request->is_featured))
//        {
//            $products = $products->where(['is_featured' => 1]);
//        }

        $products = $products->paginate(20);
        foreach ($products as $product)
        {
            $product->sub_images = json_decode($product->sub_images);
        }
        return response()->json([
            'products'    => $products,
        ]);
    }

    public function getActiveFeaturedProducts(Request $request)
    {
        $products = Product::query()->where(['status' => 1, 'is_featured' => 1, 'is_discounted' => 0]);
        if (isset($request->search))
        {
            $products = $products->where(function ($query) use ($request) {
                $query->where('product_name', 'LIKE', "%$request->search%")
                    ->orWhereHas('category', function ($categoryQuery) use ($request) {
                        $categoryQuery->where('name', 'LIKE', "%$request->search%");
                    });
            });
        }
        if (isset($request->category))
        {
            $products = $products->where(['category_id' => $request->category]);
        }
//        if (isset($request->is_featured))
//        {
//            $products = $products->where(['is_featured' => 1]);
//        }

        $products = $products->paginate(20);
        foreach ($products as $product)
        {
            $product->sub_images = json_decode($product->sub_images);
        }
        return response()->json([
            'products'    => $products,
        ]);
    }

    public function getActiveDiscountedProducts(Request $request)
    {
        $products = Product::query()->where(['status' => 1, 'is_featured' => 0, 'is_discounted' => 1]);
        if (isset($request->search))
        {
            $products = $products->where(function ($query) use ($request) {
                $query->where('product_name', 'LIKE', "%$request->search%")
                    ->orWhereHas('category', function ($categoryQuery) use ($request) {
                        $categoryQuery->where('name', 'LIKE', "%$request->search%");
                    });
            });
        }
        if (isset($request->category))
        {
            $products = $products->where(['category_id' => $request->category]);
        }
//        if (isset($request->is_featured))
//        {
//            $products = $products->where(['is_featured' => 1]);
//        }

        $products = $products->paginate(20);
        foreach ($products as $product)
        {
            $product->sub_images = json_decode($product->sub_images);
        }
        return response()->json([
            'products'    => $products,
        ]);
    }

    public function getBasicSettings(Request $request)
    {
        return response()->json(BasicSetting::first());
    }
}
