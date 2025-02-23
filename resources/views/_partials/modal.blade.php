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
                                <label for="group-input" class="form-label">Group</label>
                                <select name="txt_group" id="id_group" class="form-select @error('txt_group') is-invalid @enderror" required>
                                    <option value="">--- Choose Group ---</option>
                                    @if ($active === 'user')
                                        @foreach ( $var_show_group as $item_group )
                                            <option value="{{ $item_group->id }}">{{ $item_group->name_group }}</option>
                                        @endforeach
                                    @else
                                        ''
                                    @endif
                                </select>
                                <div class="invalid-feedback">
                                    @error('txt_group')
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
                                <button type="submit" id="addCustomer-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
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


<!-- START MODAL ADD GROUP -->
<div class="modal fade" id="ModalAddGroup" tabindex="-1" aria-labelledby="newGroupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="/esa-app/group">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="name-input" class="form-label">Name Group</label>
                                <input type="text" name="txt_name_group" id="name-input" class="form-control @error('txt_name_group') is-invalid @enderror" placeholder="Enter Group Name" value="{{ old('txt_name_group') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_name_group')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="addGroup-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
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
<!-- END MODAL ADD GROUP -->


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
                            <label for="group-input" class="form-label">Group</label>
                            <select name="txt_group" id="id_group_privilege" class="form-select @error('txt_group') is-invalid @enderror" required>
                                <option value="">--- Choose Group ---</option>
                                @if ($active === 'privilege')
                                    @foreach ( $var_show_group as $item_group )
                                        <option value="{{ $item_group->id }}">{{ $item_group->name_group }}</option>
                                    @endforeach
                                @else
                                    ''
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                @error('txt_group')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="email-input" class="form-label">Rule Permission</label><br>
                                <input type="checkbox" id="filter_administrator" name="txt_permission[]" value="1" class="" /> Administrator Menu<br>
                                <input type="checkbox" id="filter_view_user" name="txt_permission[]" value="2" class="" disabled/> View User Menu<br>
                                <input type="checkbox" id="filter_create_user" name="txt_permission[]" value="3" class="" disabled/> Create User<br>
                                <input type="checkbox" id="filter_delete_user" name="txt_permission[]" value="4" class="" disabled/> Delete User<br>
                                <input type="checkbox" id="filter_view_privilege" name="txt_permission[]" value="5" class="" disabled/> View Privilege Menu<br>
                                <input type="checkbox" id="filter_create_privilege" name="txt_permission[]" value="6" class="" disabled/> Create Privilege<br>
                                <input type="checkbox" id="filter_delete_privilege" name="txt_permission[]" value="7" class="" disabled/> Delete Privilege<br>
                                <input type="checkbox" id="filter_view_group" name="txt_permission[]" value="8" class="" disabled/> View Group Menu<br>
                                <input type="checkbox" id="filter_create_group" name="txt_permission[]" value="9" class="" disabled/> Create Group<br>
                                <input type="checkbox" id="filter_delete_group" name="txt_permission[]" value="10" class="" disabled/> Delete Group<br>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="addGroup-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Cancel</button>
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
                <form action="/esa-app/logout" method="POST">
                    @csrf
                    <button type="submit" id="logout-btn" class="btn btn-sm rounded-pill btn-danger">Logout</button>
                </form>
                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LOGOUT -->

<script>


    
    </script>

