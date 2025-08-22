$(document).ready(function () {
    $(".home-section table").DataTable({
        autoWidth: false,
        columnDefs: [
            { width: "20%", targets: 0 },
            { width: "25%", targets: 1 },
            { width: "15%", targets: 2 },
            { width: "20%", targets: 3 },
            { width: "20%", targets: 4 },
        ],
    });

    displayUsers();

    $(document).on("click", ".btn-danger", function () {
        var userId = $(this).closest("tr").data("userid");
        $("#confirmDeleteBtn").data("userid", userId);
        $("#deleteModal").modal("show");
    });

    $("#confirmDeleteBtn").click(function () {
        var userId = $(this).data("userid");
        deleteUser(userId);
    });

    $(document).on("change", ".form-user-status", function () {
        var userId = $(this).closest("tr").data("userid");
        var newStatus = $(this).val();
        updateUserStatus(userId, newStatus);
    });

    $(".btn-add").click(function () {
        var pageTitle = $(".home-section").data("page-title");
        var capitalizedPageTitle =
            pageTitle.charAt(0).toUpperCase() +
            pageTitle.slice(1).toLowerCase();

        $(".modal-user-type").text(capitalizedPageTitle);
        $("#addUserModal").modal("show");
    });

    $(document).on("click", ".btn-assign", function () {
        $("#assignStaffModal").modal("show");
        var staffId = $(this).data("staff-id");
        $("#assignStaffModal .modal-content").attr("data-staff-id", staffId);
        displayCustomersNeedSupport();
    });

    addNewUser();
    assignSelectedCustomers();
});

var toastMessage = $("#liveToast .toast-body p");

function displayUsers() {
    var userType = $(".home-section").data("page-title");
    $.ajax({
        url: "../actions/get-users.php",
        type: "GET",
        data: { userType: userType },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var tableBody = $(".home-section table tbody");
                tableBody.empty();

                if (response.users.length === 0) {
                    var noDataRow = `<tr><td colspan="5" class="text-center text-danger">No data found</td></tr>`;
                    tableBody.append(noDataRow);
                } else {
                    response.users.forEach(function (user) {
                        var statusBadgeClass =
                            user.user_status === "active"
                                ? "text-bg-success"
                                : "text-bg-danger";
                        var statusBadge = `<span class="badge rounded-pill ${statusBadgeClass}">${
                            user.user_status.charAt(0).toUpperCase() +
                            user.user_status.slice(1)
                        }</span>`;

                        var additionalField = "";
                        if (userType === "staff") {
                            additionalField = `
                                <div class="d-flex align-items-center justify-content-center gap-3">
                                    <button class="btn btn-sm btn-primary btn-assign" data-staff-id="${user.user_id}">Assign</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            `;
                        } else {
                            additionalField = `<button class="btn btn-sm btn-danger">Delete</button>`;
                        }

                        var row = `
                            <tr data-userid="${user.user_id}">
                                <td>${user.user_name}</td>
                                <td>${user.user_email}</td>
                                <td>${statusBadge}</td>
                                <td>${user.date_created}</td>
                                <td>
                                    <select class="form-select mb-2 form-user-status" aria-label="Default select example">
                                        <option selected disabled>Please select status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    ${additionalField}
                                </td>
                            </tr>`;
                        tableBody.append(row);
                    });
                }
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function deleteUser(userId) {
    $.ajax({
        url: "../actions/delete-user.php",
        type: "POST",
        data: { userId: userId },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                $("#deleteModal").modal("hide");
                displayUsers();

                toastMessage
                    .text(response.message)
                    .addClass("text-success")
                    .removeClass("text-danger");
                $("#liveToast").toast("show");
            } else {
                toastMessage
                    .text(response.message)
                    .addClass("text-danger")
                    .removeClass("text-success");
                $("#liveToast").toast("show");
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function updateUserStatus(userId, newStatus) {
    $.ajax({
        url: "../actions/update-user-status.php",
        type: "POST",
        data: { userId: userId, status: newStatus },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                displayUsers();
                toastMessage
                    .text(response.message)
                    .addClass("text-success")
                    .removeClass("text-danger");
                $("#liveToast").toast("show");
            } else {
                toastMessage
                    .text(response.message)
                    .addClass("text-danger")
                    .removeClass("text-success");
                $("#liveToast").toast("show");
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function addNewUser() {
    $(document).on("submit", "#addUserForm", function (event) {
        event.preventDefault();

        var userName = $("#userName").val().trim();
        var userEmail = $("#userEmail").val().trim();
        var userPhone = $("#userPhone").val().trim();
        var userType = $(".home-section").data("page-title");
        var userStatus = $("#userStatus").val();

        var lastName = userName.split(" ").slice(-1)[0].toLowerCase();
        var lastFourDigits = userPhone.slice(-4);
        var userPassword = userType + lastName + lastFourDigits;

        $.ajax({
            url: "../actions/create-user.php",
            type: "POST",
            dataType: "json",
            data: {
                user_name: userName,
                user_email: userEmail,
                user_phone_number: userPhone,
                user_type: userType,
                user_status: userStatus,
                user_password: userPassword,
            },
            success: function (response) {
                if (response.status === "success") {
                    $("#addUserModal").modal("hide");
                    displayUsers();
                    toastMessage
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");
                } else {
                    toastMessage
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                console.error(error);
            },
        });
    });
}

function displayCustomersNeedSupport() {
    $.ajax({
        url: "../actions/get-customers-need-support.php",
        type: "GET",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var tableBody = $("#customerTableBody");
                tableBody.empty();

                if (response.customers.length === 0) {
                    var noDataRow = `<tr><td colspan="3" class="text-center text-danger">No customers need support</td></tr>`;
                    tableBody.append(noDataRow);
                } else {
                    response.customers.forEach(function (customer) {
                        var row = `
                            <tr data-conversation-id="${customer.conversation_id}">
                                <td><input type="checkbox" data-userid="${customer.user_id}"></td>
                                <td>${customer.user_name}</td>
                                <td>${customer.user_email}</td>
                            </tr>`;
                        tableBody.append(row);
                    });
                }
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function assignSelectedCustomers() {
    $(document).on("click", "#assignSelectedBtn", function () {
        var selectedCustomers = [];
        var conversationIds = [];

        $("#customerTableBody tr").each(function () {
            var checkbox = $(this).find('input[type="checkbox"]:checked');
            if (checkbox.length) {
                var customerId = checkbox.data("userid");
                var conversationId = $(this).data("conversation-id");
                selectedCustomers.push(customerId);
                conversationIds.push(conversationId);
            }
        });

        var staffId = $(this).closest(".modal-content").data("staff-id");

        $.ajax({
            url: "../actions/assign-customers.php",
            type: "POST",
            data: {
                customerIds: selectedCustomers,
                conversationIds: conversationIds,
                staffId: staffId,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");
                    $("#assignStaffModal").modal("hide");
                } else {
                    $("#liveToast .toast-body p")
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
            },
        });
    });
}
