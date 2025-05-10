@extends('backend.master')

@section('title', 'Orders')
@section('breadcrumb', 'Orders')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-info">
                        <h4 class="text-white float-start">Orders</h4>
{{--                        @can('create-permission-category')--}}
{{--                            <a href="{{  route('orders.create') }}" class="rounded-circle float-end text-white text-light f-s-20 ">--}}
{{--                                <span class="f-s-22 border-5"><i class="mdi mdi-plus-circle-outline"></i></span>--}}
{{--                            </a>--}}
{{--                        @endcan--}}
                    </div>
                    <div class="card-body ">
                        @if(!isset($_GET['type']))
                            <div class="text-center pb-3">
                                <a href="{{ route('orders.index', ['order_status' => 'pending']) }}" class="btn btn-primary">Pending</a>
                                <a href="{{ route('orders.index', ['order_status' => 'accepted']) }}" class="btn btn-primary">Accepted</a>
                                <a href="{{ route('orders.index', ['order_status' => 'processing']) }}" class="btn btn-primary">Processing</a>
                                <a href="{{ route('orders.index', ['order_status' => 'on_delivery']) }}" class="btn btn-primary">Our For Delivery</a>
                                <a href="{{ route('orders.index', ['order_status' => 'completed']) }}" class="btn btn-primary">Completed</a>
                                <a href="{{ route('orders.index', ['order_status' => 'rejected']) }}" class="btn btn-primary">Rejected</a>
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table responsive dt-responsive table-responsive"  id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Id</th>
                                    <th>Method</th>
                                    <th>Ordered Items</th>
                                    <th>Note</th>
                                    <th>Cancel Req Status</th>
                                    <th>Order Status</th>
                                    <th>Payment Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_placing_method ?? '' }}</td>
                                         <td>
                                             @if($order->order_placing_method == 'image')
                                                 @php
                                                     $userOrderImages = json_decode($order->user_order_image);
                                                 @endphp
                                                 @if(!is_null($order->user_order_image))
                                                     @if(!empty($userOrderImages) && is_array($userOrderImages) && count($userOrderImages) > 0)
                                                         @foreach($userOrderImages as $imgKey => $img)
                                                             <span class="m-1">
                                                                <a href="{{ route('orders.edit', $order->id) }}"><img src="{{ asset($img) }}" alt="" style="height: 80px" /></a>
                                                            </span>
                                                         @endforeach
                                                     @endif

                                                 @endif

                                             @elseif($order->order_placing_method == 'items')
                                                 <div>
                                                     @if(isset($order->orderDetails) && count($order->orderDetails) > 0)
                                                         <ol class="">
                                                             @foreach($order->orderDetails as $key => $item)
                                                                 @if($key > 2)
                                                                     <li class="nav-item mt-1">have more {{ count($order->orderDetails) -3 }} products.</li>
                                                                     @break
                                                                 @else
                                                                     <li class="nav-item mt-1">{{ $item->product_name }}</li>
                                                                 @endif
                                                             @endforeach
                                                         </ol>

                                                     @else
                                                         @if(isset($order->user_inputed_items))
                                                             <ol class="">
                                                                 @php
                                                                     $userItems = json_decode($order->user_inputed_items);
                                                                 @endphp
                                                                 @if (!empty($userItems) && is_array($userItems) && count($userItems) > 0)
                                                                     @foreach($userItems as $key => $item)
                                                                         @if($key > 2)
                                                                             <li class="nav-item mt-1">have more {{ count($userItems) -3 }} products.</li>
                                                                             @break
                                                                         @else
                                                                             <li class="nav-item mt-1">{{ $item->name }}</li>
                                                                         @endif
                                                                     @endforeach
                                                                 @endif
                                                             </ol>
                                                         @endif
                                                     @endif
                                                 </div>
                                             @endif
                                         </td>

                                        <td>{!! str()->words(strip_tags($order->note), 50) ?? '' !!}</td>
                                        <td>
                                            @if($order->is_req_for_rejection == 1)
                                                <form action="{{ route('change-cancel-req-order-status', $order->id) }}" method="post">
                                                    @csrf
                                                    <select name="req_for_rejection_status" id="" class="form-control req_for_rejection_status_form" {{ $order->req_for_rejection_status != 'pending' ? 'disabled' : '' }} >
                                                        <option value="pending" {{ $order->req_for_rejection_status == 'pending' ? 'selected' : '' }} >Pending</option>
                                                        <option value="approved" {{ $order->req_for_rejection_status == 'approved' ? 'selected' : '' }} >Approved</option>
                                                        <option value="canceled" {{ $order->req_for_rejection_status == 'canceled' ? 'selected' : '' }} >Canceled</option>
                                                    </select>
                                                </form>
                                            @endif
                                        </td>

                                        <td>
{{--                                            <select name="order_status" class="form-control change-order-status" data-id="{{ $order->id }}" id="">--}}
{{--                                                <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>--}}
{{--                                                <option value="accepted" {{ $order->order_status == 'accepted' ? 'selected' : '' }}>Accepted</option>--}}
{{--                                                <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>--}}
{{--                                                <option value="on_delivery" {{ $order->order_status == 'on_delivery' ? 'selected' : '' }}>Our For Delivery</option>--}}
{{--                                                <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>--}}
{{--                                                <option value="rejected" {{ $order->order_status == 'rejected' ? 'selected' : '' }}>Rejected</option>--}}
{{--                                            </select>--}}
                                            {{ $order->order_status ?? '' }}
                                        </td>
                                        <td>
                                            <p class="mb-0">Type: <span>{{ $order->order_payment_type ?? '' }}</span>
                                            <p>Status: <span>{{ $order->order_payment_status ?? '' }}</span>
                                        </td>
                                        <td class="">
                                            @if($order->status == 1 && $order->order_status != 'pending')
                                                <a href="{{ route('orders.generate-invoice', $order->id) }}" class="btn btn-sm btn-primary mt-1" title="Generate Invoice">
                                                    <i class="mdi mdi-file-document"></i>
                                                </a> <br>
                                            @endif

                                            <a href="{{ route('orders.edit', $order->id ) }}" class="btn btn-sm btn-warning mt-1">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a> <br>

                                            <form class="d-inline" action="{{ route('orders.destroy', $order->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger delete-data mt-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/font-awesome.min.css">
{{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">--}}
@endpush

@push('script')

@include("backend.includes.asset.plugin-files.datatable")
{{--<link rel="stylesheet" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">--}}
{{--<script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>--}}
<script>
    // let table = new DataTable('#dataTable');
    // $('#dataTable').DataTable( {
    //     responsive: true
    // } );
</script>
@include("backend.includes.asset.plugin-files.sweet-alert-2")

<script>
    $(document).on('change', '.change-order-status', function () {
        var orderId = $(this).attr('data-id');
        $.ajax({
            url: "{{ route('change-order-status') }}",
            method: "POST",
            data: {order_id: orderId, order_status:$(this).val()},
            success: function (data) {
                if (data.status == 'success')
                {
                    toastr.success('Order Status Changed Successfully.');
                    location.reload();
                } else {
                    toastr.error('We faced some issue during Order Status Change. Please Try again');
                }
            },
            errors: function (error) {
                toastr.error('Something went wrong. Please Try again');
            }
        })
    })
    $(document).on('change', '.req_for_rejection_status_form', function () {
        $(tihs).closest('form').submit();
    })
</script>

@endpush
