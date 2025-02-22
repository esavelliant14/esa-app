<!-- START MODAL ADD USER -->
<div class="modal fade" id="ModalAddUser" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/esa-app/user">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name-input" class="form-label">Name</label>
                                <input type="text" name="txt_name" id="name-input" class="form-control @error('txt_name') is-invalid @enderror" placeholder="Enter name" value="{{ old('txt_name') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email-input" class="form-label">Email</label>
                                <input type="email" name="txt_email" id="email-input" class="form-control @error('txt_email') is-invalid @enderror" placeholder="Enter email" {{ old('txt_email') }} required />
                                <div class="invalid-feedback">
                                    @error('txt_email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="company-input" class="form-label">Company</label>
                                <select name="txt_company" id="id_company" class="form-select @error('txt_company') is-invalid @enderror" required>
                                    <option value="">--- Choose Company ---</option>
                                    @if ($active === 'user')
                                        @foreach ( $var_show_company as $item_company )
                                            <option value="{{ $item_company->id }}">{{ $item_company->name_company }}</option>
                                        @endforeach
                                    @else
                                        ''
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    @error('txt_company')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="privilege-input" class="form-label">Privilege</label>
                                <select name="txt_privileged" id="id_privilege" class="form-select @error('txt_privileged') is-invalid @enderror" required>
                                    <option value="">--- Choose Privileged ---</option>
                                   @if ($active === 'user')
                                        @foreach ( $var_show_privilege as $item_privilege)
                                            <option value="{{ $item_privilege->id }}">{{ $item_privilege->name_privilege }}</option>
                                        @endforeach
                                    @else
                                        ''
                                   @endif
                                    <div class="invalid-feedback">
                                        @error('txt_privileged')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="privilege-input" class="form-label">Status</label>
                                <select name="txt_status" id="" class="form-select @error('txt_status') is-invalid @enderror" required>
                                    <option value="">--- Choose Status ---</option>
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                    <div class="invalid-feedback">
                                        @error('txt_status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="password-1-input" class="form-label">Password</label>
                                <input type="password" name="txt_password" id="email-input" class="form-control @error('txt_password') is-invalid @enderror" placeholder="Enter password" required />
                                <div class="invalid-feedback">
                                    @error('txt_password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password-2-input" class="form-label">Repeat Password</label>
                                <input type="password" name="txt_password_confirmation" id="email-input" class="form-control @error('txt_password_confirmation') is-invalid @enderror" placeholder="Enter password" required />
                                <div class="invalid-feedback">
                                    @error('txt_password_confirmation')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addCustomer-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
<!-- END MODAL ADD USER -->


<!-- START MODAL ADD COMPANY -->
<div class="modal fade" id="ModalAddCompany" tabindex="-1" aria-labelledby="newCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add Company</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/esa-app/company">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name-input" class="form-label">Name Company</label>
                                <input type="text" name="txt_name_company" id="name-input" class="form-control @error('txt_name_company') is-invalid @enderror" placeholder="Enter name" value="{{ old('txt_name_company') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_name_company')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addCompany-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
<!-- END MODAL ADD COMPANY -->


<!-- START MODAL ADD PRIVILEGE -->
<div class="modal fade" id="ModalAddPrivilege" tabindex="-1" aria-labelledby="newPrivilegeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newPrivilegeModalLabel">Add Privilege</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/esa-app/privilege">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name-input" class="form-label">Name Privilege</label>
                                <input type="text" name="txt_name_privilege" id="name-input" class="form-control @error('txt_name_privilege') is-invalid @enderror" placeholder="Enter name" value="{{ old('txt_name_privilege') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_name_privilege')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="company-input" class="form-label">Company</label>
                            <select name="txt_company" id="" class="form-select @error('txt_company') is-invalid @enderror" required>
                                <option value="">--- Choose Company ---</option>
                                @if ($active === 'privilege')
                                    @foreach ( $var_show_company as $item_company )
                                        <option value="{{ $item_company->id }}">{{ $item_company->name_company }}</option>
                                    @endforeach
                                @else
                                    ''
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                @error('txt_company')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addCompany-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
<!-- END MODAL ADD PRIVILEGE -->



<!-- START MODAL LOGOUT -->
<div class="modal fade" id="ModalLogout" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Logout Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to logout?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <form action="/esa-app/logout" method="POST">
                    @csrf
                    <button type="submit" id="logout-btn" class="btn btn-sm rounded-pill btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LOGOUT -->



