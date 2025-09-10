@extends('_templates.main')
@section('body')
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
                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#ModalAddDomain" class="btn btn-sm btn-success btn-rounded waves-effect waves-light mb-2 addPrivilege-modal"><i class="mdi mdi-plus me-1"></i>New BOD</button> --}}
                
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Client</th>
                            <th>Bandwidth Existing</th>
                            <th>Bandwidth BOD</th>
                            <th>BOD Until</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        {{-- @foreach ( $var_show as $item ) --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                            </td>
                        </tr>
                        {{-- @endforeach --}}
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection