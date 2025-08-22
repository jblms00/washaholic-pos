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
        <section class="au-section-one p-0">
            <div class="row">
                <div class="col">
                    <div class="au-bg animation-downwards">
                        <h5>Welcome to Washaholic Laundry Services, where we take the hassle out of laundry to give you
                            more time for what matters most. We offer a full range of professional laundry services,
                            ensuring that your clothes are cleaned, dried, and folded with the utmost care. Our mission
                            is to provide a convenient, reliable, and high-quality service that exceeds your
                            expectations every time. With state-of-the-art equipment, premium detergents, and a focus on
                            safety and sanitation, we deliver fresh, clean laundry to your door with ease. Choose
                            Washaholic for a laundry service that’s as dedicated to your clothes as you are.</h5>
                    </div>
                </div>
            </div>
        </section>
        <section class="au-section-two container">
            <div class="row align-items-center animation-left">
                <div class="col">
                    <img src="assets/images/why_choose_us101.png" width="520px" height="100%" alt="img">
                </div>
                <div class="col">
                    <h1>Why Choose Washaholic?</h1>
                    <p>We know that finding time for laundry can be a challenge, especially when there are so many other
                        things you’d rather be doing. At Washaholic Laundry Services, we’re here to make your life
                        easier by offering a seamless, top-notch laundry experience. Whether you need washing, drying,
                        ironing, or all of the above, we’ve got you covered. We serve neighborhoods across the city,
                        ensuring that no matter where you are, clean clothes are just a click away. In just 24 hours,
                        we’ll have your freshly laundered items delivered right to your door.</p>
                </div>
            </div>
            <div class="divider w-50 m-auto my-5 animation-upwards"></div>
            <div class="row align-items-center animation-right">
                <div class="col">
                    <h1>Our Commitment to Quality</h1>
                    <p>At Washaholic Laundry Services, honesty and quality are the cornerstones of our business. We
                        believe in building lasting relationships with our customers by offering fair prices and
                        unmatched service. Our commitment goes beyond just the convenience of our online platform; we
                        have real, physical outlets where you can drop by anytime. Whether you’re at home, at a
                        relative’s place, or staying in a hotel, our on-demand laundry service is always ready to pick
                        up your items and return them spotless. With Washaholic, you’re never far from a dependable and
                        trustworthy laundry solution.</p>
                </div>
                <div class="col">
                    <img src="assets/images/why_choose_us102.png" width="520px" height="100%" alt="img">
                </div>
            </div>
        </section>
        <section class="au-section-three" style="padding: 3rem 8rem;">
            <div class="row mb-5">
                <div class="col text-center">
                    <h1 class="animation-upwards fw-semibold">What We Offer?</h1>
                </div>
            </div>
            <div class="cards-container d-flex align-items-center flex-wrap justify-content-center gap-5">
                <div class="card animation-left">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/truck_mini.png" alt="img">
                    </div>
                    <h5 class="card-title">Convenient Scheduling</h5>
                    <p>Book a pickup and delivery time that suits your busy schedule, making laundry day a breeze.</p>
                </div>
                <div class="card animation-upwards">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/cloths_icon.png" alt="img">
                    </div>
                    <h5 class="card-title">Expert Cleaning</h5>
                    <p>Trust our skilled professionals to handle your clothes with the utmost care, ensuring they come
                        back fresh and spotless.</p>
                </div>
                <div class="card animation-right">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/speedy_delivery.png" alt="img">
                    </div>
                    <h5 class="card-title">Fast Service</h5>
                    <p>Get your laundry back within 24 hours, no matter the size of your load—quick, efficient, and
                        reliable.</p>
                </div>
                <div class="card animation-left">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/web_icon.png" alt="img">
                    </div>
                    <h5 class="card-title">Eco-Friendly Practices</h5>
                    <p>We’re committed to a greener planet by using environmentally friendly products that are gentle on
                        your clothes and the earth.</p>
                </div>
                <div class="card animation-upwards">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/sheild_icon.png" alt="img">
                    </div>
                    <h5 class="card-title">Customer Satisfaction Guaranteed</h5>
                    <p>If you're not completely satisfied, we’ll rewash your clothes at no extra cost—your happiness is
                        our priority.</p>
                </div>
                <div class="card animation-right">
                    <div class="card-icon my-4">
                        <img src="assets/images/icons/support_icon.png" alt="img">
                    </div>
                    <h5 class="card-title">Supporting Local</h5>
                    <p>By choosing us, you’re supporting local businesses and helping our community thrive.</p>
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
        <?php include("includes/default-components.php"); ?>
    </div>
    <?php include("includes/scripts.php"); ?>
</body>

</html>