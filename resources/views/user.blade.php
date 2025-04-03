@extends('_templates.main')

@section('body')

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
                @can('access-permission' , '3')   
                <div class="">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddUser" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addCustomers-modal"><i class="mdi mdi-plus me-1"></i>New User</button>
                </div>
                @endcan
                
                
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Group</th>
                            <th>Privilege</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ( $var_show as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->group->name_group }}</td>
                            <td>{{ $item->privilege->name_privilege }}</td>
                            <td>
                                {{ ($item->status === 1) ? 'Active' : 'Inactive'  }} 
                            </td>
                            <td>
                                @can('access-permission' , '11')
                                    @if (auth()->user()->id == $item->id)
                                        
                                    @else 
                                        <button class="d-inline btn btn-sm btn-info edit-user" data-groupid ="{{ $item->id_group }}"data-email="{{ $item->email }}" data-name="{{ $item->name }}" data-id="{{ $item->id }}" data-group="{{ $item->group->name_group }}" data-privilege="{{ $item->id_privilege }}" data-status="{{ $item->status }}" data-bs-toggle="modal" data-bs-target="#ModalEditUser"><span class="mdi mdi-square-edit-outline"></span></button>
                                    @endif
                                @endcan

                                @can('access-permission' , '12')
                                    @if (auth()->user()->id == $item->id)
                                        
                                    @else 
                                        <form class="d-inline reset-password-form" action="{{ route('password.reset',$item->id) }}" method="POST">
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-light reset-password-button">
                                                <span class="mdi mdi-key"></span>
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                                @can('access-permission' , '4')
                                    <form class="delete-form d-inline" action="{{ route('user.delete',$item->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="button" class="btn btn-sm btn-danger delete-button">
                                            <span class="mdi mdi-delete" ></span>
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
<!--
<script>
    window.onload = function() {
        var modal = new bootstrap.Modal(document.getElementById('ModalAddUser'));
        modal.show();
    }
</script>
-->
@if ($errors->any())
        <script>
            window.onload = function() {
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddUser'));
            myModal.show();
            }
        </script>
@endif
@endsection