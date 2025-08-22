$(document).ready(function () {
    displayCalendar();
    calculateTotal();

    $(
        'input[name="serviceOption"], input[name="extraWash"], input[name="extraDry"], input[name="extraRinse"], input[name="spinDry"]'
    ).on("input change", function () {
        calculateTotal();
    });

    $("#paymentMethod").on("change", function () {
        var selectedPaymentMethod = $(this).val();
        if (selectedPaymentMethod === "gcash") {
            $(".gcash-main-container").removeClass("d-none");
        } else {
            $(".gcash-main-container").addClass("d-none");
        }
    });

    $("#gcashReceipt").change(function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function (event) {
            $("#proofReceipt")
                .attr("src", event.target.result)
                .removeClass("d-none");
        };

        reader.readAsDataURL(file);
    });

    submitBooking();
    displayUserBookings();
});

function displayCalendar() {
    var calendarEl = document.getElementById("calendar");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay",
        },
        events: function (fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: "../actions/get-calendar-data.php",
                method: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        var events = response.events.map(function (event) {
                            return {
                                id: event.id,
                                title: event.title,
                                start: event.start,
                                backgroundColor: event.backgroundColor,
                                textColor: event.textColor,
                            };
                        });

                        successCallback(events);

                        if (response.available > 0) {
                            $("#availabilityStatus").text(
                                "Available slots: " + response.available
                            );
                        } else {
                            $("#availabilityStatus").text(
                                "No available slots for today"
                            );
                        }
                    } else {
                        failureCallback(new Error(response.message));
                    }
                },
                error: function () {
                    failureCallback(new Error("Failed to fetch event data"));
                },
            });
        },
        eventContent: function (data) {
            return {
                html:
                    '<div class="fc-event-title-container ' +
                    data.textColor +
                    '" style="background:' +
                    data.backgroundColor +
                    ';">' +
                    data.event.title +
                    "</div>",
            };
        },
        dateClick: function (info) {
            var clickedDate = new Date(info.dateStr);
            var today = new Date();
            today.setHours(0, 0, 0, 0); // Reset time for accurate comparison

            var clickedDateISO = clickedDate.toISOString().split("T")[0];

            // Ensure clickedDate is not in the past
            if (clickedDate < today) {
                console.log("Date is in the past");
                return;
            }

            var event = calendar
                .getEvents()
                .find((e) => e.startStr === clickedDateISO);

            if (event && event.title === "Available") {
                $("#bookDate").text(
                    clickedDate.toLocaleDateString("en-US", {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                    })
                );
                $("#modalBook").modal("show");
            } else {
                console.log("Date is not available");
            }
        },
    });
    calendar.render();
}

function calculateTotal() {
    var serviceOption = $('input[name="serviceOption"]:checked').val();

    // Base prices based on kilos and service option
    var serviceCosts = {
        washDry3to8: 69,
        washDry8to10: 89,
        fullService3to8: 164,
        fullService8to10: 204,
    };

    var baseCost = serviceCosts[serviceOption] || 0;

    // Calculate additional service costs
    var extraCost = 0;
    $('input[name="extraWash"]:checked').each(function () {
        extraCost += parseFloat($(this).val());
    });
    $('input[name="extraDry"]:checked').each(function () {
        extraCost += parseFloat($(this).val());
    });
    $('input[name="extraRinse"]:checked').each(function () {
        extraCost += parseFloat($(this).val());
    });
    $('input[name="spinDry"]:checked').each(function () {
        extraCost += parseFloat($(this).val());
    });

    // Calculate total cost
    var totalCost = baseCost + extraCost;
    $("#totalCost").text("₱" + totalCost.toFixed(2));
    return totalCost;
}

function submitBooking() {
    $(document).on("click", "#submitBooking", function () {
        var totalCost = calculateTotal();
        var bookingData =
            $("#bookingForm").serialize() + "&totalCost=" + totalCost;

        $.ajax({
            url: "../actions/book-slot.php",
            method: "POST",
            data: bookingData,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    disableForm();
                    showToast(response.message, "text-success");

                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    showToast(response.message, "text-danger");
                }
            },
            error: function () {
                showToast("Failed to submit booking.", "text-danger");
            },
        });
    });
}

