<?php
session_start();

include("actions/database-connection.php");
include("actions/check-login.php");
?>
<!doctype html>
<html lang="en">

<head>
    <?php include("includes/header.php"); ?>
</head>

<body>
    <div class="main-container">
        <?php include("includes/navbar.php"); ?>
        <section class="cu-section-one">
            <div class="row">
                <div class="col">
                    <div class="au-bg animation-downwards">
                        <h1 class="mb-3">Contact Us</h1>
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-location-dot me-3"></i>
                            <p>Al Raheem building shop 5, Green Community Dubai investment park Dubai (UAE)</p>
                        </span>
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="fa-regular fa-envelope me-3"></i>
                            <p>washaholiclaundryservices@gmail.com</p>
                        </span>
                        <span class="d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-mobile-screen-button me-3"></i>
                            <p>0912-345-6789</p>
                        </span>
                    </div>
                </div>
            </div>
        </section>
        <section class="cu-section-two container pb-0">
            <form class="contact-form">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="inputFullName" placeholder="Full Name">
                    <label for="inputFullName">Full Name</label>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                            <label for="inputEmail">Email</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="inputPhoneNumber" placeholder="Phone Number">
                            <label for="inputPhoneNumber">Phone Number</label>
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea class="form-control" style="height: 100px;" placeholder="Enter your address"
                        id="inputAddress"></textarea>
                    <label for="inputAddress">Address</label>
                </div>
                <select class="form-select mb-3">
                    <option selected>Select subject</option>
                    <option value="General Inquiry">General Inquiry</option>
                    <option value="Service Request">Service Request</option>
                    <option value="Feedback">Feedback</option>
                </select>
                <div class="form-floating mb-3">
                    <textarea class="form-control" style="height: 140px;" placeholder="Enter your message"
                        id="inputMessage"></textarea>
                    <label for="inputMessage">Message</label>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </section>
        <?php include("includes/footer.php"); ?>
    </div>
    <?php include("includes/scripts.php"); ?>
    <?php include("includes/default-components.php"); ?>
</body>

</html>