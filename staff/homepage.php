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

<body class="staff-side">
    <div class="main-container">
        <?php include("../includes/navbar.php"); ?>
        <div class="container d-flex animation-left">
            <div class="chat-list">
                <div class="search-container mb-1" style="padding: 10px;">
                    <input type="text" class="form-control" id="searchCustomerName" placeholder="Search Customer">
                </div>
                <ul></ul>
            </div>
            <div class="chat-body">
                <div class="chat-header">
                    <h3>Customer Support</h3>
                </div>
                <div class="message-container" id="messageContainer">
                </div>
                <div class="input-container animation-upwards d-none">
                    <form>
                        <input type="text" id="inputChat" placeholder="Enter your message here" class="form-control m-0"
                            autocomplete="off">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include("../includes/scripts.php"); ?>
    <script src="../assets/js/staffCustomerSupport.js"></script>
</body>

</html>