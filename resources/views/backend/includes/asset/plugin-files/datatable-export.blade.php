{{--regular js--}}
<link rel="stylesheet" href="{{ asset('/') }}backend/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}backend/dist/js/pages/datatable/custom-datatable.js"></script>

<!-- start - This is for export functionality only -->
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<!-- calling -->
<script>
    $(function () {
        $("#file_export").DataTable({
            dom: "Bfrtip",
            buttons: ["copy", "csv", "excel", "pdf", "print"],
        });
        $(
            ".buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel"
        ).addClass("btn btn-primary mr-1");
    })
</script>
