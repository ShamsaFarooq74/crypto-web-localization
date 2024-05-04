<script>
    @if (Session::has('alert_success'))
        toastr["success"]("{{ session::get('alert_success') }}");
    @endif

    @if (Session::has('alert_info'))
        toastr["info"]("{{ session::get('alert_info') }}");
    @endif

    @if (Session::has('alert_danger'))
        toastr["error"]("{{ session::get('alert_danger') }}");
    @endif

    @if (Session::has('alert_message'))
        toastr["success"]("{{ session::get('alert_message') }}");
    @endif
</script>
