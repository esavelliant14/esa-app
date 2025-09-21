@extends('_templates.main')
@section('body')

    <div class="row">
        @if(session('access_denied'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Denied',
                        text: 'You do not have permission to access this page.',
                        confirmButtonText: 'OK',
                        confirmButtonColor:"#34c38f",
                        customClass: {
                            confirmButton: "rounded-pill",
                        }
                        
                    });
                });
            </script>
        @endif
        <div class="col-xl-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total Device</p>
                                    <h4 class="mb-0">{{ $var_total_device }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title">
                                            <i class="mdi mdi-router font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total Client</p>
                                    <h4 class="mb-0">{{ $var_total_client }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="fas fa-users font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-muted fw-medium">Total BOD Request</p>
                                    <h4 class="mb-0">{{ $var_total_bod }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span class="avatar-title rounded-circle bg-primary">
                                            <i class="mdi mdi-speedometer font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">           
                <div class="card-body">
                <h4 class="card-title mb-4">Spline Area</h4>
                <div id="spline_area" data-active='@json($activeArray)' data-done='@json($doneArray)' data-dates='@json($dates)' data-colors='["--bs-primary", "--bs-success"]' class="apex-charts" dir="ltr"></div>
                </div>
            </div>

        </div>


    </div>
    <!-- end row -->

@endsection