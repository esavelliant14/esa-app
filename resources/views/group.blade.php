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
                @can('access-permission' , '9')
                <div class="">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddGroup" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addCompany-modal"><i class="mdi mdi-plus me-1"></i>New Group</button>
                </div>
                @endcan

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Group</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>       
                        @foreach ( $var_show as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name_group }}</td>
                                <td>
                                    @can('access-permission', '10')
                                    <a href="" class="btn btn-sm btn-danger"><span class="mdi mdi-delete"></span></a>
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
            var myModal = new bootstrap.Modal(document.getElementById('ModalAddGroup'));
            myModal.show();
            }
        </script>
@endif
@endsection