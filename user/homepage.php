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
</head>

<body data-user-profile="<?php echo $user_data['user_photo']; ?>">
    <div class="main-container">
        <?php include("../includes/navbar.php"); ?>
        <section class="usr-section-one container" style="padding: 4rem 0;">
            <div class="row align-items-center">
                <div class="col animation-left">
                    <h5 class="usr-pg-title badge">Eco Friendly</h5>
                    <h1 class="custom-color">Our Commitment to Sustainability</h1>
                    <p>At Washaholic Laundry Services, we are dedicated to making a positive impact on the environment.
                        Our mission is to deliver exceptional laundry and dry cleaning solutions that are both
                        eco-friendly and efficient. By using sustainable practices and advanced technology, we ensure
                        that our services are not only top-notch but also gentle on the planet. Our goal is to provide
                        you with high-quality, reliable laundry care while actively reducing our ecological footprint.
                    </p>
                </div>
                <div class="col text-center animation-right">
                    <img src="../assets/images/itj4g-1024x875.png" alt="img" width="640" height="100%">
                </div>
            </div>
        </section>
        <section class="usr-section-two animation-upwards" style="padding: 4rem 26rem;">
            <h1>"We believe that cleanliness is the key to happiness and success in absolutely everything."</h1>
            <h3 class="fst-italic fw-semibold" style="color: var(--theme-color5);">- Max Taylor, Founder</h3>
        </section>
        <section class="usr-section-three container" style="padding: 4rem 0;">
            <div class="row align-items-center">
                <div class="col text-center animation-left">
                    <img src="../assets/images/4jtog-1024x855.png" alt="img" width="640" height="100%">
                </div>
                <div class="col animation-right">
                    <h5 class="usr-pg-title badge">About Us</h5>
                    <h1>Premier Laundry and Dry Cleaning Solutions</h1>
                    <p>
                        At Washaholic Laundry Services, our core mission is to offer top-tier laundry and dry cleaning
                        services designed to meet your unique needs. We are committed to delivering a blend of
                        flexibility, affordability, and exceptional quality. Our goal is to ensure that every garment
                        receives the highest level of care, providing you with a seamless and satisfying laundry
                        experience.
                    </p>
                </div>
            </div>
        </section>
        <section class="usr-section-four container" style="padding: 4rem 0;">
            <h1 class="mb-5 text-center fw-semibold custom-color">How Does Washaholic Work?</h1>
            <div class="card-containers d-flex align-items-center justify-content-center gap-5">
                <div class="card border-0">
                    <img src="../assets/images/o4tjg4.png" class="rounded-4" alt="img">
                </div>
                <div class="card border-0">
                    <img src="../assets/images/j4itgn4t.png" class="rounded-4" alt="img">
                </div>
                <div class="card border-0">
                    <img src="../assets/images/4outgj4t.png" class="rounded-4" alt="img">
                </div>
                <div class="card border-0">
                    <img src="../assets/images/u4thg4.png" class="rounded-4" alt="img">
                </div>
            </div>
        </section>
        <section class="usr-section-two animation-upwards" style="padding: 4rem 26rem;">
            <h5 class="fw-light">We Clean It All</h5>
            <h1 class="fw-light">Excellence in <span class="fw-bold">Every Service</span></h1>
        </section>
        <section class="usr-section-one container" style="padding: 4rem 0;">
            <div class="row align-items-center">
                <div class="col animation-left">
                    <h5 class="usr-pg-title badge">FAQ</h5>
                    <h1 class="custom-color">Popular Questions</h1>
                    <h5 class="mb-4">You have the flexibility to choose the service that best fits your needs—your
                        convenience is our
                        priority</h5>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    <span class="me-3 plus-icon"><i class="fa-solid fa-plus"></i></span>
                                    <span class="me-3 minus-icon"><i class="fa-solid fa-minus"></i></span>
                                    Are you insured against damage?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we have insurance to cover any possible damage to your clothes. You can trust
                                    us with your items.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <span class="me-3 plus-icon"><i class="fa-solid fa-plus"></i></span>
                                    <span class="me-3 minus-icon"><i class="fa-solid fa-minus"></i></span>
                                    Can I trust you with my clothes?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Definitely! Our experienced team handles your clothes with care to make sure they
                                    are returned to you in great condition.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <span class="me-3 plus-icon"><i class="fa-solid fa-plus"></i></span>
                                    <span class="me-3 minus-icon"><i class="fa-solid fa-minus"></i></span>
                                    How does the whole process work?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    It’s easy! Just book a pickup, and we’ll handle the rest. We collect your clothes,
                                    clean them, and deliver them back to you, usually within 24 hours.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <span class="me-3 plus-icon"><i class="fa-solid fa-plus"></i></span>
                                    <span class="me-3 minus-icon"><i class="fa-solid fa-minus"></i></span>
                                    How long does cleaning take?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Most of our cleaning is done within 24 hours. If you have special requests, it might
                                    take a little longer.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col text-center animation-right">
                    <img src="../assets/images/itj4g-1024x875.png" alt="img" width="640" height="100%">
                </div>
            </div>
        </section>
        <?php include("../includes/footer.php"); ?>
    </div>
    <?php include("../includes/user/components.php"); ?>
    <?php include("../includes/scripts.php"); ?>
    <script src="../assets/js/chatSupport.js"></script>
    <script src="../assets/js/userProfile.js"></script>

</body>

</html>