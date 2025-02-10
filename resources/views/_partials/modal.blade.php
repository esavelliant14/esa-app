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
                                <select name="txt_company" id="" class="form-select @error('txt_company') is-invalid @enderror" required>
                                    <option value="">--- Choose Company ---</option>
                                    <option value="ESA NET">ESA NET</option>
                                    <option value="ESA DEV">ESA DEV</option>
                                </select>
                                <div class="invalid-feedback">
                                    @error('txt_company')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="privilege-input" class="form-label">Privileged</label>
                                <select name="txt_privileged" id="" class="form-select @error('txt_privileged') is-invalid @enderror" required>
                                    <option value="">--- Choose Privileged ---</option>
                                    <option value="1">Administrator</option>
                                    <option value="2">Operator</option>
                                    <div class="invalid-feedback">
                                        @error('txt_privileged')
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
                                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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
                                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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
<div class="modal fade" id="ModalAddPrivilege" tabindex="-1" aria-labelledby="newCompanyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add Privilege</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/esa-app/company">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name-input" class="form-label">Name Privilege</label>
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
                                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
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
