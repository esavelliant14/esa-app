<!-- START MODAL ADD USER -->
<div class="modal fade" id="ModalAddUser" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('user.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="txt_name" id="name_add_user" class="form-control @error('txt_name') is-invalid @enderror" placeholder="Enter name" value="{{ old('txt_name') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="txt_email" id="email-input-add-user" class="form-control @error('txt_email') is-invalid @enderror" placeholder="Enter email" value="{{ old('txt_email') }}" required />
                                <div class="invalid-feedback">
                                    @error('txt_email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Group</label>
                                <select name="txt_group" id="id_group_add_user" class="form-select @error('txt_group') is-invalid @enderror" required>
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
                                <label class="form-label">Privilege</label>
                                <select name="txt_privilege" id="id_privilege_add_user" class="form-select @error('txt_privileged') is-invalid @enderror" required>
                                    <option value="">--- Choose Privilege ---</option>
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
                                <label class="form-label">Status</label>
                                <select name="txt_status"  class="form-select @error('txt_status') is-invalid @enderror" required>
                                    <option value="">--- Choose Status ---</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    <div class="invalid-feedback">
                                        @error('txt_status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="txt_password"  class="form-control @error('txt_password') is-invalid @enderror" placeholder="Enter password" required />
                                <div class="invalid-feedback">
                                    @error('txt_password')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Repeat Password</label>
                                <input type="password" name="txt_password_confirmation"  class="form-control @error('txt_password_confirmation') is-invalid @enderror" placeholder="Enter password" required />
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
                <form method="post" action="{{ route('group.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name Group</label>
                                <input type="text" name="txt_name_group" id="name_input_add_user" class="form-control @error('txt_name_group') is-invalid @enderror" placeholder="Enter Group Name" value="{{ old('txt_name_group') }}"required />
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
                <form method="post" action="{{ route('privilege.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name Privilege</label>
                                <input type="text" name="txt_name_privilege" id="name_input_add_privilege" class="form-control @error('txt_name_privilege') is-invalid @enderror" placeholder="Enter privilege name" value="{{ old('txt_name_privilege') }}" required />
                                <div class="invalid-feedback">
                                    @error('txt_name_privilege')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
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
                        </div>
                        <div class="row">
                            <!-- Rule Permission Section (Left Column) -->
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label class="form-label">User Permission</label><br>
                                    <input type="checkbox" id="filter_administrator" name="txt_permission[]" value="1" class="" /> Administrator Menu<br>
                                    <input type="checkbox" id="filter_view_user" name="txt_permission[]" value="2" class="" disabled/> View User Menu<br>
                                    <input type="checkbox" id="filter_create_user" name="txt_permission[]" value="3" class="" disabled/> Create User<br>
                                    <input type="checkbox" id="filter_delete_user" name="txt_permission[]" value="4" class="" disabled/> Delete User<br>
                                    <input type="checkbox" id="filter_edit_user" name="txt_permission[]" value="11" class="" disabled/> Edit User<br>
                                    <input type="checkbox" id="filter_reset_user" name="txt_permission[]" value="12" class="" disabled/> Reset User<br>
                                    <input type="checkbox" id="filter_view_privilege" name="txt_permission[]" value="5" class="" disabled/> View Privilege Menu<br>
                                    <input type="checkbox" id="filter_create_privilege" name="txt_permission[]" value="6" class="" disabled/> Create Privilege<br>
                                    <input type="checkbox" id="filter_delete_privilege" name="txt_permission[]" value="7" class="" disabled/> Delete Privilege<br>
                                    <input type="checkbox" id="filter_edit_privilege" name="txt_permission[]" value="13" class="" disabled/> Edit Privilege<br>
                                    <input type="checkbox" id="filter_view_group" name="txt_permission[]" value="8" class="" disabled/> View Group Menu<br>
                                    <input type="checkbox" id="filter_create_group" name="txt_permission[]" value="9" class="" disabled/> Create Group<br>
                                    <input type="checkbox" id="filter_delete_group" name="txt_permission[]" value="10" class="" disabled/> Delete Group<br>
                                    <input type="checkbox" id="filter_view_log" name="txt_permission[]" value="14" class="" disabled/> View Log<br>
                                </div>
                            </div>

                            <!-- Menu Permission Section (Right Column) -->
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label class="form-label">Menu Permission</label><br>
                                    <input type="checkbox" id="filter_menu_viewnas" name="txt_permission[]" value="50" class="" disabled/> View Nas Menu<br>
                                    <input type="checkbox" id="filter_menu_nasrouter" name="txt_permission[]" value="51" class="" disabled/> View Nas Router<br>
                                    <input type="checkbox" id="filter_menu_full_nasrouter" name="txt_permission[]" value="52" class="" disabled/> Full Access Nas Router<br>
                                    <input type="checkbox" id="filter_menu_nasattribute" name="txt_permission[]" value="53" class="" disabled/> View Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_full_nasattribute" name="txt_permission[]" value="54" class="" disabled/> Full Access Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_nasusers" name="txt_permission[]" value="55" class="" disabled/> View Nas Users<br>
                                    <input type="checkbox" id="filter_menu_full_nasusers" name="txt_permission[]" value="56" class="" disabled/> Full Access Nas Users<br>
                                    <input type="checkbox" id="filter_menu_enabledisable_nasusers" name="txt_permission[]" value="57" class="" disabled/> Disable Enable Nas Users<br>
                                    <input type="checkbox" id="filter_menu_nasprofiles" name="txt_permission[]" value="58" class="" disabled/> View Nas Profiles<br>
                                    <input type="checkbox" id="filter_menu_full_nasprofiles" name="txt_permission[]" value="59" class="" disabled/> Full Access Nas Profiles<br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="addPrivilege-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
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


<!-- START MODAL EDIT PRIVILEGE GROUP ADMIN-->
<div class="modal fade" id="ModalEditPrivilege" tabindex="-1" aria-labelledby="editPrivilegeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPrivilegeModalLabel">Edit Privilege</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('privilege.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name Privilege</label>
                                <input type="text" name="txt_name_privilege" id="varPrivilegeName" class="form-control @error('txt_name_privilege') is-invalid @enderror" placeholder="Enter privilege name" value="{{ old('txt_name_privilege') }}"required readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <input class="form-control" type="text" name="txt_group" id="varPrivilegeGroup" required readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">   
                                <div class="my-3">
                                    <label class="form-label">User Permission</label><br>
                                    <input type="checkbox" id="filter_edit_administrator" name="txt_permission[]" value="1" class="" /> Administrator Menu<br>
                                    <input type="checkbox" id="filter_edit_view_user" name="txt_permission[]" value="2" class="" disabled/> View User Menu<br>
                                    <input type="checkbox" id="filter_edit_create_user" name="txt_permission[]" value="3" class="" disabled/> Create User<br>
                                    <input type="checkbox" id="filter_edit_delete_user" name="txt_permission[]" value="4" class="" disabled/> Delete User<br>
                                    <input type="checkbox" id="filter_edit_edit_user" name="txt_permission[]" value="11" class="" disabled/> Edit User<br>
                                    <input type="checkbox" id="filter_edit_reset_user" name="txt_permission[]" value="12" class="" disabled/> Reset User<br>
                                    <input type="checkbox" id="filter_edit_view_privilege" name="txt_permission[]" value="5" class="" disabled/> View Privilege Menu<br>
                                    <input type="checkbox" id="filter_edit_create_privilege" name="txt_permission[]" value="6" class="" disabled/> Create Privilege<br>
                                    <input type="checkbox" id="filter_edit_delete_privilege" name="txt_permission[]" value="7" class="" disabled/> Delete Privilege<br>
                                    <input type="checkbox" id="filter_edit_edit_privilege" name="txt_permission[]" value="13" class="" disabled/> Edit Privilege<br>
                                    <input type="checkbox" id="filter_edit_view_group" name="txt_permission[]" value="8" class="" disabled/> View Group Menu<br>
                                    <input type="checkbox" id="filter_edit_create_group" name="txt_permission[]" value="9" class="" disabled/> Create Group<br>
                                    <input type="checkbox" id="filter_edit_delete_group" name="txt_permission[]" value="10" class="" disabled/> Delete Group<br>
                                    <input type="checkbox" id="filter_edit_view_log" name="txt_permission[]" value="14" class="" disabled/> View Log<br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label class="form-label">Menu Permission</label><br>
                                    <input type="checkbox" id="filter_menu_viewnas" name="txt_permission[]" value="50" class="" disabled/> View Nas Menu<br>
                                    <input type="checkbox" id="filter_menu_nasrouter" name="txt_permission[]" value="51" class="" disabled/> View Nas Router<br>
                                    <input type="checkbox" id="filter_menu_full_nasrouter" name="txt_permission[]" value="52" class="" disabled/> Full Access Nas Router<br>
                                    <input type="checkbox" id="filter_menu_nasattribute" name="txt_permission[]" value="53" class="" disabled/> View Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_full_nasattribute" name="txt_permission[]" value="54" class="" disabled/> Full Access Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_nasusers" name="txt_permission[]" value="55" class="" disabled/> View Nas Users<br>
                                    <input type="checkbox" id="filter_menu_full_nasusers" name="txt_permission[]" value="56" class="" disabled/> Full Access Nas Users<br>
                                    <input type="checkbox" id="filter_menu_enabledisable_nasusers" name="txt_permission[]" value="57" class="" disabled/> Disable Enable Nas Users<br>
                                    <input type="checkbox" id="filter_menu_nasprofiles" name="txt_permission[]" value="58" class="" disabled/> View Nas Profiles<br>
                                    <input type="checkbox" id="filter_menu_full_nasprofiles" name="txt_permission[]" value="59" class="" disabled/> Full Access Nas Profiles<br>
                                </div>
                            </div>

                        </div>
                        <input type="text" id="varPrivilegeId" name="txt_id" readonly required hidden>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="editPrivilege-btn" class="btn btn-sm rounded-pill btn-success">Update</button>
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
<!-- END MODAL EDIT PRIVILEGE GROUP ADMIN -->



{{-- MODAL VIEW PERMISSION PRIVILEGE --}}
<div class="modal fade" id="ModalViewPermissionPrivilege" tabindex="-1" aria-labelledby="viewPermissionPrivilegeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewPermissionPrivilegeModalLabel">View Privilege</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name Privilege</label>
                                <input type="text" name="txt_name_privilege" id="varPermissionPrivilegeName" class="form-control @error('txt_name_privilege') is-invalid @enderror" placeholder="Enter privilege name" value="{{ old('txt_name_privilege') }}"required readonly />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Group</label>
                            <input class="form-control" type="text" name="txt_group" id="varPermissionPrivilegeGroup" required readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label class="form-label">User Permission</label><br>
                                    <input type="checkbox" id="filter_edit_administrator" name="txt_permission[]" value="1" class="" disabled/> Administrator Menu<br>
                                    <input type="checkbox" id="filter_edit_view_user" name="txt_permission[]" value="2" class="" disabled/> View User Menu<br>
                                    <input type="checkbox" id="filter_edit_create_user" name="txt_permission[]" value="3" class="" disabled/> Create User<br>
                                    <input type="checkbox" id="filter_edit_delete_user" name="txt_permission[]" value="4" class="" disabled/> Delete User<br>
                                    <input type="checkbox" id="filter_edit_edit_user" name="txt_permission[]" value="11" class="" disabled/> Edit User<br>
                                    <input type="checkbox" id="filter_edit_reset_user" name="txt_permission[]" value="12" class="" disabled/> Reset User<br>
                                    <input type="checkbox" id="filter_edit_view_privilege" name="txt_permission[]" value="5" class="" disabled/> View Privilege Menu<br>
                                    <input type="checkbox" id="filter_edit_create_privilege" name="txt_permission[]" value="6" class="" disabled/> Create Privilege<br>
                                    <input type="checkbox" id="filter_edit_delete_privilege" name="txt_permission[]" value="7" class="" disabled/> Delete Privilege<br>
                                    <input type="checkbox" id="filter_edit_edit_privilege" name="txt_permission[]" value="7" class="" disabled/> Edit Privilege<br>
                                    <input type="checkbox" id="filter_edit_view_group" name="txt_permission[]" value="8" class="" disabled/> View Group Menu<br>
                                    <input type="checkbox" id="filter_edit_create_group" name="txt_permission[]" value="9" class="" disabled/> Create Group<br>
                                    <input type="checkbox" id="filter_edit_delete_group" name="txt_permission[]" value="10" class="" disabled/> Delete Group<br>
                                    <input type="checkbox" id="filter_view_log" name="txt_permission[]" value="14" class="" disabled/> View Log<br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="my-3">
                                    <label class="form-label">Menu Permission</label><br>
                                    <input type="checkbox" id="filter_menu_viewnas" name="txt_permission[]" value="50" class="" disabled/> View Nas Menu<br>
                                    <input type="checkbox" id="filter_menu_nasrouter" name="txt_permission[]" value="51" class="" disabled/> View Nas Router<br>
                                    <input type="checkbox" id="filter_menu_full_nasrouter" name="txt_permission[]" value="52" class="" disabled/> Full Access Nas Router<br>
                                    <input type="checkbox" id="filter_menu_nasattribute" name="txt_permission[]" value="53" class="" disabled/> View Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_full_nasattribute" name="txt_permission[]" value="54" class="" disabled/> Full Access Nas Attribute<br>
                                    <input type="checkbox" id="filter_menu_nasusers" name="txt_permission[]" value="55" class="" disabled/> View Nas Users<br>
                                    <input type="checkbox" id="filter_menu_full_nasusers" name="txt_permission[]" value="56" class="" disabled/> Full Access Nas Users<br>
                                    <input type="checkbox" id="filter_menu_enabledisable_nasusers" name="txt_permission[]" value="57" class="" disabled/> Disable Enable Nas Users<br>
                                    <input type="checkbox" id="filter_menu_nasprofiles" name="txt_permission[]" value="58" class="" disabled/> View Nas Profiles<br>
                                    <input type="checkbox" id="filter_menu_full_nasprofiles" name="txt_permission[]" value="59" class="" disabled/> Full Access Nas Profiles<br>
                                </div>
                            </div>

                        </div>
                        <input type="text" id="varPermissionPrivilegeId" name="txt_id" readonly required hidden>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
{{-- END MODAL VIEW PERMISSION PRIVILEGE --}}


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
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="logout-btn" class="btn btn-sm rounded-pill btn-danger">Logout</button>
                </form>
                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END MODAL LOGOUT -->


<!-- START MODAL EDIT USER -->
<div class="modal fade" id="ModalEditUser" tabindex="-1" aria-labelledby="editCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCustomerModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('user.update') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="txt_name" id="varName" class="form-control @error('txt_name') is-invalid @enderror" placeholder="Enter name" required readonly />
                                <div class="invalid-feedback">
                                    @error('txt_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="txt_email" id="varEmail" class="form-control @error('txt_email') is-invalid @enderror" placeholder="Enter email" readonly required />
                                <div class="invalid-feedback">
                                    @error('txt_email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Group</label>
                                <input type="text" name="txt_group" id="varGroup" class="form-control @error('txt_group') is-invalid @enderror" placeholder="Enter group" readonly required />
                                <div class="invalid-feedback">
                                    @error('txt_group')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Privilege</label>
                                <select name="txt_privilege" id="varPrivilege" class="form-select @error('txt_privileged') is-invalid @enderror" required>
                                    <option value="" >--- Choose Privilege ---</option>
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
                                <label class="form-label">Status</label>
                                <select name="txt_status" id="varStatus" class="form-select @error('txt_status') is-invalid @enderror" required>
                                    <option value="">--- Choose Status ---</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                    <div class="invalid-feedback">
                                        @error('txt_status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </select>
                            </div>
                        </div>
                        <input type="text" id="varGroupId" hidden>
                        <input type="text" name="txt_id" id="varId" hidden>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="editCustomer-btn" class="btn btn-sm rounded-pill btn-success">Update</button>
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
<!-- END MODAL EDIT USER -->

{{-- START MODAL VIEW LOG --}}
<div class="modal fade" id="ModalViewLog" tabindex="-1" aria-labelledby="viewLogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewLogModalLabel">View Log</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Action By</label>
                                <input type="text" id="varLogActionBy" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <input type="text" id="varLogCategory" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">IP Address</label>
                                <input type="text" id="varLogIpAddress" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <input type="text" id="varLogStatus" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Agent</label>
                                <input type="text" id="varLogAgent" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Details</label>
                                <textarea id="varLogDetails" class="form-control" required readonly></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Created at</label>
                                <input type="text" id="varLogCreatedAt" class="form-control" required readonly />
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-danger" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- end modal body -->
        </div>
        <!-- end modal-content -->
    </div>
    <!-- end modal-dialog -->
</div>
{{-- END MODAL VIEW LOG --}}

<!-- START MODAL ADD BWM ROUTER -->
<div class="modal fade" id="ModalAddBwmRouter" tabindex="-1" aria-labelledby="newBwmRouterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add BWM Router</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('bwmrtr.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Router Hostname</label>
                                <input type="text" name="txt_hostname" id="name_input_hostname" class="form-control @error('txt_hostname') is-invalid @enderror" placeholder="Enter Router Hostname" value="{{ old('txt_hostname') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_hostname')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">IP Address</label>
                                <input type="text" name="txt_ip_address" id="name_input_ip_address" class="form-control @error('txt_ip_address') is-invalid @enderror" placeholder="Enter IP Address" value="{{ old('txt_ip_address') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_ip_address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Interface</label>
                                <input type="text" name="txt_interface" id="name_input_interface" class="form-control @error('txt_interface') is-invalid @enderror" placeholder="Enter Interface" value="{{ old('txt_interface') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_interface')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Brand</label>
                                <select name="txt_brand" class="form-select" required>
                                    <option value="">--- Choose Brand ---</option>
                                    <option value="Juniper">Juniper</option>
                                    <option value="Mikrotik">MikroTik</option>
                                    <option value="H3C">H3C</option>
                                    <option value="Cisco">Cisco</option>
                                    <option value="Huawei">Huawei</option>
                                </select>
                            </div>
                            <input type="text" name="txt_id_group" value="{{ auth()->user()->id_group }}" readonly hidden>
                            <input type="text" name="txt_id_user" value="{{ auth()->user()->id }}" readonly hidden>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="addBwmRtr-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
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
<!-- END MODAL ADD BWM ROUTER -->


<!-- START MODAL ADD BWM BW -->
<div class="modal fade" id="ModalAddBwmBw" tabindex="-1" aria-labelledby="newBwmRouterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add BWM Bw</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('bwmbw.post') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label">Router Hostname</label>
                                <select name="txt_hostname" class="form-select" id="id_search_hostname" required>
                                    <option value="">--- Choose Hostname ---</option>
                                    {{-- @foreach ( $hostnames as $hostname ) --}}
                                        {{-- <option value="{{ $hostname }}">{{ $hostname }}</option> --}}
                                    {{-- @endforeach --}}
                                </select>
                                <div class="invalid-feedback">
                                    @error('txt_hostname')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Policer Name</label>
                                <input type="text" name="txt_policer_name" id="name_input_policer_name" class="form-control @error('txt_policer_name') is-invalid @enderror" placeholder="Enter Policer Name" value="{{ old('txt_policer_name') }}"required />
                                <div class="invalid-feedback">
                                    @error('txt_policer_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Bandwidth</label>
                                    <input type="text" 
                                        name="txt_bandwidth" 
                                        id="name_input_bandwidth" 
                                        class="form-control @error('txt_bandwidth') is-invalid @enderror" 
                                        placeholder="Enter Bandwidth" 
                                        value="{{ old('txt_bandwidth') }}" required>
                                    <div class="invalid-feedback">
                                        @error('txt_bandwidth')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Unit</label>
                                    <select name="txt_bandwidth_unit" class="form-select @error('txt_bandwidth_unit') is-invalid @enderror" required>
                                        <option value="">--- Select Unit ---</option>
                                        <option value="k">kbps</option>
                                        <option value="m">Mbps</option>
                                        <option value="g">Gbps</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('txt_bandwidth_unit')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Burst Limit</label>
                                    <input type="text" 
                                        name="txt_burst_limit" 
                                        id="name_input_bandwidth" 
                                        class="form-control @error('txt_burst_limit') is-invalid @enderror" 
                                        placeholder="Enter Burst Limit" 
                                        value="{{ old('txt_burst_limit') }}" required>
                                    <div class="invalid-feedback">
                                        @error('txt_burst_limit')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Unit</label>
                                    <select name="txt_burst_limit_unit" class="form-select @error('txt_burst_limit_unit') is-invalid @enderror" required>
                                        <option value="">--- Select Unit ---</option>
                                        <option value="k">kbps</option>
                                        <option value="m">Mbps</option>
                                        <option value="g">Gbps</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        @error('txt_burst_limit_unit')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <input type="text" name="txt_id_group" value="{{ auth()->user()->id_group }}" readonly hidden>
                            <input type="text" name="txt_id_user" value="{{ auth()->user()->id }}" readonly hidden>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" id="addBwmRtr-btn" class="btn btn-sm rounded-pill btn-success">Add</button>
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
<!-- END MODAL ADD BWM BW -->


<script>
window.userGroupId = "{{ auth()->user()->id_group }}";

    
</script>

