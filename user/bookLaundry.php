<?php
session_start();

include("../actions/database-connection.php");
include("../actions/check-login.php");
$user_data = check_login($con);
$full_name = $user_data['user_name'];
$first_name = explode(' ', $full_name)[0];
?>
<!doctype html>
<html lang="en">

<head>
    <?php include("../includes/header.php"); ?>
    <style>
        body {
            background: url(../assets/images/5yb5yb.png);
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body data-user-profile="<?php echo $user_data['user_photo']; ?>">
    <div class="main-container">
        <?php include("../includes/navbar.php"); ?>
        <section class="container-fluid laundry-container" style="padding: 5rem 10rem;">
            <div class="row">
                <div class="col">
                    <div class="calendar animation-left">
                        <div id="calendar"></div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex flex-column gap-4 h-100">
                        <div class="box animation-right">
                            <div class="box-title">
                                <h4>My Bookings</h4>
                            </div>
                            <div class="box-content d-flex align-items-center flex-column gap-3">
                                <ul id="bookingList" class="list-group w-100"></ul>
                            </div>
                        </div>
                        <div class="box animation-right" style="height: 25%;">
                            <div class="box-title">
                                <h4>Legends</h4>
                            </div>
                            <div class="box-content label-legends">
                                <p class="calendar-book-available text-light">Booking Available</p>
                                <p class="calendar-book-not-available text-light" style="margin-bottom: 0;">
                                    Fully Booked
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php include("../includes/user/components.php"); ?>
    <?php include("../includes/scripts.php"); ?>
    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>
    <script src="../assets/js/chatSupport.js"></script>
    <script src="../assets/js/userProfile.js"></script>
    <script src="../assets/js/bookLaundry.js"></script>
</body>

</html>