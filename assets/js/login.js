$(document).ready(function () {
    userLogin();
    findAccount();
    resetPassword();
    verifyEmail();
    createNewPassword();
});

function userLogin() {
    $(document).on("submit", "#formLogin", function (event) {
        event.preventDefault();
        var form = $(this);
        var userEmail = form.find("#userEmail").val();
        var userPassword = form.find("#userPassword").val();
        form.find(".success-message, .error-message").remove();

        $.ajax({
            method: "POST",
            url: "actions/user-login.php",
            data: { userEmail, userPassword },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var successMessage = $(
                        "<div class='alert alert-success p-2 text-center m-0 mt-4 success-message'>Login Successfully!</div>"
                    );

                    form.append(successMessage);
                    $("button, input").prop("disabled", true);
                    $("a")
                        .addClass("disabled")
                        .on("click", function (e) {
                            e.preventDefault();
                        });

                    if (response.user_type === "user") {
                        successMessage.fadeOut(3000, function () {
                            window.location.href = "user/homepage";
                        });
                    } else if (response.user_type === "staff") {
                        successMessage.fadeOut(3000, function () {
                            window.location.href = "staff/homepage";
                        });
                    } else if (response.user_type === "admin") {
                        successMessage.fadeOut(3000, function () {
                            window.location.href = "admin/dashboard";
                        });
                    } else {
                        var errorMessage = $(
                            "<div class='alert alert-danger p-2 text-center m-0 mt-4 error-message'>Account not found</div>"
                        );
                        form.append(errorMessage);
                        errorMessage.fadeOut(3500);
                    }
                } else {
                    var errorMessage = $(
                        "<div class='alert alert-danger p-2 text-center m-0 mt-4 error-message'>" +
                            response.message +
                            "</div>"
                    );

                    form.append(errorMessage);
                    errorMessage.fadeOut(4000);
                }
            },
            error: function (xhr, status, error) {
                var errorMessage = $(
                    "<div class='alert alert-danger p-2 text-center m-0 mt-4 error-message'>An error occurred. Please try again later.</div>"
                );
                form.append(errorMessage);
                errorMessage.fadeOut(4000);
                console.log("AJAX Error:", error);
            },
        });
    });
}

