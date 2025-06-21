<?php

namespace App\Http\Controllers\Product;

use App\helper\ViewHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Order\Order;
use App\Models\Backend\Order\OrderDetails;
use App\Models\BasicSetting;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Mockery\Exception;
use Xenon\LaravelBDSms\Facades\SMS;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (isset($request->type) && $request->type == 'new')
        {
            $orders = Order::where('is_viewed', 0)->latest()->get();
        }
        elseif (isset($request->order_status))
        {
            $orders = Order::where('order_status', $request->order_status)->latest()->get();
        }
        else {
            $orders = Order::latest()->get();
        }
        return view('backend.product.orders.index', [
            'isShown'   => false,
            'orders'    => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request){
                $order = Order::createOrder($request);
            });
            return ViewHelper::returnSuccessMessage('Order Placed Successfully.');
        } catch (\Exception $exception)
        {
            return ViewHelper::returEexceptionError($exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $hasOrderDetails = false;
        $order->is_viewed = 1;
        $order->save();
        if (count($order->orderDetails) > 0 && $order->order_status != 'pending')
        {
            $hasOrderDetails = true;
        }
        return view('backend.product.orders.create', [
            'isShown'   => false,
            'order'    => $order,
            'hasOrderDetails'   => $hasOrderDetails,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        try {
//            DB::transaction(function () use ($request, $order) {
                if ($order->order_placing_method == 'image')
                {
                    $order->is_image_extracted  = 1;
                    $order->note    = $request->note;
                }
                $order->order_total = $request->order_total;
                $order->delivery_charge = $request->delivery_charge;
                $order->order_status = $request->order_status;
                $order->category_id    = $request->category_id;
                $order->order_payment_status    = $request->order_payment_status;
                $order->status = 1;
                $order->save();
                $order->orderDetails->each->delete();
                foreach ($request->products as $key => $product)
                {
                    $orderDetails = new OrderDetails();
                    $orderDetails->order_id = $order->id;
//            $orderDetails->category_id  = $request->;
//            $orderDetails->product_id   = $request->;
                    $orderDetails->product_name = $product['name'] ?? '';
                    $orderDetails->item_qty = $product['qty'] ?? 0;
                    $orderDetails->unit = $product['unit'] ?? '';
                    $orderDetails->item_price   = $product['price'] ?? 0;
                    $orderDetails->item_total_price = $product['total_price'] ?? 0;
                    $orderDetails->save();
                }
//            });
            SMS::shoot($order?->user?->mobile ?? '0000000000', "Order status changed to $order->order_status for order #$order->id");
            Toastr::success('Order Updated Successfully.');
            return redirect()->route('orders.index');
        } catch (\Exception $exception)
        {
            Toastr::error($exception->getMessage());
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        Toastr::success('Order Deleted successfully');
        return back();
    }

    public function getOrderFullDetails($orderId)
    {
        $order = Order::where('id', $orderId)->with(['user', 'orderDetails'])->first();
        return response()->json($order);
    }

    public function changeOrderStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->order_status    = $request->order_status;
        $order->save();
//        $this->sendOrderStatusNotification($order, $order->order_status);
        return response()->json(['status' => 'success']);
    }
    public function changeCancelReqOrderStatus(Request $request, Order $order)
    {
        try {
            $order->req_for_rejection_status    = $request->req_for_rejection_status;
            $order->save();
            if ($request->ajax())
            {
                return response()->json(['status' => 'success']);
            }
            else {
                Toastr::success('Status changed successfully');
                return back();
            }
        } catch (\Exception $exception)
        {
            return ViewHelper::returEexceptionError($exception->getMessage());
        }

    }

    public function sendOrderStatusNotification($order, $status = 'pending')
    {
        $title = 'Order status change';
        $msg = '';
        if ($status == 'accepted')
        {
            $msg = "Your order $order->id is accepted by the admin.";
        } elseif ($status == 'processing')
        {
            $msg = "Your order $order->id is accepted by the admin.";
        } elseif ($status == 'processing')
        {
            $msg = "Admin is processing your order $order->id";
        } elseif ($status == 'on_delivery')
        {
            $msg = "Your products for order $order->id are out for delivery.";
        } elseif ($status == 'completed')
        {
            $msg = "Your order $order->id is complete. Thanks for shopping from us.";
        } elseif ($status == 'rejected')
        {
            $msg = "Your order $order->id request is rejected by the admin.";
        }
        $notificationArray = ['title' => $title, 'body' => $msg];
        ViewHelper::sendNotification($notificationArray);

    }

    public function generateInvoice(Request $request, Order $order)
    {
        return view('backend.product.orders.invoice', [
            'order' => $order,
            'basicSetting'  => BasicSetting::first(),
        ]);
    }

    public function orderHistory(User $user)
    {
        $orders = Order::where('user_id', $user->id)->with('user', 'orderDetails')->latest()->paginate(20);
        return response()->json([
            'orders'    => $orders
        ]);
    }
    public function registeredUserOrderHistory(Request $request)
    {
        $orders = Order::query()->where('user_id', ViewHelper::loggedUser()->id)->with('user', 'orderDetails');
        if (isset($request->order_status))
        {
            $orders = $orders->where('order_status', $request->order_status);
        }
            $orders = $orders->latest()->paginate(20);
        return response()->json([
            'orders'    => $orders
        ]);
    }

    public function reqForOrderRejection(Request $request, Order $order)
    {
        if ($order->is_req_for_rejection == 1)
        {
            return response()->json([
                'status'    => 'error',
                'message'   => 'You have already sent a request for order rejection.',
            ]);
        }
        try {
            $order->is_req_for_rejection = 1;
            $order->req_for_rejection_status = 'pending';
            $order->save();
            return response()->json([
                'status'    => 'success',
                'message'   => 'Request for order rejection sent successfully.'
            ]);
        } catch (Exception $exception) {
            return response()->json([
                'status'    => 'error',
                'message'   => $exception->getMessage(),
            ]);
        }

    }
}
