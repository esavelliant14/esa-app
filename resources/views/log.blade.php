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
                
                
                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Action By</th>
                            <th>Category</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                        
                        @foreach ( $var_show as $item )
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->action_by }}</td>
                            <td>{{ $item->category_action }}</td>
                            <td>{{ $item->ip_address }}</td>
                            <td>{{ $item->status }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-light view-log" data-logidgroup="{{ $item->group->name_group }}" data-logcreatedat="{{ $item->created_at }}" data-logdetails="{{ $item->details }}" data-logagent="{{ $item->agent }}" data-logstatus="{{ $item->status }}" data-logipaddress="{{ $item->ip_address }}" data-logcategory="{{ $item->category_action }}" data-logactionby="{{ $item->action_by }}" data-bs-toggle="modal" data-bs-target="#ModalViewLog">
                                    <span class="mdi mdi-eye" ></span>
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

@endsection