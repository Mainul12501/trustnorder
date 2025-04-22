<?php

namespace App\Models\Backend\Order;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = [
        'order_id',
        'category_id',
        'product_id',
        'item_qty',
        'item_price',
        'item_total_price',
        'unit',
        'product_name',
    ];

    public static function createOrderDetails($request, $order)
    {
        $orderDetails = new OrderDetails();
        $orderDetails->order_id = $order->id;
//        $orderDetails->category_id  = $request->;
//        $orderDetails->product_id   = $request->;
//        $orderDetails->item_qty = $request->;
//        $orderDetails->item_price   = $request->;
//        $orderDetails->item_total_price = $request->;
        $orderDetails->save();
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
