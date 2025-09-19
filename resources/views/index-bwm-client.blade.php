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
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddBwmClient" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Client</button>
                
                <table id="datatable" class="table table-bordered dt-responsive w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Router Hostname</th>
                            <th>Client Name</th>
                            <th>Interface</th>
                            <th>IP Address</th>
                            <th style="max-width: 100px;">Policer (up/down)</th>
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
                                <button type="button" class="btn btn-sm btn-info bwm-bod" data-hostname="{{ $item->hostname }}" data-description="{{ $item->description }}" data-interface="{{ $item->interface }}" data-unit="{{ $item->unit_interface }}" data-inputpolicerold="{{ $item->input_policer }}" data-outputpolicerold="{{ $item->output_policer }}" data-bodidgroup="{{ $item->id_group }}" data-bodiduser="{{ $item->id_user }}" data-bs-toggle="modal" data-bs-target="#ModalBwmBod">
                                    <span class="mdi mdi-speedometer" ></span>
                                </button>
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
@if ($errors->BwmBodForm->any())
        <script>
            window.onload = function() {
            var myModalBod = new bootstrap.Modal(document.getElementById('ModalBwmBod'));
            myModalBod.show();
            }
        </script>
@endif
@endsection