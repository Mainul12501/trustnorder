@extends('backend.master')

@section('title', 'Product '.isset($product) ? 'Update' : 'Create')
@section('breadcrumb', 'Product '.isset($product) ? 'Update' : 'Create')

@section('body')

    <div class="row py-5">
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">Product {{ isset($product) ? 'Update' : 'Create' }}</h4>
                    <a href="{{ route('products.index', ['type' => $_GET['type'] ?? 'regular']) }}" class="text-white float-end f-s-20">
                        <i class="mdi mdi-page-previous-outline"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($product))
                            @method('put')
                        @endif
                        <input type="hidden" name="redirect_url" value="{{ isset($_GET['type']) ? route('products.index', ['type' => $_GET['type']]) : route('products.index') }}">
                        @if(isset($_GET['type']) && $_GET['type'] == 'discounted')
                            <input type="hidden" name="is_discounted" value="{{ isset($product) ? $product->is_discounted : 1 }}">
                        @endif
                        @if(isset($_GET['type']) && $_GET['type'] == 'featured')
                            <input type="hidden" name="is_featured" value="{{ isset($product) ? $product->is_featured : 1 }}">
                        @endif
                        <div class="mt-2">
                            @if(isset($_GET['category']))
                                <input type="hidden" name="category_id" value="{{ isset($product)?$product->category_id : $_GET['category'] }}" />
                            @elseif(isset($_GET['type']) && ($_GET['type'] == 'featured') || $_GET['type'] == 'discounted')
                                <input type="hidden" name="category_id" value="{{ isset($product)?$product->category_id : \App\Models\Backend\Product\Category::first()->id }}" />
                            @else
                                <label for="">Category Name <span class="text-danger">(required)</span></label>
                                <select name="category_id" class="form-control select2 w-100" id="" {{ $isShown ? 'disabled' : '' }} >
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }} >{{ $category->name ?? '' }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="mt-2">
                            <label for="">Product Name <span class="text-danger">(required)</span></label>
                            <input type="text" name="product_name" {{ $isShown ? 'readonly' : '' }} class="form-control" value="{{ isset($product) ? $product->product_name : '' }}" />
                        </div>
                        <div class="mt-2">
                            <label for="">Description</label>
                            <textarea name="description" {{ $isShown ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($product) ? $product->description : '' !!}</textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">
                                <label for="">Price</label>
                                <input type="number" name="price" min="0" {{ $isShown ? 'readonly' : '' }}  class="form-control" value="{{ isset($product) ? $product->price : '' }}" />
                            </div>
                            @if(isset($_GET['type']) && $_GET['type'] == 'discounted')
                                <div class="col-md-4">
                                    <label for="">Discounted Price</label>
                                    <input type="number" name="discounted_price" min="0" {{ $isShown ? 'readonly' : '' }}  class="form-control" value="{{ isset($product) ? $product->discounted_price : '' }}" />
                                </div>
                            @endif
{{--                            <div class="col-md-5">--}}
{{--                                <label for="">Available Stock</label>--}}
{{--                                <input type="number" name="available_stock" min="0" {{ $isShown ? 'readonly' : '' }}  class="form-control" value="{{ isset($product) ? $product->available_stock : '' }}" />--}}
{{--                            </div>--}}
                            <div class="col-md-2">
                                <label for="">Select Unit Type</label>
                                <select name="unit_name" class="form-control" id="" {{ $isShown ? 'disabled' : '' }} >
                                    <option value="Kg" {{ isset($product) && $product->category_id == 'Kg' ? 'selected' : '' }} >Kg</option>
                                    <option value="Gram" {{ isset($product) && $product->category_id == 'Gram' ? 'selected' : '' }} >Gram</option>
                                    <option value="Piece" {{ isset($product) && $product->category_id == 'Piece' ? 'selected' : '' }} >Piece</option>
                                    <option value="Liter" {{ isset($product) && $product->category_id == 'Liter' ? 'selected' : '' }} >Liter</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label for="">Main Image</label> <br>
                                <input type="file" class="" name="main_image" accept="image/*" />
                                @if(isset($product))
                                    <img src="{{ asset($product->main_image) }}" alt="" style="height: 60px" />
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="">Sub Images</label> <br>
                                <input type="file" class="" name="sub_images[]" accept="image/*" multiple />
                                @if(isset($product))
                                    @if(isset($product->sub_images))
                                        @foreach(json_decode($product->sub_images) as $image)
                                            <img src="{{ asset($image) }}" alt="" style="height: 50px; margin-right: 8px" />
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="row mt-2">
{{--                            <div class="col-md-6">--}}
{{--                                <label for="">Featured Status</label>--}}
{{--                                <div>--}}
{{--                                    <div class="material-switch">--}}
{{--                                        <input id="someSwitchOptionInfo" name="is_featured" {{ $isShown ? 'disabled' : '' }}  class="form-check-input success check-outline outline-success" type="checkbox" {{ isset($product) && $product->is_featured == 1 ? 'checked' : '' }} />--}}
{{--                                        <label for="someSwitchOptionInfo" class="label-primary"></label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6">
                                <label for="">Active</label>
                                <div>
                                    <div class="material-switch">
                                        <input id="someSwitchOptionInfo" name="status" {{ $isShown ? 'disabled' : '' }}  class="form-check-input success check-outline outline-success" type="checkbox" {{ isset($product) && $product->status == 0 ? '' : 'checked' }} />
                                        <label for="someSwitchOptionInfo" class="label-info"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(!$isShown)
                        <div>
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($product) ? 'Update' : 'Create' }} Product" />
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
@endpush
