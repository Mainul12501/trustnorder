@extends('backend.master')

@section('title', 'Page Content '.isset($pageContent) ? 'Update' : 'Create')
@section('breadcrumb', 'Page Content '.isset($pageContent) ? 'Update' : 'Create')

@section('body')

    <div class="row py-5">
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">Page Content {{ isset($pageContent) ? 'Update' : 'Create' }}</h4>
                    <a href="{{ route('page-contents.index') }}" class="text-white float-end f-s-20">
                        <i class="mdi mdi-page-previous-outline"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ isset($pageContent) ? route('page-contents.update', $pageContent->id) : route('page-contents.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($pageContent))
                            @method('put')
                        @endif
                        <div class="mt-2">
                            <label for="">District Name <span class="text-danger">(required)</span></label>
                            <select name="page_type" class="form-control select2 w-100" id="" {{ $isShown ? 'disabled' : '' }}>
                                <option value="policy" {{ isset($pageContent) && $pageContent->page_type == 'policy' ? 'selected' : '' }} >Policy</option>
                                <option value="support" {{ isset($pageContent) && $pageContent->page_type == 'support' ? 'selected' : '' }} >Support</option>
                                <option value="terms" {{ isset($pageContent) && $pageContent->page_type == 'terms' ? 'selected' : '' }} >terms & Conditions</option>
                                <option value="about-us" {{ isset($pageContent) && $pageContent->page_type == 'about-us' ? 'selected' : '' }} >About Us</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <label for="">Page Content</label>
                            <textarea name="content" {{ $isShown ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($pageContent) ? $pageContent->content : '' !!}</textarea>
                        </div>
                        <div class="mt-2">
                            <label for="">Active</label>
                            <div>
                                <div class="material-switch">
                                    <input id="someSwitchOptionInfo" name="status" {{ $isShown ? 'disabled' : '' }}  class="form-check-input success check-outline outline-success" type="checkbox" {{ isset($pageContent) && $pageContent->status == 0 ? '' : 'checked' }} />
                                    <label for="someSwitchOptionInfo" class="label-info"></label>
                                </div>
                            </div>
                        </div>
                        @if(!$isShown)
                        <div>
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($pageContent) ? 'Update' : 'Create' }} Page Content" />
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
