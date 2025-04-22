<link rel="stylesheet" href="{{ asset('/') }}backend/dist/libs/select2/dist/css/select2.min.css">
<script src="{{ asset('/') }}backend/dist/libs/select2/dist/js/select2.full.min.js"></script>
<script src="{{ asset('/') }}backend/dist/libs/select2/dist/js/select2.min.js"></script>
<style>
    .select2-selection__choice{background-color: #137eff !important;}
    .select2-selection__choice__remove{color: white !important;}
</style>
{{--init--}}
<script>
    $(function (){
        $(".select2").select2({
            placeholder: "Select an option",
            allowClear: true,
            templateResult: iconFormat,
            templateSelection: iconFormat,
            escapeMarkup: function (es) {
                return es;
            },
        });
    })
    function iconFormat(icon) {
        var originalOption = icon.element;
        if (!icon.id) {
            return icon.text;
        }
        var $icon =
            "<i class='fab fa-" + $(icon.element).data("icon") + "'></i>" + icon.text;
        return $icon;
    }
</script>
