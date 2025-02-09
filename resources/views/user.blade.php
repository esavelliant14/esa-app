@extends('_templates.main')
@section('body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <h4 class="card-title">Default Datatable</h4>
                <div class="">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#newCustomerModal" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addCustomers-modal"><i class="mdi mdi-plus me-1"></i>New User</button>
                </div>

                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Privileged</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>


                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Esa V Agusta</td>
                        <td>esa@gmail.com</td>
                        <td>ESA NET</td>
                        <td>Administrator</td>
                        <td>Active</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Putri Dwi</td>
                        <td>putri@gmail.com</td>
                        <td>ESA NET</td>
                        <td>Operator</td>
                        <td>Inactive</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection