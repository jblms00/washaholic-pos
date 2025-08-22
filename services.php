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
        <section class="sv-section-one container">
            <div class="row align-items-center">
                <div class="col animation-left">
                    <h1>Reliable commercial laundry service with same-day pickup and free next-day delivery.</h1>
                    <h1 class="custom-color">Unbeatable pricing guaranteed.</h1>
                </div>
                <div class="col animation-right">
                    <img src="assets/images/commercial_page_hero.png" width="600" height="100%" alt="img">
                </div>
            </div>
        </section>
        <section class="sv-section-two text-center animation-upwards"
            style="background: var(--theme-color1); padding: 12px;">
            <h6 class="mb-0 text-center text-light fw-light">Book Now. Fresh Laundry, Every Day.</h6>
        </section>
        <section class="sv-section-three container" style="padding: 1rem;">
            <div class="row my-5">
                <div class="col text-center">
                    <h1 class="animation-upwards fw-semibold">Our Services</h1>
                </div>
            </div>
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h3 class="custom-color fw-semibold">For Uniforms, There's Washaholic Laundry Services</h3>
                    <p>Whether you're running a small business or managing a large company, trust us to keep your staff
                        uniforms pristine. We process thousands of items each week, ensuring that your team always looks
                        professional and polished.</p>
                </div>
                <div class="col">
                    <img src="assets/images/image101.png" width="520" height="100%" alt="img">
                </div>
            </div>
            <div class="divider w-100 m-auto my-5 animation-upwards"></div>
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <img src="assets/images/image102 (1).png" width="520" height="100%" alt="img">
                </div>
                <div class="col">
                    <h3 class="custom-color fw-semibold">Airbnb Linen Hire with Washaholic Laundry Services</h3>
                    <p>Our on-demand laundry service ensures your Airbnb is always guest-ready. Choose to either have us
                        launder your linens and towels or rent our freshly cleaned linens on demand. Focus on providing
                        your guests with an unforgettable stay, while we take care of the laundry.</p>
                </div>
            </div>
            <div class="divider w-50 m-auto my-5 animation-upwards"></div>
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h3 class="custom-color fw-semibold">For Your Hotel, There's Washaholic Laundry Services</h3>
                    <p>Partner with us to deliver outstanding laundry services to your guests. We offer overnight
                        laundry and dry cleaning services, perfect for hotels, serviced apartments, and Airbnb providers
                        who want to offer an exceptional guest experience.</p>
                </div>
                <div class="col">
                    <img src="assets/images/image103.png" width="520" height="100%" alt="img">
                </div>
            </div>
            <div class="divider w-50 m-auto my-5 animation-upwards"></div>
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <img src="assets/images/image102 (1).png" width="520" height="100%" alt="img">
                </div>
                <div class="col">
                    <h3 class="custom-color fw-semibold">For Restaurants and Cafes, There's Washaholic Laundry Services
                    </h3>
                    <p>Our restaurant and cafe laundry service delivers fast, thorough cleaning for all your business
                        needs. From tablecloths and napkins to uniforms and kitchen cloths, we provide excellent results
                        at affordable prices, working around your schedule.</p>
                </div>
            </div>
            <div class="divider w-50 m-auto my-5 animation-upwards"></div>
            <div class="row mb-3 align-items-center">
                <div class="col">
                    <h3 class="custom-color fw-semibold">For Your Office, There's Washaholic Laundry Services</h3>
                    <p>We offer tailored solutions for all your office laundry and dry cleaning needs. Whether it’s
                        keeping your team’s uniforms clean, providing fresh towels for shower facilities, or cleaning
                        event materials, our service is designed to support your business.</p>
                </div>
                <div class="col">
                    <img src="assets/images/image105.png" width="520" height="100%" alt="img">
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
    </div>
    <?php include("includes/default-components.php"); ?>
    <?php include("includes/scripts.php"); ?>
</body>

</html>