@extends('backend.master')

@section('title', 'Permission Categories')
@section('breadcrumb', 'Permission Categories')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-info">
                        <h4 class="text-white float-start">Permission Categories</h4>
                        @can('create-permission-category')
                            <a href="{{ route('permission-categories.create') }}" class="rounded-circle float-end text-white text-light f-s-20 ">
                                <span class="f-s-22 border-5"><i class="mdi mdi-plus-circle-outline"></i></span>
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Note</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissionCategories as $permissionCategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $permissionCategory->name ?? '' }}</td>
                                    <td>{{ $permissionCategory->slug ?? '' }}</td>
                                    <td>{!! $permissionCategory->note ?? '' !!}</td>
                                    <td>{{ $permissionCategory->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="">
                                        @can('edit-permission-category')
                                            <a href="{{ route('permission-categories.edit', $permissionCategory->id) }}" class="btn btn-sm btn-warning">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                        @endcan
                                        @can('delete-permission-category')
                                            <form class="d-inline" action="{{ route('permission-categories.destroy', $permissionCategory->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger delete-data">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>
                                        @endcan
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
@endsection

@push('style')

@endpush

@push('script')

@include("backend.includes.asset.plugin-files.datatable")
@include("backend.includes.asset.plugin-files.sweet-alert-2")


@endpush
