@extends('_templates.main')
@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="{{ url('/public/js/pages/sweet-alert.js') }}"></script>
<div class="row">
    <div class="col-12">
        @if(session()->has('success'))
            <script>
                    Swal.fire({
                        title:"Success!",
                        text: "{{ session('success') }}",
                        icon:"success",
                        confirmButtonColor:"#34c38f",
                        customClass: {
                            confirmButton: "rounded-pill",
                            cancelButton: "rounded-pill"
                        }
                    })
                    
            </script>
        @endif
        @if(session()->has('failed'))
            <script>
                    Swal.fire({
                        title:"Failed!",
                        text: "{{ session('failed') }}",
                        icon:"error",
                        confirmButtonColor:"#34c38f",
                        customClass: {
                            confirmButton: "rounded-pill",
                            cancelButton: "rounded-pill"
                        }
                    })
                    
            </script>
        @endif
        <div class="card">
            <div class="card-body">
                
                <h4 class="card-title"></h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddMonDomain" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Domain</button>
                
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Domain</th>
                            <th>Status</th>
                            <th>Suspended</th>
                            <th>Expired Date</th>
                            <th>Countdown</th>
                            <th>Owner Type</th>
                            <th>Vendor</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ( $var_show as $item )
                            <tr class="
                                {{ $item['is_expiring'] === '1bulan' ? 'table-danger' : '' }}
                                {{ $item['is_expiring'] === '3bulan' ? 'table-warning' : '' }}
                            ">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['api']['domain_name'] }}</td>
                                <td>{{ $item['api']['order_status'] }}</td>
                                <td>{{ $item['api']['suspended'] }}</td>
                                <td>{{ $item['api']['expiry_date'] }}</td>
                                <td><span class="countdown" data-expiry="{{ $item['api']['expiry_date'] }}"></span></td>
                                <td>{{ $item['api']['owner_type'] }}</td>
                                <td>{{ $item['api']['vendor'] }}</td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@if ($errors->any())
        <script>
            window.onload = function() {
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddMonDomain'));
            myModal.show();
            }
        </script>
@endif
@endsection