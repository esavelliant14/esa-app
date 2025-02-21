@extends('_templates.main')
@section('body')
<div class="row">
    <div class="col-12">
        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" arial-label="Close">

                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-body">

                <h4 class="card-title"></h4>
                <div class="">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddPrivilege" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New Privilege</button>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Privilege</th>
                        <th>Company</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>       
                        @foreach ( $var_show as $item )
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->name_privilege }}</td>
                                <td>{{ $item->company->name_company }}</td>
                                <td>
                                    <a href="" class="btn btn-sm btn-info"><span class="mdi mdi-square-edit-outline"></span></a>
                                    <a href="" class="btn btn-sm btn-danger"><span class="mdi mdi-delete"></span></a>
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