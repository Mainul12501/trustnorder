@extends('backend.master')

@section('title', 'Permission')
@section('breadcrumb', 'Permission')

@section('body')
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-primary">
                        <h4 class="float-start text-white">Permissions</h4>
                        @can('create-permission')
                            <a href="{{ route('permissions.create') }}" class="rounded-circle text-white text-light f-s-20 float-end">
                                <i class="mdi mdi-plus-circle-outline"></i>
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="dataTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{!!  $permission->permissionCategory->name ?? '' !!}</td>
                                    <td>{{ $permission->title ?? '' }}</td>
                                    <td>{{ $permission->slug ?? '' }}</td>
                                    <td>{{ $permission->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="">
                                        @can('edit-permission')
                                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                        @endcan
                                        @can('delete-permission')
                                            <form class="d-inline" action="{{ route('permissions.destroy', $permission->id) }}" method="post" >
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
    @include('backend.includes.asset.plugin-files.datatable')
    @include('backend.includes.asset.plugin-files.sweet-alert-2')
@endpush
