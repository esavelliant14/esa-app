<!doctype html>
<html lang="en">

    <!-- START HEAD CODE -->
        @include('_partials.head')
    <!-- END HEAD CODE -->

    <body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <!-- START NAVBAR CODE -->
                @include('_partials.navbar')
            <!-- END NAVBAR CODE -->

            <!-- SIDEBAR CODE -->
                @include('_partials.sidebar')
            <!-- END SIDEBAR CODE -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    <div class="container-fluid">
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">{{ $title_submenu }}</h4>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $title_menu }}</a></li>
                                            <li class="breadcrumb-item active">{{ $title_submenu }}</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                       <!-- START BODY CODE -->
                            @yield('body')
                       <!-- END BODY CODE -->
                        
                    </div> <!-- container-fluid -->
                    
                </div> <!-- End Page-content -->
                <!-- START FOOTER CODE -->
                    @include('_partials.footer')
                <!-- END FOOTER CODE -->
            </div>
            <!-- end main content-->
        </div>
        <!-- END layout-wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- START JAVASCRIPT CODE -->
            @include('_partials.js')
        <!-- END JAVASCRIPT CODE -->
    </body>
</html>