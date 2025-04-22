<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('/') }}backend/dist/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('/') }}backend/dist/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- apps -->
<script src="{{ asset('/') }}backend/dist/js/app.min.js"></script>
<script src="{{ asset('/') }}backend/dist/js/app.init.js"></script>
<script src="{{ asset('/') }}backend/dist/js/app-style-switcher.js"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('/') }}backend/dist/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/jquery-sparkline/jquery.sparkline.min.js"></script>
<!--Wave Effects -->
<script src="{{ asset('/') }}backend/dist/js/waves.js"></script>
<!--Menu sidebar -->
<script src="{{ asset('/') }}backend/dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="{{ asset('/') }}backend/dist/js/feather.min.js"></script>
<script src="{{ asset('/') }}backend/dist/js/custom.min.js"></script>

<script src="{{ asset('/') }}backend/dist/libs/toastr/toastr.min.js"></script>
{!! Toastr::message() !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    {{--toastr.options.progressBar = true;--}}
    {{--@if(session()->has('success'))--}}
    {{--    toastr.success("{{ session('success') ?? 'success' }}");--}}
    {{--<?php session()->forget('success') ?>--}}
    {{--@elseif(session()->has('error'))--}}
    {{--    toastr.error("{{ session('error') }}");--}}
    {{--    <?php session()->forget('error') ?>--}}
    {{--@endif--}}
</script>
@stack('script')