function displayUserBookings() {
    $.ajax({
        method: "POST",
        url: "../actions/get-user-bookings.php",
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                var bookingList = $("#bookingList");
                bookingList.empty();

                response.bookings.forEach(function (booking) {
                    var pickupDate = formatDate(booking.pickup_date);
                    var pickupTime = formatTime(booking.pickup_date);
                    var bookingDate = formatDate(booking.created_at);
                    var bookingDetailsHtml = "";
                    var badgeClass;

                    switch (booking.status) {
                        case "pending":
                            bookingDetailsHtml = `<p class="booking-details ad-msg mt-2">You've created a booking, but it hasn't been accepted by the laundry shop yet.</p>`;
                            badgeClass = "bg-warning text-dark"; // Yellow
                            break;
                        case "accepted":
                            bookingDetailsHtml = `
                                <p class="booking-details ad-msg mt-2">The laundry shop has accepted your booking and is preparing to process it.</p>
                            `;
                            badgeClass = "bg-primary text-light"; // Blue
                            break;
                        case "scheduled for pickup":
                        case "in pickup":
                        case "in processing":
                            bookingDetailsHtml = `
                                <p class="booking-details"><strong>Pick-Up Date:</strong> ${pickupDate}</p>
                                <p class="booking-details"><strong>Pick-Up Time:</strong> ${pickupTime}</p>
                                <p class="booking-details ad-msg mt-2">${
                                    booking.status === "scheduled for pickup"
                                        ? "The laundry shop has scheduled a time to pick up your laundry."
                                        : booking.status === "in pickup"
                                        ? "The laundry shop is currently picking up your laundry."
                                        : "Your laundry is currently being cleaned."
                                }</p>
                            `;
                            badgeClass = "bg-primary-subtle text-dark"; // Subtle Blue
                            break;
                        case "ready for delivery":
                        case "out for delivery":
                            bookingDetailsHtml = `<p class="booking-details ad-msg mt-2">${
                                booking.status === "ready for delivery"
                                    ? "Your laundry is cleaned and ready to be delivered back to you."
                                    : "Your laundry is on its way to you."
                            }</p>`;
                            badgeClass = "bg-success-subtle text-dark"; // Subtle Green
                            break;
                        case "delivered":
                            bookingDetailsHtml = `<p class="booking-details ad-msg mt-2">Your laundry has been delivered to you.</p>`;
                            badgeClass = "bg-success text-light"; // Green
                            break;
                        case "completed":
                            bookingDetailsHtml = `<p class="booking-details ad-msg mt-2">The entire process from booking to delivery is complete. Thank you for choosing our service!</p>`;
                            badgeClass = "bg-success text-light"; // Green
                            break;
                        default:
                            bookingDetailsHtml = `<p class="booking-details ad-msg mt-2">The status of your booking is unknown.</p>`;
                            badgeClass = "bg-light text-dark"; // Light Gray
                            break;
                    }

                    var status =
                        booking.status.charAt(0).toUpperCase() +
                        booking.status.slice(1);

                    var listItem = `
                        <li class="list-group-item my-2">
                            <div class="booking-info">
                                <p class="booking-details"><strong>Booking Date:</strong> ${bookingDate}</p>
                                <p class="booking-details"><strong>Booking ID:</strong> #${booking.booking_id}</p>
                                ${bookingDetailsHtml}
                                <div class="text-end mt-2">
                                    <span class="badge ${badgeClass} fw-semibold" style="font-size: 14px;">${status}</span>
                                </div>
                            </div>
                        </li>
                    `;
                    bookingList.append(listItem);
                });
            } else {
                console.log("Error:", response.message);
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}

function formatDate(dateString) {
    var options = { year: "numeric", month: "long", day: "numeric" };
    return new Date(dateString).toLocaleDateString("en-US", options);
}

function formatTime(dateString) {
    var options = { hour: "2-digit", minute: "2-digit" };
    return new Date(dateString).toLocaleTimeString("en-US", options);
}

function disableForm() {
    $("button, input, textarea").prop("disabled", true);
    $("a")
        .addClass("disabled")
        .on("click", function (e) {
            e.preventDefault();
        });
}

function showToast(message, className) {
    $("#liveToast .toast-body p")
        .text(message)
        .removeClass("text-success text-danger")
        .addClass(className);
    $("#liveToast").toast("show");
}
