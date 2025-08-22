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
        <section class="index-section-one container">
            <div class="row gap-2 align-items-center">
                <div class="col animation-left">
                    <h1 class="custom-color">Premium Dry Cleaning and Laundry Services</h1>
                    <h1>in Philippines</h1>
                </div>
                <div class="col animation-right">
                    <img src="assets/images/laundry-hero1.1.png" width="600" height="100%" alt="img">
                </div>
            </div>
        </section>
        <section class="secton-two container">
            <div class="row">
                <div class="col">
                    <div class="cards-container d-flex justify-content-center">
                        <div class="card animation-left" style="width: 22.8rem;">
                            <div class="card-body">
                                <img class="my-2" src="assets/images/laundry-icon-04-1.webp" alt="img">
                                <h3 class="card-title text-uppercase fw-semibold">Wash and Fold</h3>
                                <div class="price">
                                    <h1>₱612.96</h1>
                                </div>
                                <p class="card-text">We'll wash, dry, and fold your clothes (no ironing).</p>
                            </div>
                        </div>
                        <div class="card animation-upwards" style="width: 22.8rem;">
                            <div class="card-body">
                                <img class="my-2" src="assets/images/laundry-icon-04-1.webp" alt="img">
                                <h3 class="card-title text-uppercase fw-semibold">Wash and Iron</h3>
                                <div class="price">
                                    <h1>₱1,517.07</h1>
                                </div>
                                <p class="card-text">We'll clean, dry, and iron all your clothes.</p>
                            </div>
                        </div>
                        <div class="card animation-right" style="width: 22.8rem;">
                            <div class="card-body">
                                <img class="my-2" src="assets/images/laundry-icon-04-1.webp" alt="img">
                                <h3 class="card-title text-uppercase fw-semibold">Iron Only</h3>
                                <div class="price">
                                    <h1>₱1,057.35</h1>
                                </div>
                                <p class="card-text">We'll iron your clothes and return them neatly (no washing).</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="index-section-three animation-upwards" style="background: var(--theme-color1); padding: 12px;">
            <h6 class="mb-0 text-center text-light fw-light">Rated Excellent by our customers for Dry Cleaning, Laundry
                Service, and Laundrette.</h6>
        </section>
        <section class="index-section-four container text-center" style="padding: 4rem;">
            <div class="row mb-3">
                <div class="col">
                    <h1 class="animation-upwards fw-semibold">How Our Local Laundry Services Works?</h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="cards-container d-flex">
                        <div class="card animation-left" style="width: 20rem; height: 100%;">
                            <div class="card-body">
                                <img src="assets/images/laundry_step1.png" alt="img">
                                <h4>Step 1</h4>
                                <p>Book Online</p>
                            </div>
                        </div>
                        <div class="card animation-left" style="width: 20rem; height: 100%;">
                            <div class="card-body">
                                <img src="assets/images/laundry_step2.png" alt="img">
                                <h4>Step 2</h4>
                                <p>We Pick Up at a Time and Place Convenient for You</p>
                            </div>
                        </div>
                        <div class="card animation-right" style="width: 20rem; height: 100%;">
                            <div class="card-body">
                                <img src="assets/images/laundry_step3.png" alt="img">
                                <h4>Step 3</h4>
                                <p>We Clean and Work Our Magic</p>
                            </div>
                        </div>
                        <div class="card animation-right" style="width: 20rem; height: 100%;">
                            <div class="card-body">
                                <img src="assets/images/laundry_step4.png" alt="img">
                                <h4>Step 4</h4>
                                <p>We Deliver Your Freshly Cleaned Clothes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="index-section-five animation-upwards" style="background: var(--theme-color1); padding: 12px;">
            <h6 class="mb-0 text-center text-light fw-light">Rated Excellent by our customers for Dry Cleaning, Laundry
                Service, and Laundrette.</h6>
        </section>
        <section class="index-section-six container" style="padding: 4rem 0;">
            <div class="row mb-5">
                <div class="col text-center">
                    <h1 class="animation-upwards fw-semibold">Satisfaction Guaranteed</h1>
                </div>
            </div>
            <div class="row gap-5 text-center">
                <div class="col animation-left">
                    <h5>SAFETY</h5>
                    <p>Schedule your service to avoid overcrowded laundry shops and ensure social distancing.</p>
                </div>
                <div class="col animation-left">
                    <h5>SANITATION</h5>
                    <p>We regularly clean and sanitize our machines and laundry area. Hand sanitizer is available at the
                        counter.</p>
                </div>
                <div class="col animation-upwards">
                    <h5>CONVENIENCE</h5>
                    <p>Booking our laundry service is easy and convenient. Contact us via Messenger for any questions or
                        concerns.</p>
                </div>
                <div class="col animation-right">
                    <h5>SECURITY</h5>
                    <p>Our shop is monitored 24/7 by security cameras to ensure your peace of mind.</p>
                </div>
                <div class="col animation-right">
                    <h5>QUALITY</h5>
                    <p>We use LG Washing & Drying Machines to ensure top-notch care and quality for your laundry needs.
                    </p>
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
        <?php include("includes/default-components.php"); ?>
    </div>
    <?php include("includes/scripts.php"); ?>
</body>

</html>