function findAccount() {
    $(document).on("click", ".btn-find", function () {
        var modalContent = $(this).closest(".modal-content");
        var user_account = $(this)
            .closest(".modal-content")
            .find("#findEmail")
            .val();

        var messageContainer = modalContent.find(".message-container");
        messageContainer.find(".success-message, .error-message").hide();

        $.ajax({
            method: "POST",
            url: "actions/fetch-user-account.php",
            data: { user_account, user_account },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var newModalContent = `
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid p-0">
                                    <div class="row mb-2">
                                        <div class="col">
                                            <div class="user-photo text-center">
                                                <img src="assets/img/users/${response.account_info.user_photo}" height="120px" width="120px" alt="Img">
                                                <p class="fw-bold">${response.account_info.user_name}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <p class="fw-light">Is this your account? If it is, please type 'yes' to confirm: <span><input type="text" class="" id="userConfirmaton"></span></p>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button type="button" class="btn btn-success btn-reset-password w-100" data-user-id="${response.account_info.user_id}">Reset Password</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="message-container d-flex justify-content-center mt-2"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    modalContent.find("button, input").prop("disabled", true);

                    modalContent.fadeOut(2500, function () {
                        modalContent.replaceWith(newModalContent);
                        modalContent.fadeIn(2500);
                    });
                } else {
                    var errorMessage = $(
                        "<div class='alert alert-danger error-message text-center w-100 mb-0 p-2 px-4 mb-3' role='alert'>" +
                            response.message +
                            "</div>"
                    );
                    $(".error-message").remove();
                    $(".message-container").prepend(errorMessage);
                    errorMessage.fadeOut(3500);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}

function resetPassword() {
    $(document).on("click", ".btn-reset-password", function () {
        var modalContent = $(this).closest(".modal-content");
        var user_id = $(this).data("user-id");
        var user_confirmation = $(this)
            .closest(".modal-content")
            .find("#userConfirmaton")
            .val();

        var messageContainer = modalContent.find(".message-container");
        messageContainer.find(".success-message, .error-message").hide();

        $.ajax({
            method: "POST",
            url: "actions/user-reset-password.php",
            data: { user_id, user_id, user_confirmation: user_confirmation },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var newModalContent = `
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid p-0">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" id="inputCode" class="form-control" autocomplete="off" required>
                                                <label for="inputCode">Verification Code</label>
                                                <div class="valid-feedback">Verification code is valid!</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button type="button" class="btn btn-success btn-verify w-100" data-user-id="${user_id}">Verify</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="message-container d-flex justify-content-center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    modalContent.find("button, input").prop("disabled", true);

                    modalContent.fadeOut(2500, function () {
                        modalContent.replaceWith(newModalContent);
                        modalContent.fadeIn(2500);
                    });
                } else {
                    var errorMessage = $(
                        "<div class='alert alert-danger error-message text-center mt-2 w-100 mb-0 p-2 px-4' role='alert'>" +
                            response.message +
                            "</div>"
                    );
                    $(".error-message").remove();
                    $(".message-container").append(errorMessage);
                    errorMessage.fadeOut(3000);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}

function verifyEmail() {
    $(document).on("click", ".btn-verify", function () {
        var modalContent = $(this).closest(".modal-content");
        var verification_code = modalContent.find("#inputCode").val();
        var user_id = $(this).data("user-id");

        var messageContainer = modalContent.find(".message-container");
        messageContainer.find(".success-message, .error-message").hide();

        $.ajax({
            method: "POST",
            url: "actions/user-verify-code.php",
            data: { verification_code: verification_code },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var newModalContent = `
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="container-fluid p-0">
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="password" id="newPassword" class="form-control" autocomplete="off">
                                                <label for="newPassword">New Password</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="password" id="confirmNewPassword" class="form-control" autocomplete="off">
                                                <label for="confirmNewPassword">Confirm New Password</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col">
                                            <button type="button" class="btn btn-success submit-new-password w-100" data-user-id="${user_id}">Submit</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="message-container d-flex justify-content-center"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    modalContent.find("button, input").prop("disabled", true);

                    modalContent.fadeOut(2500, function () {
                        modalContent.replaceWith(newModalContent);
                        modalContent.fadeIn(2500);
                    });
                } else {
                    var errorMessage = $(
                        "<div class='alert alert-danger error-message text-center w-100 mb-0 p-2 px-4' role='alert'>" +
                            response.message +
                            "</div>"
                    );
                    $(".error-message").remove();
                    $(".message-container").append(errorMessage);
                    errorMessage.fadeOut(3000);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}

function createNewPassword() {
    $(document).on("click", ".submit-new-password", function () {
        var modalContent = $(this).closest(".modal-content");
        var user_id = $(this).data("user-id");
        var new_password = $(this)
            .closest(".modal-content")
            .find("#newPassword")
            .val();
        var confirm_new_password = $(this)
            .closest(".modal-content")
            .find("#confirmNewPassword")
            .val();

        var messageContainer = modalContent.find(".message-container");
        messageContainer.find(".success-message, .error-message").hide();

        $.ajax({
            method: "POST",
            url: "actions/user-create-new-password.php",
            data: {
                new_password: new_password,
                confirm_new_password: confirm_new_password,
                user_id: user_id,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    modalContent.find("button, input").prop("disabled", true);

                    var successMessage = $(
                        "<div class='alert alert-success success-message text-center mt-2 w-100 mb-0 p-2 px-4' role='alert'>" +
                            response.message +
                            "</div>"
                    );
                    $(".success-message").remove();
                    $(".message-container").append(successMessage);
                    successMessage.fadeOut(3000);

                    setTimeout(function () {
                        window.location.reload();
                    }, 3000);
                } else {
                    var errorMessage = $(
                        "<div class='alert alert-danger error-message text-center mt-2 w-100 mb-0 p-2 px-4' role='alert'>" +
                            response.message +
                            "</div>"
                    );
                    $(".error-message").remove();
                    $(".message-container").append(errorMessage);
                    errorMessage.fadeOut(3000);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            },
        });
    });
}
