$(document).ready(function () {
    $(".table-container table").DataTable({
        autoWidth: false,
        columnDefs: [
            { width: "10%", targets: 0 },
            { width: "15%", targets: 1 },
            { width: "15%", targets: 2 },
            { width: "15%", targets: 3 },
            { width: "15%", targets: 4 },
            { width: "15%", targets: 5 },
            { width: "15%", targets: 6 },
        ],
    });

    var urlParams = new URLSearchParams(window.location.search);
    var status = urlParams.get("status") || "Unknown";
    status = status.replace(/-/g, " ");

    console.log(status);

    $(".booking-status").text(
        status
            .replace(/-/g, " ")
            .toLowerCase()
            .replace(/\b\w/g, (char) => char.toUpperCase())
    );

    displayBookings(status);

    $(document).on("click", ".btn-edit", function () {
        var bookingId = $(this).closest("tr").find("td").eq(0).text();
        fetchBookingDetails(bookingId);
    });

    $(document).on("change", "#bookingStatus", function () {
        var status = $(this).val();
        handleStatusChange(status);
    });

    updateBooking();
});

var toastMessage = $("#liveToast .toast-body p");

function displayBookings(status) {
    $.ajax({
        url: "../actions/get-bookings.php",
        type: "GET",
        data: { status: status },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var tableBody = $(".table-container table tbody");
                tableBody.empty();

                if (response.bookings.length === 0) {
                    var noDataRow = `<tr><td colspan="7" class="text-center text-danger">No data found</td></tr>`;
                    tableBody.append(noDataRow);
                } else {
                    response.bookings.forEach(function (booking) {
                        var statusBadgeClass = getStatusBadgeClass(
                            booking.status
                        );
                        var statusBadge = `<span class="badge rounded-pill ${statusBadgeClass}">${booking.status}</span>`;

                        var row = `
                            <tr>
                                <td>${booking.booking_id}</td>
                                <td>${booking.customer_name}</td>
                                <td>${booking.customer_email}</td>
                                <td>₱${booking.total_amount}</td>
                                <td>${capitalizeWords(
                                    booking.payment_method
                                )}</td>
                                <td>${statusBadge}</td>
                                <td>${booking.date_created}</td>
                                <td><button class="btn btn-sm btn-primary btn-edit">Edit</button></td>
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

function fetchBookingDetails(bookingId) {
    $.ajax({
        url: "../actions/get-booking-details.php",
        type: "GET",
        data: { booking_id: bookingId },
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var booking = response.booking;
                var additionalServices = response.additional_services;

                // Separate date and time from created_at
                var createdAtDateTime = booking.created_at.split(" ");
                var createdAtDate = createdAtDateTime[0];
                var createdAtTime = createdAtDateTime[1];
                var additionalColumn = "";
                var additionalField = "";

                if (booking.payment_method === "gcash") {
                    var customStyle = `style="height: 240px;"`;
                    additionalColumn = `
                        <div class="col">
                                <img src="../assets/images/gcashReceipts/${booking.gcash_receipt}" class="object-fit-contain" height="100%" width="300" alt="img">
                        </div>
                    `;
                    additionalField = `
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" placeholder="GCash Reference Number" value="${booking.gcash_reference_number}" disabled>
                            <label class="fw-semibold">GCash Reference Number</label>
                        </div>
                    `;
                }

                // Populate booking details
                var bookingDetailsHtml = `
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="bookingId" value="${
                                    booking.booking_id
                                }" disabled>
                                <label class="fw-semibold">Booking ID</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" class="form-control" placeholder="Book Date" value="${createdAtDate}" disabled>
                                <label class="fw-semibold">Book Date</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="time" class="form-control" placeholder="Book Time" value="${createdAtTime}" disabled>
                                <label class="fw-semibold">Book Time</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Customer Name" value="${
                                    booking.user_name
                                }" disabled>
                                <label class="fw-semibold">Customer Name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Customer Email" value="${
                                    booking.user_email
                                }" disabled>
                                <label class="fw-semibold">Customer Email</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Customer Phone Number" value="${
                                    booking.user_phone_number
                                }" disabled>
                                <label class="fw-semibold">Customer Phone Number</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Total Amount" value="₱${
                                    booking.total_amount
                                }" disabled>
                                <label class="fw-semibold">Total Amount</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Payment Method" value="${capitalizeWords(
                                    booking.payment_method
                                )}" disabled>
                                <label class="fw-semibold">Payment Method</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        ${additionalColumn}
                        <div class="col">
                            ${additionalField}
                            <div class="form-floating">
                                <textarea class="form-control" value="${
                                    booking.message
                                }" ${customStyle} disabled></textarea>
                                <label class="fw-semibold">Message</label>
                            </div>
                        </div>
                    </div>
                `;
                $("#bookingDetails").html(bookingDetailsHtml);

                // Populate additional services table
                var additionalServicesHtml = additionalServices
                    .map(function (service) {
                        return `
                        <tr>
                            <td>${service.extra_wash}</td>
                            <td>${service.extra_dry}</td>
                            <td>${service.extra_rinse}</td>
                            <td>${service.spin_dry}</td>
                        </tr>`;
                    })
                    .join("");
                $("#additionalServicesTable tbody").html(
                    additionalServicesHtml
                );

                $("#modalEditBooking .modal-content").attr(
                    "data-booking-id",
                    booking.booking_id
                );

                $("#modalEditBooking").modal("show");
            } else {
                console.error(response.message);
            }
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
        },
    });
}

function handleStatusChange(status) {
    var additionalFieldsHtml = "";

    if (status === "scheduled for pickup") {
        additionalFieldsHtml = `
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="pickupDate" placeholder="Pickup Date and Time">
                <label for="pickupDate" class="fw-semibold">Pickup Date and Time</label>
            </div>
        `;
    } else if (status === "ready for delivery") {
        additionalFieldsHtml = `
            <div class="form-floating mb-3">
                <input type="datetime-local" class="form-control" id="deliveryDate" placeholder="Delivery Date and Time">
                <label for="deliveryDate" class="fw-semibold">Delivery Date and Time</label>
            </div>
        `;
    }

    $("#additionalFieldsContainer").html(additionalFieldsHtml);
}

function updateBooking() {
    $(document).on("click", "#btnSubmit", function () {
        var bookingId = $("#modalEditBooking .modal-content").data(
            "booking-id"
        );
        var status = $("#bookingStatus").val();
        var pickupDate = $("#pickupDate").val();
        var deliveryDate = $("#deliveryDate").val();

        $.ajax({
            url: "../actions/update-booking.php",
            type: "POST",
            data: {
                booking_id: bookingId,
                status: status,
                pickup_date: pickupDate,
                delivery_date: deliveryDate,
            },
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    $("#modalEditBooking").modal("hide");
                    displayBookings();
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

function getStatusBadgeClass(status) {
    switch (status.toLowerCase()) {
        case "pending":
            return "text-bg-warning";
        case "accepted":
            return "text-bg-info";
        case "scheduled for pickup":
            return "text-bg-info";
        case "in pickup":
            return "text-bg-info";
        case "in processing":
            return "text-bg-info";
        case "ready for delivery":
            return "text-bg-primary";
        case "out for delivery":
            return "text-bg-primary";
        case "delivered":
            return "text-bg-success";
        case "completed":
            return "text-bg-success";
        default:
            return "text-bg-secondary";
    }
}

function capitalizeWords(str) {
    return str
        .toLowerCase()
        .split(" ")
        .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
        .join(" ");
}
