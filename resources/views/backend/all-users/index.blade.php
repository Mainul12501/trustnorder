@extends('backend.master')

@section('title', 'Users')
@section('breadcrumb', 'User Details')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-info">
                        <h4 class="text-white float-start">User Details</h4>
{{--                        @can('create-permission-category')--}}
                            <a href="{{ route('users.create') }}" class="rounded-circle float-end text-white text-light f-s-20 ">
                                <span class="f-s-22 border-5"><i class="mdi mdi-plus-circle-outline"></i></span>
                            </a>
{{--                        @endcan--}}
                    </div>
                    <div class="card-body ">
                        <div class="table-responsive">
                            <table class="table responsive dt-responsive table-responsive"  id="dataTable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                         <td><a href="{{ route('users.show', $user->id ) }}">{{ $user->name ?? '' }}</a></td>
                                        <td>{{ $user->mobile ?? '' }}</td>
                                        <td>
                                            area: {{ $user?->area?->area_name ?? '' }} <br>
                                            address: {{ $user->building_address ?? "".','. $user->floor ?? "".','. $user->road_number ?? '' }}
                                        </td>


                                        <td class="">
                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-sm btn-primary mt-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a> <br>
                                            <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-sm btn-warning mt-1">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a> <br>

                                            <form class="d-inline" action="{{ route('users.destroy', $user->id) }}" method="post">
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


@endpush
