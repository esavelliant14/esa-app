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
                @can('access-permission' , '6')
                <div class="">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddPrivilege" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Privilege</button>
                </div>
                @endcan

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Privilege</th>
                        <th>Group</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>       
                        @foreach ( $var_show as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name_privilege }}</td>
                                <td>{{ $item->group->name_group }}</td>
                                <td>
                                    @can('access-permission', '5')
                                        <button type="button" class="btn btn-sm btn-light view-permission-privilege" data-groupid ="{{ $item->id_group }}" data-privilege="{{ $item->name_privilege }}" data-group="{{ $item->group->name_group }}" data-id="{{ $item->id }}" data-bs-toggle="modal" data-bs-target="#ModalViewPermissionPrivilege"><span class="mdi mdi-eye" ></span>
                                        </button>
                                    @endcan
                                    @can('access-permission' , '13')
                                        @if($item->id == auth()->user()->id_privilege)
                                       @elseif ($item->id == 1)
                                        @else
                                            <button class="d-inline btn btn-sm btn-info edit-privilege" id="edit-privilege-{{ $item->id_group }}" data-groupid ="{{ $item->id_group }}" data-id="{{ $item->id }}" data-privilege="{{ $item->name_privilege }}" data-group="{{ $item->group->name_group }}" data-bs-toggle="modal" data-bs-target="#ModalEditPrivilege"><span class="mdi mdi-square-edit-outline"></span></button>
                                        @endif
                                    @endcan
                                    @can('access-permission' , '7')
                                    <form class="delete-form d-inline"  action="{{ route('privilege.delete',$item->id) }}" method="POST">
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
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddPrivilege'));
            myModal.show();
            }
        </script>
@endif
@endsection