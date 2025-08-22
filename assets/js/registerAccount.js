$(document).ready(function () {
    $(document).on("submit", "#formSignup", function (event) {
        event.preventDefault();
        var form = $(this);

        var fullName = form.find("#fullName").val();
        var email = form.find("#email").val();
        var phoneNumber = form.find("#phoneNumber").val();
        var streetAdress = form.find("#streetAdress").val();
        var townCity = form.find("#townCity").val();
        var zipCode = form.find("#zipCode").val();
        var password = form.find("#password").val();
        var confirmPassword = form.find("#confirmPassword").val();
        var acceptTermsConditions = form
            .find("#acceptTermsConditions")
            .is(":checked");

        form.find(".success-message, .error-message").remove();

        if (!acceptTermsConditions) {
            var errorMessage = $(
                "<div class='alert alert-danger p-2 text-center m-0 mt-4 error-message'>You must accept the Terms of Use & Privacy Policy.</div>"
            );
            form.append(errorMessage);
            errorMessage.fadeOut(4000);
            return;
        }

        $.ajax({
            method: "POST",
            url: "actions/user-signup.php",
            data: {
                fullName: fullName,
                email: email,
                phoneNumber: phoneNumber,
                streetAdress: streetAdress,
                townCity: townCity,
                zipCode: zipCode,
                password: password,
                confirmPassword: confirmPassword,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    var successMessage = $(
                        "<div class='alert alert-success p-2 text-center m-0 mt-4 success-message'>Account created successfully</div>"
                    );
                    form.append(successMessage);
                    $("button, input").prop("disabled", true);
                    $("a")
                        .addClass("disabled")
                        .on("click", function (e) {
                            e.preventDefault();
                        });

                    successMessage.fadeOut(3000, function () {
                        window.location.href = "login";
                    });
                } else {
                    form.append(
                        "<div class='alert alert-danger p-2 text-center m-0 mt-4 error-message'>" +
                            response.message +
                            "</div>"
                    );
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
});
