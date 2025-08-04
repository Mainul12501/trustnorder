@extends('backend.master')

@section('title', 'Order '.isset($order) ? 'Update' : 'Create')
@section('breadcrumb', 'Order '.isset($order) ? 'Update' : 'Create')

@section('body')

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">User Details</h4>
                </div>
                <div class="card-body">
                    <div>
                        <p>Name: {{ $order?->user?->name ?? 'User Name' }}</p>
                        <p>Mobile: <a href="tel:{{ $order?->user?->mobile ?? '' }}" class="">{{ $order?->user?->mobile ?? 'User Mobile' }}</a></p>
                        <p>
                            Address:
                            {{ isset($order?->user?->floor) ? $order?->user?->floor.' th floor' : ''  }},
                            {{ $order?->user?->building_address ?? ''  }},
                            road: {{ $order?->user?->road ?? ''  }}, <br>
                            {{ $order?->user?->area?->area_name ?? ''  }},
                            {{ $order?->user?->area?->district?->district_name ?? ''  }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row py-5">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">Order {{ isset($order) ? 'Update' : 'Create' }}</h4>
                    <a href="{{ route('orders.index') }}" class="text-white float-end f-s-20">
                        <i class="mdi mdi-page-previous-outline"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.update', $order->id)  }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($order))
                            @method('put')
                        @endif

                        <div>
                            <input type="hidden" name="category_id" value="{{ $order->category_id ?? null }}" />
                            @if($hasOrderDetails)
                                @if($order->orderDetails)
                                    @foreach($order->orderDetails as $key => $itemProduct)
                                        <div class="row item-products mt-3 shadow pb-3" data-row="{{$key}}">
                                            <div class="col-md-4">
                                                <label for="itemProductName{{$key}}">Product Name</label>
                                                <input type="text" name="products[{{$key}}][name]" value="{{ isset($itemProduct) ? ($itemProduct->product_name ?? '') : '' }}" {{--id="itemProductName{{$key}}"--}} readonly class="form-control" placeholder="Product Name" />
                                            </div>
                                            <div class="col-md-2">
                                                <label for="itemProductQty{{$key}}">Product Qty</label>
                                                <input type="number" min="0" name="products[{{$key}}][qty]" {{--id="itemProductQty{{$key}}"--}} readonly  value="{{ isset($itemProduct) ? $itemProduct->item_qty : '' }}" class="form-control product-qty" placeholder="Product Qty" />
                                            </div>
                                            <div class="col-md-2">
                                                <label for="productName{{$key}}">Unit</label>
                                                <select name="products[{{$key}}][unit]" class="form-control  item-unit" {{--id="itemProductUnit{{$key}}"--}} disabled>
                                                    <option value="Kg" {{ isset($itemProduct->unit) && $itemProduct->item_unit == 'Kg' ? 'selected' : '' }}>Kg</option>
                                                    <option value="Gram" {{ isset($itemProduct->unit) && $itemProduct->item_unit == 'Gram' ? 'selected' : '' }} >Gram</option>
                                                    <option value="Piece" {{ isset($itemProduct->unit) && $itemProduct->item_unit == 'Piece' ? 'selected' : '' }} >Piece</option>
                                                    <option value="Liter" {{ isset($itemProduct->unit) && $itemProduct->item_unit == 'Liter' ? 'selected' : '' }} >Liter</option>
                                                    <option value="Millilitre" {{ isset($itemProduct->unit) && $itemProduct->item_unit == 'Millilitre' ? 'selected' : '' }} >Millilitre</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <label for="productName{{$key}}">Product Price</label>
                                                <input type="number" min="0" name="products[{{$key}}][price]" {{--id="itemProductPrice{{$key}}"--}} readonly value="{{ $hasOrderDetails && $order->order_status != 'pending' ? $itemProduct->item_price : 0 }}" class="form-control product-price" placeholder="Product Price" />
                                            </div>
                                            <div class="col-md-2">
                                                <label for="productName{{$key}}">Total Price</label>
                                                <input type="number" min="0" name="products[{{$key}}][total_price]" {{--id="itemProductTotalPrice{{$key}}"--}}  value="{{ $hasOrderDetails && $order->order_status != 'pending' ? $itemProduct->item_price * $itemProduct->item_qty : 0 }}" class="form-control product-total-price" readonly placeholder="Total Price" />
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-3">
                                <label for="">Delivery Charge</label>
                                <input type="number" min="0" name="delivery_charge" class="form-control"  {{--id="deliveryCharge"--}} value="{{ $hasOrderDetails && $order->order_status != 'pending' ? $order->delivery_charge : 0 }}" placeholder="Delivery Charge" />
                            </div>
                            <div class="col-md-3">
                                <label for="">Grand Total</label>
                                <input type="number" name="order_total" class="form-control" id="grandTotal" value="{{ $hasOrderDetails && $order->order_status != 'pending' ? $order->order_total : 0 }}" placeholder="Grand Total" readonly />
                            </div>
{{--                            <div class="col-md-3">--}}
{{--                                <label for="">Order Status</label>--}}
{{--                                <select name="order_status" class="form-control  w-100" id="">--}}
{{--                                    <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>--}}
{{--                                    <option value="accepted" {{ $order->order_status == 'accepted' ? 'selected' : '' }}>Accepted</option>--}}
{{--                                    <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>--}}
{{--                                    <option value="on_delivery" {{ $order->order_status == 'on_delivery' ? 'selected' : '' }}>Our For Delivery</option>--}}
{{--                                    <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>--}}
{{--                                    <option value="rejected" {{ $order->order_status == 'rejected' ? 'selected' : '' }}>Rejected</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}
                            <input type="hidden" name="order_status" value="{{ $order->order_status == 'pending' ? 'accepted' : $order->order_status }}" />
                            <div class="col-md-3">
                                <label for="">Payment Status</label>
                                <select name="order_payment_status" class="form-control  w-100" id="">
                                    <option value="DUE" {{ $order->order_payment_status == 'DUE' ? 'selected' : '' }}>DUE</option>
                                    <option value="PAID" {{ $order->order_payment_status == 'PAID' ? 'selected' : '' }}>PAID</option>
                                </select>
                            </div>
                        </div>

                        @if(!$isShown)
                        <div class="mt-3">
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($order) ? 'Update' : 'Create' }} Order" />
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('script')
    @include('backend.includes.asset.plugin-files.select-2')
    <!--tinymce js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.3.2/tinymce.min.js" integrity="sha512-9w/jRiVYhkTCGR//GeGsRss1BJdvxVj544etEHGG1ZPB9qxwF7m6VAeEQb1DzlVvjEZ8Qv4v8YGU8xVPPgovqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        tinymce.init({
            selector: 'textarea',
            height: 200,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });


    </script>

    <script>
        $(function () {
            var rowSerial = 1;
            $(document).on('click', '.add-row', function () {
                var div = '';
                div += `<div class="row mt-3 shadow pb-3" data-row="${rowSerial}">
                                    <div class="col-md-3">
                                        <label for="itemProductName${rowSerial}">Product Name</label>
                                        <input type="text" name="products[${rowSerial}][name]" id="itemProductName${rowSerial}" class="form-control" placeholder="Product Name" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="itemProductQty${rowSerial}">Product Qty</label>
                                        <input type="number" min="0" name="products[${rowSerial}][qty]" id="itemProductQty${rowSerial}" class="form-control product-qty" placeholder="Product Qty" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="itemProductUnit${rowSerial}">Unit</label>
                                        <select name="products[${rowSerial}][unit]" class="form-control  item-unit" id="itemProductUnit${rowSerial}">
                                            <option value="Kg">Kg</option>
                                            <option value="Gram">Gram</option>
                                            <option value="Piece">Piece</option>
                                            <option value="Liter">Liter</option>
                                            <option value="Millilitre">Millilitre</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="itemProductPrice${rowSerial}">Product Price</label>
                                        <input type="number" min="0" name="products[${rowSerial}][price]" id="itemProductPrice${rowSerial}" class="form-control product-price" placeholder="Product Price" />
                                    </div>
                                    <div class="col-md-2">
                                        <label for="itemProductTotalPrice${rowSerial}">Total Price</label>
                                        <input type="number" min="0" readonly id="itemProductTotalPrice${rowSerial}" name="products[${rowSerial}][total_price]" class="form-control product-total-price" placeholder="Total Price" />
                                    </div>
                                    <div class="col-md-1">
                                        <label for="">Action</label>
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-success add-row">+</a>
                                            <a href="javascript:void(0)" class="btn btn-danger delete-row">-</a>
                                        </div>
                                    </div>
                                </div>`;
                $('#appendRow').append(div);
                ++rowSerial;
            })
            $(document).on('click', '.delete-row', function () {
                $(this).closest('.row').remove();
            })
        })
    </script>
    <script>
        $(function () {
            $(document).on('keyup', '.product-price', function () {
                var rowSerial = $(this).closest('.row').attr('data-row');
                getSingleProductTotalPrice(rowSerial);
            });
            $(document).on('keyup', '.product-qty', function () {
                var rowSerial = $(this).closest('.row').attr('data-row');
                getSingleProductTotalPrice(rowSerial);
            });
            $(document).on('keyup', '#deliveryCharge', function () {
                getGrandTotal();
            });
            $(document).on('change', '.item-unit', function () {
                var rowSerial = $(this).closest('.row').attr('data-row');
                getSingleProductTotalPrice(rowSerial);
            });
        })

        function getSingleProductTotalPrice(rowSerial) {
            var itemProductPrice = parseFloat($('#itemProductPrice'+rowSerial).val());
            var itemProductQty = parseInt($('#itemProductQty'+rowSerial).val());
            var itemProductUnit = $('#itemProductUnit'+rowSerial).val();
            var productPriceTotal = 0;
            if (itemProductUnit == 'Gram')
            {
                productPriceTotal = itemProductPrice * (itemProductQty / 1000);
            } else {
                productPriceTotal   = itemProductPrice * itemProductQty;
            }
            $('#itemProductTotalPrice'+rowSerial).val( productPriceTotal );
            getGrandTotal();
        }
        function getGrandTotal() {
            var deliveryCharge = Number($('#deliveryCharge').val());
            var grandTotal = 0;
            $.each($('.product-total-price'), function (key, ele) {
                grandTotal += Number($(ele).val());
            })
            $('#grandTotal').val(grandTotal+deliveryCharge);
        }
    </script>

@endpush
