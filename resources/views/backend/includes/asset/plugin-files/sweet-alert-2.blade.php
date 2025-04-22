<link rel="stylesheet" href="{{ asset('/') }}backend/dist/libs/sweetalert2/dist/sweetalert2.min.css">
<script src="{{ asset('/') }}backend/dist/libs/sweetalert2/dist/sweetalert2.min.js"></script>

{{--init--}}
<script>
    $(function (){
        $(document).on('click', '.delete-data', function () {
            event.preventDefault();
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.value) {
                    // Swal.fire("Deleted!", "Your file has been deleted.", "success");
                    $(this).closest('form').submit();
                }
            });
        });
    })
</script>
