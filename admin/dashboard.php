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
                <div class="col">
                    <div class="page-title animation-left">
                        <h1 class="fw-semibold text-uppercase">Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="row gap-3 mb-5">
                <div class="col-sm-6 col-xl animation-left">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-chart-pie fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Profit</p>
                            <h6 class="mb-0 fw-bold" id="profitCounts">₱0.00</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-left">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-wallet fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Sale</p>
                            <h6 class="mb-0 fw-bold" id="todaySalesAmount">₱0.00</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-right">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-paste fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Total Bookings</p>
                            <h6 class="mb-0 fw-bold" id="totalBookings">0.00</h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl animation-right">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa-solid fa-user fa-3x text-primary"></i>
                        <div class="ms-3 text-end">
                            <p class="mb-2 fw-semibold custom-color">Total Customers</p>
                            <h6 class="mb-0 fw-bold" id="totalCustomers">0.00</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card animation-left">
                        <div class="card-title p-2 m-0">
                            <h6 class="fw-bold mb-0">Bookings</h6>
                        </div>
                        <hr class="divider m-0">
                        <div class="card-body pb-3">
                            <div id="bookingsChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card animation-right">
                        <div class="card-title p-2 m-0">
                            <h6 class="fw-bold mb-0">Total Revenue</h6>
                        </div>
                        <hr class="divider m-0">
                        <div class="card-body pb-3">
                            <div id="revenueChart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include("../includes/default-components.php"); ?>
    <?php include("../includes/scripts.php"); ?>
    <!-- Apexchart JS -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="../assets/js/components/adminSidebar.js"></script>
    <script src="../assets/js/adminDashboard.js"></script>
</body>

</html>