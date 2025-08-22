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
    <section class="home-section" data-page-title="admin">
        <div class="container-fluid pt-4 px-4">
            <div class="row mb-4 align-items-center">
                <div class="col animation-left">
                    <div class="page-title">
                        <h1 class="fw-semibold text-uppercase">Manage Admins</h1>
                    </div>
                </div>
                <div class="col text-end animation-right">
                    <button type="button" class="btn btn-primary btn-add w-25 py-0">Add New</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="table-container animation-upwards">
                        <table class="display">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
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
    <?php include("../includes/scripts.php"); ?>
    <script src="../assets/js/components/adminSidebar.js"></script>
    <script src="../assets/js/adminDataTables.js"></script>
</body>

</html>