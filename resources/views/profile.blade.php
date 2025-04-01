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

                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3" style="max-width: 600px;">
        <div class="row g-0">
            <div class="col-md-0">
                <div class="card-body">
                    <h5 class="card-title mb-4">TWO FACTOR AUTHENTICATION</h5>
                        <form action="{{ auth()->user()->two_factor_secret ? route('two-factor.disable') : route('two-factor.enable') }}" method="POST">
                            @csrf
                            <p><span class="profile-label">Status</span>
                                @if (auth()->user()->two_factor_secret)
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-pill">Disable</button></p>
                                    {{-- QR CODE --}}
                                    <div class="mb-3">
                                        {!! auth()->user()->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <p><span>Recovery Code :</span>
                                        @foreach ((array) (auth()->user()->recoveryCodes()) as $RecoveryCodes)
                                        <p class="mt-1 text-sm text-gray-600">
                                            {{ $RecoveryCodes }}
                                        </p>
                                        @endforeach
                                    </p>
                                @else
                                    <button class="btn btn-sm btn-success rounded-pill">Enable</button></p>
                                @endif
                            </p>
                        </form>
                        
                    
                </div>
                
                    
                
            </div>
        </div>
    </div>
 

</div>
@endsection