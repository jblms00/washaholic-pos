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
        <section class="lc-section-one" style="margin-top: 2rem;">
            <div class="signup-login-container">
                <div class="box animation-left" style="width: 60%;">
                    <div class="row">
                        <div class="col">
                            <form id="formSignup" style="padding: 2rem;">
                                <div class="row mb-5">
                                    <div class="col">
                                        <h1 class="custom-color text-center fw-bold">Create an Account</h1>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p>Complete Name</p>
                                        <input type="text" id="fullName">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p>Email</p>
                                        <input type="text" id="email" placeholder="name@example.com">
                                    </div>
                                    <div class="col">
                                        <p>Phone Number</p>
                                        <input type="text" id="phoneNumber">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p>Street Address</p>
                                        <input type="text" id="streetAdress">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p>Town/City</p>
                                        <input type="text" id="townCity">
                                    </div>
                                    <div class="col">
                                        <p>Zip Code</p>
                                        <input type="text" id="zipCode">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p>Password</p>
                                        <input type="password" id="password">
                                    </div>
                                    <div class="col">
                                        <p>Confirm Password</p>
                                        <input type="password" id="confirmPassword">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="accept"
                                                id="acceptTermsConditions">
                                            <label class="form-check-label" for="acceptTermsConditions">
                                                I accept the Terms of Use & Privacy Policy.
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-primary w-50 custom-bg-color">Register
                                            Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-5 has-design">
                            <img src="assets/images/front-view-young-female-with-washing-machine-preparing-clothes-wash-white-wall.png"
                                alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
    </div>
    <?php include("includes/default-components.php"); ?>
    <?php include("includes/scripts.php"); ?>
    <script src="assets/js/registerAccount.js"></script>
</body>

</html>