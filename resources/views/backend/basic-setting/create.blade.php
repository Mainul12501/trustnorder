@extends('backend.master')

@section('title', 'Basic Setting')
@section('breadcrumb', 'Basic Setting')

@section('body')

    <div class="row py-5">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">Basic Setting</h4>
{{--                    <a href="{{ route('gas-stations.index') }}" class="text-white float-end f-s-20">--}}
{{--                        <i class="mdi mdi-page-previous-outline"></i>--}}
{{--                    </a>--}}
                </div>
                <div class="card-body">
                    <form action="{{ isset($basicSetting) ? route('basic-settings.update', $basicSetting->id) : route('basic-settings.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($basicSetting))
                            @method('put')
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Site Title <span class="text-danger">(required)</span></label>
                                <input type="text" name="site_title" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->site_title : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Meta Title </label>
                                <input type="text" name="meta_title" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->meta_title : '' }}" />
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="">Phone Number </label>
                                <input type="text" name="phone" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->phone : '' }}" />
                            </div>
                            <div class="col-md-6 mt-1">
                                <label for="">Email </label>
                                <input type="text" name="email" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->email : '' }}" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Site Moto</label>
                                <textarea name="site_moto" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->site_moto : '' !!}</textarea>
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <label for="">Site Footer Info</label>--}}
{{--                                <textarea name="site_description" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->site_description : '' !!}</textarea>--}}
{{--                            </div>--}}
                            <div class="col-md-6 mt-1">
                                <label for="">Meta Description</label>
                                <textarea name="meta_description" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->meta_description : '' !!}</textarea>
                            </div>
{{--                            <div class="col-md-6 mt-1">--}}
{{--                                <label for="">Corporate Office Address</label>--}}
{{--                                <textarea name="corporate_office" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->corporate_office : '' !!}</textarea>--}}
{{--                            </div>--}}
                        </div>
                        <div class="mt-2">
                            <label for="">Office Address</label>
                            <textarea name="address" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->address : '' !!}</textarea>
                        </div>

{{--                        <div class="mt-2">--}}
{{--                            <label for="">SEO Header</label>--}}
{{--                            <textarea name="seo_header" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->seo_header : '' !!}</textarea>--}}
{{--                        </div>--}}
{{--                        <div class="mt-2">--}}
{{--                            <label for="">SEO Footer</label>--}}
{{--                            <textarea name="seo_footer" {{ isset($isShown) ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($basicSetting) ? $basicSetting->seo_footer : '' !!}</textarea>--}}
{{--                        </div>--}}
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">FB Profile Link</label>
                                <input type="text" name="fb" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->fb : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Whatsapp Number</label>
                                <input type="text" name="whatsapp" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->whatsapp : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Instagram Profile Link</label>
                                <input type="text" name="insta" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->insta : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Skype Profile Link</label>
                                <input type="text" name="skype" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->skype : '' }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="">Linkedin Profile Link</label>
                                <input type="text" name="linkedin" {{ isset($isShown) ? 'readonly' : '' }} class="form-control" value="{{ isset($basicSetting) ? $basicSetting->linkedin : '' }}" />
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="">Logo</label>
                                @if(!isset($isShown))
                                    <input type="file" name="logo" class="form-control" accept="image/*" />
                                @endif
                                @if(isset($basicSetting->logo))
                                    <img src="{{ asset($basicSetting->logo) }}" alt="" style="height: 60px" />
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label for="">Favicon</label>
                                @if(!isset($isShown))
                                    <input type="file" name="favicon" class="form-control" accept="image/vnd.microsoft.icon" />
                                @endif
                                @if(isset($basicSetting->favicon))
                                    <img src="{{ asset($basicSetting->favicon) }}" alt="" style="height: 16px" />
                                @endif
                            </div>

                        </div>
{{--                        <div class="mt-2">--}}
{{--                            <label for="">Active</label>--}}
{{--                            <div>--}}
{{--                                <div class="material-switch">--}}
{{--                                    <input id="someSwitchOptionInfo" name="status" {{ isset($isShown) ? 'disabled' : '' }}  class="form-check-input success check-outline outline-success" type="checkbox" {{ isset($basicSetting) && $basicSetting->status == 0 ? '' : 'checked' }} />--}}
{{--                                    <label for="someSwitchOptionInfo" class="label-info"></label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        @if(!isset($isShown))
                        <div class="mt-2">
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($basicSetting) ? 'Update' : 'Create' }} Basic Setting" />
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
