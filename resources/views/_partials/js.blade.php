    <!-- Core JS -->
    <script src="{{ url('/public/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('/public/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/public/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ url('/public/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('/public/libs/node-waves/waves.min.js') }}"></script>

    <!-- Charts -->
    <script src="{{ url('/public/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('/public/js/pages/apex.js') }}"></script>
    <script src="{{ url('/public/js/pages/dashboard.init.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ url('/public/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/public/libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ url('/public/libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ url('/public/libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('/public/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('/public/js/pages/datatables.init.js') }}"></script>

    <!-- Sweetalert -->
    <script src="{{ url('/public/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ url('/public/js/pages/sweet-alerts.init.js') }}"></script>

    <!-- Form Plugins -->
    <script src="{{ url('/public/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ url('/public/libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ url('/public/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ url('/public/libs/@chenfengyuan/datepicker/datepicker.min.js') }}"></script>
    <script src="{{ url('/public/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ url('/public/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ url('/public/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ url('/public/js/pages/form-advanced.init.js') }}"></script>

    <!-- Custom JS -->
    <script>
        window.APP_URL = "{{ url('/') }}"; 
    </script>
    <script src="{{ url('/public/js/pages/customize.js') }}?v={{ time() }}"></script>
    <script src="{{ url('/public/js/plugin.js') }}"></script>

    {{-- Vite bundle terakhir --}}
    @vite(['resources/js/app.js'])
