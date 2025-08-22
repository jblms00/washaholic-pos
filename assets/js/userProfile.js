$(document).ready(function () {
    var userProfileUrl = $("body").data("user-profile");
    $(".profile-pic").css(
        "background-image",
        "url(../assets/images/userProfile/" + userProfileUrl + ")"
    );

    $("#fileToUpload").on("change", function (event) {
        var imageUrl = URL.createObjectURL(event.target.files[0]);
        $(".profile-pic").css("background-image", "url(" + imageUrl + ")");
    });

    updateProfile();
});

function updateProfile() {
    $(document).on("click", ".update-profile", function () {
        var formData = new FormData();
        formData.append("fileToUpload", $("#fileToUpload")[0].files[0]);
        formData.append("userName", $("#userName").val());
        formData.append("userEmail", $("#userEmail").val());
        formData.append("userPhoneNumber", $("#userPhoneNumber").val());
        formData.append("userStreetAddress", $("#userStreetAddress").val());
        formData.append("userTownCity", $("#userTownCity").val());
        formData.append("userZipCode", $("#userZipCode").val());

        $.ajax({
            url: "../actions/user-update-profile.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                var toastMessage = $("#liveToast .toast-body p");
                if (response.status === "success") {
                    $("button, input").prop("disabled", true);
                    $("a")
                        .addClass("disabled")
                        .on("click", function (e) {
                            e.preventDefault();
                        });

                    toastMessage
                        .text(response.message)
                        .addClass("text-success")
                        .removeClass("text-danger");
                    $("#liveToast").toast("show");

                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    toastMessage
                        .text(response.message)
                        .addClass("text-danger")
                        .removeClass("text-success");
                    $("#liveToast").toast("show");
                }
            },
            error: function (xhr, status, error) {
                var toastMessage = $("#liveToast .toast-body p");
                toastMessage
                    .text("An error occurred: " + error)
                    .addClass("text-danger")
                    .removeClass("text-success");
                $("#liveToast").toast("show");
            },
        });
    });
}
