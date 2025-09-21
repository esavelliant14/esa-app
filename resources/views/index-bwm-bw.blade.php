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
                @can('access-permission' , '64')
                <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddBwmBw" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Bandwidth</button>
                @endcan
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Router Hostname</th>
                            <th>Policer Name</th>
                            <th>Bandwidth</th>
                            <th>Burst Limit</th>
                            <th>Owned By</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ( $var_show as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->hostname }}</td>
                            <td>{{ $item->policer_name }}</td>
                            <td>{{ $item->bandwidth }}</td>
                            <td>{{ $item->burst_limit }}</td>
                            <td>{{ $item->group->name_group }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>
                                {{-- <form class="delete-form d-inline"  action="{{ route('bwmbw.delete',$item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="button" class="btn btn-sm btn-danger delete-button">
                                        <span class="mdi mdi-delete" ></span>
                                    </button>
                                </form> --}}
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
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddBwmBw'));
            myModal.show();
            }
        </script>
@endif
@endsection