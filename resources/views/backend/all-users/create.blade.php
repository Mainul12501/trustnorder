@extends('backend.master')

@section('title', 'User Create')
@section('breadcrumb', 'User '. isset($user) ? 'Update' : 'Create' )

@section('body')

    <div class="row py-5">
        <div class="col-md-9 mx-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white float-start">User {{ isset($user) ? 'Update' : 'Create' }}</h4>
                    <a href="{{ route('users.index') }}" class="text-white float-end f-s-20">
                        <i class="mdi mdi-page-previous-outline"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ isset($user) ? route('users.update', $user->id) : route('users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user))
                            @method('put')
                        @endif
                        <input type="hidden" name="exist_role" value="{{ isset($user) ? $user->role : 'user' }}">
                        <div>
                            <label for="">User Name <span class="text-danger">(required)</span></label>
                            <input type="text" required name="name" {{ $isShown ? 'readonly' : '' }} class="form-control" value="{{ isset($user) ? $user->name : '' }}" />
                            @error('name') <span class="text-danger">{{ $errors->first('name') ?? '' }}</span> @enderror
                        </div>
                        <div class="mt-2">
                            <label for="">Mobile <span class="text-danger">(required)</span> </label>
{{--                            <textarea name="mobile" required {{ $isShown ? 'disabled' : '' }} class="form-control" id="elm1" cols="30" rows="2">{!! isset($user) ? $user->mobile : '' !!}</textarea>--}}
                            <input type="text" required name="mobile" {{ $isShown ? 'readonly' : '' }} class="form-control" value="{{ isset($user) ? $user->mobile : '' }}" />
                            @error('mobile') <span class="text-danger">{{ $errors->first('mobile') ?? '' }}</span> @enderror
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="districts">Districts</label>
                                <select name="district_id" id="district" {{ $isShown ? 'disabled' : '' }} class="form-control">
                                    <option value="" selected disabled >Select a district</option>
                                    @foreach($districts as $district)
                                        <option value="{{ $district->id }}" {{ isset($user) && $user?->area?->district_id == $district->id ? 'selected' : '' }}>{{ $district->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="Area">Area</label>
                                <select name="area_id" id="area" class="form-control " {{ $isShown ? 'disabled' : '' }}>
{{--                                    <option value="dhaka">Mirpur</option>--}}
                                    @if(isset($user))
                                        <option value="{{ $user->area_id }}">{{ $user->area->area_name ?? '' }}</option>

                                    @endif
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="Area">Building Address</label>
                                <input type="text" class="form-control" name="building_address" value="{{ isset($user) ? $user->building_address : '' }}" />
                            </div>
                            <div class="col-md-4">
                                <label for="floor">Floor</label>
                                <input type="text" class="form-control" name="floor" value="{{ isset($user) ? $user->floor : '' }}" />
                            </div>
                            <div class="col-md-4">
                                <label for="roadNumber">Road Number</label>
                                <input type="text" class="form-control" name="road_number" value="{{ isset($user) ? $user->road_number : '' }}" />
                            </div>
                        </div>
{{--                        @if(auth()->user()->role == 'admin')--}}
{{--                            <div class="row mt-2">--}}
{{--                                <div class="col-12">--}}
{{--                                    <label for="">{{ isset($user) ? 'Change' : '' }} Password</label>--}}
{{--                                    <input type="text" name="password" {{ isset($user) ? '' : 'required' }} class="form-control">--}}
{{--                                    @error('password') <span class="text-danger">{{ $errors->first('password') ?? '' }}</span> @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
                        @if(!$isShown)
                        <div class="mt-2">
                            <input type="submit" class="btn btn-success btn-sm float-end" value="{{ isset($user) ? 'Update' : 'Create' }} User" />
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
        $(document).on('change', '#district', function () {
            var districtId = $(this).val();
            $.ajax({
                url: "/get-areas-by-district-id/"+districtId,
                method: "GET",
                success: function (data) {
                    if (data.status == 'success')
                    {
                        let option = '';
                        $.each(data.areas, function (key, value) {
                            option  += '<option value="'+value.id+'">'+value.area_name+'</option>'
                        })
                        $('#area').empty().append(option);

                        $(".select2").select2({
                            placeholder: "Select an option",
                            allowClear: true,
                            templateResult: iconFormat,
                            templateSelection: iconFormat,
                            escapeMarkup: function (es) {
                                return es;
                            },
                        });

                    } else {
                        toastr.error('Something went wrong. Please try again.')
                    }

                },
                errors: function (error) {
                    toastr.error(error);
                }
            })
        })
    </script>
@endpush
