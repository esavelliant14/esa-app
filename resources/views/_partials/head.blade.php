<head>
    <meta charset="utf-8" />
    <title>{{ $title_url }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url('/public/img/favicon.ico') }}">

    
    <link href="{{ url('/public/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

 

    <link href="{{ url('/public/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script>
        window.baseUrl = "{{ asset('public/') }}";

    </script>
    

    <!-- Sweet Alert-->
    <link href="{{ url('/public/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ url('/public/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="{{ url('/public/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />     
    <!-- spectrum colorpicker2 -->
    <link href="{{ url('/public/libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('/public/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ url('/public/libs/@chenfengyuan/datepicker/datepicker.min.css') }}">
    <!-- Bootstrap Css -->
    <link href="{{ url('/public/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('/public/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    
    <!-- App Css-->
    <link href="{{ url('/public/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

    <script src="{{ url('/public/js/plugin.js') }}"></script>
  
    {{-- VITE --}}
    @vite(['resources/css/app.css'])
</head>