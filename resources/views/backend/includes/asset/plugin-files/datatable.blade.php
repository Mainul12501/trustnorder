
<link rel="stylesheet" href="{{ asset('/') }}backend/dist/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
<script src="{{ asset('/') }}backend/dist/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}backend/dist/js/pages/datatable/custom-datatable.js"></script>
<script>
    $(function () {
        $('#dataTable').DataTable({
            responsive: true
        });
    })
</script>
