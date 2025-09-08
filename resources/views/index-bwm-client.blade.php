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
        <div class="card">
            <div class="card-body">
                
                <h4 class="card-title"></h4>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddBwmClient" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Client</button>
                
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Router Hostname</th>
                            <th>Client Name</th>
                            <th>Interface</th>
                            <th>IP Address</th>
                            <th>Policer (input/output)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ( $var_show as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->hostname }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->interface }} unit {{ $item->unit_interface }}</td>
                            <td>{{ $item->ip_address }}</td>
                            <td>{{ $item->input_policer }}/{{ $item->output_policer }}</td>
                            <td>
                            </td>
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
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddBwmClient'));
            myModal.show();
            }
        </script>
@endif
@endsection