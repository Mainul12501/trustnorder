@extends('backend.master')

@section('title', 'sms-offers')
@section('breadcrumb', 'sms-offers')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-hover">
                    <div class="card-header bg-info">
                        <h4 class="text-white float-start">Offers</h4>
{{--                        @can('create-permission-category')--}}
                            <a href="{{  route('sms-offers.create') }}" class="rounded-circle float-end text-white text-light f-s-20 ">
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
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($offers as $key => $offer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $offer->common_message ?? '' }}</td>

                                        <td>{{ $offer->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                        <td class="">
                                            <a href="{{ route('sms-offers.send-offers-to-users', $offer->id) }}" class="btn btn-sm btn-primary mt-1 send-offer" title="Send Offer to users">
                                                <i class="mdi mdi-send"></i>
                                            </a> <br>
                                            <a href="{{ route('sms-offers.show', $offer->id) }}" class="btn btn-sm btn-primary mt-1">
                                                <i class="mdi mdi-eye"></i>
                                            </a> <br>
                                            <a href="{{ route('sms-offers.edit', $offer->id ) }}" class="btn btn-sm btn-warning mt-1">
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a> <br>
                                            {{--                                        @endcan--}}
                                            {{--                                        @can('delete-permission-category')--}}
                                            <form class="d-inline" action="{{ route('sms-offers.destroy', $offer->id) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger delete-data mt-1">
                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                </button>
                                            </form>
                                            {{--                                        @endcan--}}
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

<script>
    $(function (){
        $(document).on('click', '.send-offer', function () {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "All users will get this offer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, Send it!",
            }).then((result) => {
                if (result.value) {
                    // Swal.fire("Deleted!", "Your file has been deleted.", "success");
                    // $(this).closest('form').submit();
                    window.location = $(this).attr('href');
                }
            });
        });
    })
</script>
@endpush
