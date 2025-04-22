@extends('backend.master')

@section('title', 'Category Create')
@section('breadcrumb', 'Category Create')

@section('body')

    <div class="row py-5">
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">Category Create</h4>
                    <a href="{{ isset($_GET['category']) ? route('categories.index', ['category' => $_GET['category']]) : route('categories.index') }}" class="text-white float-end f-s-20">
                        <i class="mdi mdi-page-previous-outline"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($category))
                            @method('put')
                        @endif
                        <input type="hidden" name="category_id" value="{{ $category_id }}" />
                        <div>
                            <label for="">Category Name <span class="text-danger">(required)</span></label>
                            <input type="text" name="name" {{ $isShown ? 'readonly' : '' }} class="form-control" value="{{ isset($category) ? $category->name : '' }}" />
                        </div>
                        <div class="mt-2">
                            <label for="">Description</label>
                            <textarea name="description" {{ $isShown ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($category) ? $category->description : '' !!}</textarea>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Image</label>
                                @if(!$isShown)
                                    <input type="file" name="image" class="form-control" accept="image/*" />
                                @endif
                                @if(isset($category->image))
                                    <img src="{{ asset($category->image) }}" alt="" style="height: 60px" />
                                @endif
                            </div>
                        </div>
                        <div class="mt-2">
                            <label for="">Active</label>
                            <div>
                                <div class="material-switch">
                                    <input id="someSwitchOptionInfo" name="status" {{ $isShown ? 'disabled' : '' }}  class="form-check-input success check-outline outline-success" type="checkbox" {{ isset($category) && $category->status == 0 ? '' : 'checked' }} />
                                    <label for="someSwitchOptionInfo" class="label-info"></label>
                                </div>
                            </div>
                        </div>
                        @if(!$isShown)
                        <div>
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($category) ? 'Update' : 'Create' }} Category" />
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
