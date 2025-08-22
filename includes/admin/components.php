<!-- Toast -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast text-white bg-light" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-center">
            <p class="mb-0 fw-bold"></p>
        </div>
    </div>
</div>
<!-- Add New User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addUserForm">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="addUserModalLabel">Add New <span class="modal-user-type"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="userName" placeholder="Complete Name">
                        <label for="userName">Complete Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="userEmail" placeholder="name@example.com">
                        <label for="userEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="userPhone" placeholder="Phone Number">
                        <label for="userPhone">Phone Number</label>
                    </div>
                    <select class="form-select" id="userStatus" aria-label="Default select example">
                        <option selected disabled>Please select user status</option>
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer border-0 py-1">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary py-0">Create User</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer border-0 py-1">
                <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger py-0" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>