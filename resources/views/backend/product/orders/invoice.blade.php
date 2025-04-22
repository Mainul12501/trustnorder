
@extends('backend.master')
@section('title', 'Order Invoice')
@section('breadcrumb', 'Order Invoice')

@section('body')
    <div class="row py-5">
        <div class="col-md-10 mx-auto">
            <div class="row mt-3">
                <div class="col-md-12 text-end">
                    <button type="button" class="btn btn-primary " id="printInvoiceBtn">Download Invoice</button>
                </div>
            </div>
            <div id="printInvoice">
                <!-- Invoice 1 - Bootstrap Brain Component -->
                <div class="py-3 py-md-5">
                    <div class="card card-body">
                        <div class="row justify-content-center">
                            <div class="col-12 col-lg-9 col-xl-8 col-xxl-7">
                                <div class="row gy-3 mb-3">
                                    <div class="col-12">
                                        <h2 class="text-uppercase text-center m-0">Invoice</h2>
                                    </div>
                                    <div class="col-6">
                                        <h4>From</h4>
                                        <address>
                                            <strong>{{ $basicSetting->site_title ?? 'Shop Name' }}</strong><br>
                                            <span>{!! $basicSetting->address ?? '' !!}</span>
                                            <span>Phone: {{ $basicSetting->phone ?? '015XXXXXXXX' }}</span><br>
                                            <span>Email: {{ $basicSetting->email ?? 'email@domain.com' }}</span>
                                        </address>
                                    </div>
                                    <div class="col-6">
                                        <a class="d-block text-end" href="#!">
                                            <img src="{{ isset($basicSetting->logo) ? asset($basicSetting->logo) : 'https://png.pngtree.com/png-clipart/20230330/original/pngtree-modern-demo-logo-vector-file-png-image_9012000.png' }}" class="img-fluid" alt="BootstrapBrain Logo" width="135" height="44">
                                        </a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-sm-6 col-md-8">
                                        <h4>Bill To</h4>
                                        <address>
                                            <strong>{{ $order?->user?->name ?? 'Customer Name' }}</strong><br>
{{--                                            7657 NW Prairie View Rd<br>--}}
{{--                                            Kansas City, Mississippi, 64151<br>--}}
{{--                                            United States<br>--}}
                                            <span>
                                                {{ isset($order?->user?->floor) ? $order?->user?->floor.'th floor' : '' }},
                                                {{ isset($order?->user?->building_address) ? $order?->user?->building_address : '' }} <br>
                                                {{ isset($order?->user?->road_number) ? 'road '.$order?->user?->road_number : '' }},
                                                {{ isset($order?->user?->area?->area_name) ? $order?->user?->area?->area_name : '' }} <br>
                                                {{ isset($order?->user?->area?->district?->district_name) ? $order?->user?->area?->district?->district_name : '' }}

                                            </span>


                                            <span>Phone: {{ $order?->user?->mobile ?? '015XXXXXXX' }}</span><br>
                                        </address>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <h4 class="row">
                                            <span class="col-6">Invoice #</span>
                                            <span class="col-6 text-sm-end">INT-{{ $order->id }}</span>
                                        </h4>
                                        <div class="row">
                                            <span class="col-6">Account</span>
                                            <span class="col-6 text-sm-end">{{ $order->order_total ?? 0 }}</span>
                                            <span class="col-6">Order ID</span>
                                            <span class="col-6 text-sm-end">#{{ $order->id }}</span>
                                            <span class="col-6">Invoice Date</span>
                                            <span class="col-6 text-sm-end">{{ now()->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th scope="col" class="text-uppercase">Product</th>
                                                    <th scope="col" class="text-uppercase">Qty</th>
                                                    <th scope="col" class="text-uppercase text-end">Unit Price</th>
                                                    <th scope="col" class="text-uppercase text-end">Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody class="table-group-divider">
                                                @foreach($order->orderDetails as $key => $orderDetail)
                                                    <tr>
                                                        <td>{{ $orderDetail->product_name ?? 'Product name' }}</td>
                                                        <th scope="row">{{ $orderDetail->item_qty ?? 0 }}</th>
                                                        <td class="text-end">{{ $orderDetail->item_price ?? 0 }}</td>
                                                        <td class="text-end">{{ $orderDetail->item_total_price ?? 0 }}</td>
                                                    </tr>
                                                @endforeach

{{--                                                <tr>--}}
{{--                                                    <th scope="row">1</th>--}}
{{--                                                    <td>Planet - Bootstrap Blog Template</td>--}}
{{--                                                    <td class="text-end">29</td>--}}
{{--                                                    <td class="text-end">29</td>--}}
{{--                                                </tr>--}}
                                                <tr>
                                                    <td colspan="3" class="text-end">Subtotal</td>
                                                    <td class="text-end">{{ $order->order_total - $order->delivery_charge ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3" class="text-end">Delivery Cost</td>
                                                    <td class="text-end">{{ $order->delivery_charge ?? 0 }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row" colspan="3" class="text-uppercase text-end">Total</th>
                                                    <td class="text-end">BDT {{ $order->order_total ?? 0 }}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
{{--                                <div class="row">--}}
{{--                                    <div class="col-12 text-end">--}}
{{--                                        <button type="submit" class="btn btn-primary mb-3">Download Invoice</button>--}}
{{--                                        <button type="submit" class="btn btn-danger mb-3">Submit Payment</button>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">
@endpush
@push('script')
    <script src=" https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <script>
        $(document).on('click', '#printInvoiceBtn', function () {
            printJS({
                printable: "printInvoice",
                type: "html",
                css: "{{ url('/backend/dist/css/style.css') }}",
                scanStyles: true,
                {{--header: "Order-{{ $order->id }}"--}}
            })
        })
    </script>
@endpush

