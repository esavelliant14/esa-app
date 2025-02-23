@extends('_templates.main')
<!-- Sweet Alert-->

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
                @can('access-permission' , '2')   
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
                                <a href="" class="btn btn-sm btn-info"><span class="mdi mdi-square-edit-outline"></span></a>
                                <a href="" class="btn btn-sm btn-light"><span class="mdi mdi-key"></span></a>
                                @can('access-permission' , '3')   
                                    <form class="delete-form d-inline"  action="/esa-app/user/delete/{{ $item->id }}" method="POST">
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