<nav class="navbar navbar-expand-lg sticky-navbar animation-downwards" style="padding: 0;">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="homepage">Washaholic</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php if (strpos($_SERVER['REQUEST_URI'], '/user/') !== false) { ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-3">
                        <a href="homepage">
                            <i class="fa-solid fa-house-chimney"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="bookLaundry">
                            <i class="fa-solid fa-calendar-days"></i>
                        </a>
                    </li>
                    <li class="nav-item mx-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#modalProfile">
                            <i class="fa-regular fa-circle-user"></i>
                        </a>
                    </li>
                    <li class=" nav-item mx-3">
                        <a href="../actions/user-logout.php">
                            <i class="fa-regular fa-power-off fs-6"></i>
                        </a>
                    </li>
                </ul>
            <?php } else if (strpos($_SERVER['REQUEST_URI'], '/staff/') !== false) { ?>
                    <ul class="navbar-nav ms-auto">
                        <li class=" nav-item mx-3">
                            <a href="../actions/user-logout.php">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                        </li>
                    </ul>
            <?php } else { ?>
                    <ul class=" navbar-nav m-auto">
                        <li class="nav-item mx-5">
                            <a class="nav-link" href="index">Home</a>
                        </li>
                        <li class="nav-item mx-5">
                            <a class="nav-link" href="aboutUs">About Us</a>
                        </li>
                        <li class="nav-item mx-5">
                            <a class="nav-link" href="services">Services</a>
                        </li>
                        <li class="nav-item mx-5">
                            <a class="nav-link" href="contactUs">Contact Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-3">
                        <li class="nav-item mx-3">
                            <a href="login" class="btn btn-success btn-login">Book Now</a>
                        </li>
                    </ul>
            <?php } ?>
        </div>
    </div>
</nav>