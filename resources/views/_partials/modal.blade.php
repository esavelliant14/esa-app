<!-- START MODAL ADD USER -->
<div class="modal fade" id="ModalAddUser" tabindex="-1" aria-labelledby="newCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newCustomerModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="hidden" class="form-control" id="userid-input">
                            <div class="mb-3">
                                <label for="username-input" class="form-label">Name</label>
                                <input type="text" id="username-input" class="form-control" placeholder="Enter name" required />
                                <div class="invalid-feedback">Please enter a name.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email-input" class="form-label">Email</label>
                                <input type="email" id="email-input" class="form-control" placeholder="Enter email" required />
                                <div class="invalid-feedback">Please enter email.</div>
                            </div>
                            <div class="mb-3">
                                <label for="phone-input" class="form-label">Company</label>
                                <select name="" id="" class="form-select" required>
                                    <option value="">--- Choose Company ---</option>
                                    <option value="">ESA NET</option>
                                    <option value="">ESA DEV</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="joindate-input" class="form-label">Privileged</label>
                                <select name="" id="" class="form-select" required>
                                    <option value="">--- Choose Privileged ---</option>
                                    <option value="">Administrator</option>
                                    <option value="">Operator</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="email-input" class="form-label">Password</label>
                                <input type="password" id="email-input" class="form-control" placeholder="Enter password" required />
                                <div class="invalid-feedback">Please enter email.</div>
                            </div>
                            <div class="mb-3">
                                <label for="email-input" class="form-label">Repeat Password</label>
                                <input type="password" id="email-input" class="form-control" placeholder="Enter password" required />
                                <div class="invalid-feedback">Please enter email.</div>
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="button" class="btn btn-sm rounded-pill btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" id="addCustomer-btn" class="btn btn-sm rounded-pill btn-success">Add User</button>
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