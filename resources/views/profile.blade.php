@extends('_templates.main')
@section('body')
    <!-- Simple card -->
<div class="container-fluid">
    <div class="card mb-3" style="max-width: 600px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ url('/public/img/default.png') }}" alt="" class="img-fluid rounded-pill" style="height: 100%; object-fit: cover;">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title mb-4">My Profile</h5>
                    <p><span class="profile-label">Name</span>: {{ auth()->user()->name }}</p>
                    <p><span class="profile-label">Email</span>: {{ auth()->user()->email }}</p>
                    <p><span class="profile-label">Privilege</span>: {{ auth()->user()->privilege->name_privilege }}</p>
                    <p><span class="profile-label">Group</span>: {{ auth()->user()->group->name_group }}</p>
                    <p><span class="profile-label">2FA</span>: <a href="" class="btn btn-sm btn-success rounded-pill">Enable</a></p>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection