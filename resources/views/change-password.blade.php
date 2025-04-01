@extends('_templates.main')
@section('body')
<script src="{{ url('/public/js/pages/sweet-alert.js') }}"></script>
<div class="col-xl-6">
    @if(session('status') == 'password-updated')
        <script>
            Swal.fire({
                title:"Success!",
                text:"Change Password Successfully",
                icon:"success",
                confirmButtonColor:"#34c38f",
                customClass: {
                    confirmButton: "rounded-pill",
                    cancelButton: "rounded-pill"
                    }
            })
        </script>
    @endif
    
    <a href=""></a>
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Change Password</h4>

            <form method="POST" action="{{ route('user-password.update') }}">
            @csrf
            @method('put')
            
                <div class="row mb-4">
                    <label for="horizontal-firstname-input" class="col-sm-4 col-form-label">Current Password</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="horizontal-firstname-input" name="current_password" placeholder="Current Password " required>
                    </div>
                    @error('current_password', 'updatePassword')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-4">
                    <label for="horizontal-email-input" class="col-sm-4 col-form-label">New Password</label>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="horizontal-email-input" name="password" placeholder="New Password" required>
                    </div>
                    @error('password', 'updatePassword')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="row mb-4">
                    <label for="horizontal-password-input" class="col-sm-4 col-form-label">Repeat Password</label>
                    <div class="col-sm-6">
                      <input type="password" class="form-control" id="horizontal-password-input" name="password_confirmation" placeholder="Repeat New Password" required>
                    </div>
                </div>

                <div class="row">
                    <div>
                        <button type="submit" class="btn btn-success rounded-pill">Submit</button>
                    </div>
                    
                </div>
            </form>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
@endsection