<?php
session_start();

include("../actions/database-connection.php");
include("../actions/check-login.php");
$user_data = check_login($con);
?>
<!doctype html>
<html lang="en">

<head>
    <?php include("../includes/header.php"); ?>
</head>

<body class="admin-side">
    <?php include("../includes/admin/sidebar.php"); ?>
    <section class="home-section">
        <div class="container-fluid pt-4 px-4">
            <div class="row mb-4">
                <div class="col animation-left">
                    <div class="page-title">
                        <h1 class="fw-semibold text-uppercase">Manage <span class="booking-status"></span> Bookings</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col animation-right">
                    <div class="table-container">
                        <table class="display">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Total Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Date and Time Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
    </section>
    <?php include("../includes/default-components.php"); ?>
    <?php include("../includes/admin/components.php"); ?>
    <!-- Modal -->
    <div class="modal fade" id="modalEditBooking" tabindex="-1" aria-labelledby="modalEditBookingLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title">Booking Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Booking Details -->
                    <div class="mb-3" id="bookingDetails">
                        <!-- Booking details will be inserted here -->
                    </div>
                    <!-- Additional Services Table -->
                    <table class="table table-bordered mb-3" id="additionalServicesTable">
                        <thead>
                            <tr>
                                <th colspan="4" class="text-center text-light" style="background: var(--theme-color3);">
                                    Additional Services
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">Extra Wash</th>
                                <th scope="col">Extra Dry</th>
                                <th scope="col">Extra Rinse</th>
                                <th scope="col">Spin Dry</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Additional services will be inserted here -->
                        </tbody>
                    </table>
                    <select class="form-select mb-3" id="bookingStatus" aria-label="Default select example">
                        <option selected disabled>Please select booking status</option>
                        <option value="pending">Pending</option>
                        <option value="accepted">Accepted</option>
                        <option value="scheduled for pickup">Scheduled For Pickup</option>
                        <option value="in pickup">In Pickup</option>
                        <option value="in processing">In Processing</option>
                        <option value="ready for delivery">Ready for Delivery</option>
                        <option value="out for delivery">Out for Delivery</option>
                        <option value="delivered">Delivered</option>
                        <option value="completed">Completed</option>
                    </select>
                    <div id="additionalFieldsContainer"></div>
                </div>
                <div class="modal-footer py-2">
                    <button type="button" class="btn btn-secondary py-0" data-bs-dismiss="modal">Close</button> <button
                        type="button" class="btn btn-primary py-0" id="btnSubmit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <?php include("../includes/scripts.php"); ?>
    <script src="../assets/js/components/adminSidebar.js"></script>
    <script src="../assets/js/adminManageBookings.js"></script>
</body>

</html>