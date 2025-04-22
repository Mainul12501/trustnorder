<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'category_id', 'status', 'image', 'description'];


    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($category) {
            if (file_exists($category->image))
            {
                unlink($category->image);
            }
            if ($category->categories)
            {
                $category->categories()->delete();
            }
            if (isset($category->products) && count($category->products) > 0)
            {
                $category->products->each->delete();
            }
        });
    }

    public static function createOrUpdateCategory($request, $category = null)
    {
        if ($category == null)
        {
            $category = new Category();
        }
        $category->name = $request->name;
        $category->image = imageUpload($request->file('image'), 'product/category', 'category-', 300, 300, $category->image ?? null);
        $category->description = $request->description;
        $category->category_id = $request->category_id;
        $category->status = $request->status == 'on' ? 1 : 0;
        $category->save();
        return $category;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
