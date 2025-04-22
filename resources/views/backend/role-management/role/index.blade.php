@extends('backend.master')

@section('title', 'Roles')
@section('breadcrumb', 'Roles')

@section('body')
    <div class="container-fluid">
        <div class="row py-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="float-start text-white">Roles</h4>
                        @can('create-role')
                            <a href="{{ route('roles.create') }}" class="rounded-circle text-white float-end f-s-20">
                                <i class="mdi mdi-plus-circle-outline"></i>
                            </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table class="table" id="dataTable" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Note</th>
                                <th>Permissions</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->title }}</td>
                                    <td>{!! $role->note !!}</td>
                                    <td>
                                        @foreach($role->permissions as $permission)
                                            <span class="badge badge-sm bg-primary">{{ $permission->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $role->slug }}</td>
                                    <td>{{ $role->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                    <td class="">
                                        @can('edit-role')
                                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-warning">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                        @endcan
                                        @can('delete-role')
                                            <form class="d-inline" action="{{ route('roles.destroy', $role->id) }}" method="post">
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
@endpush
