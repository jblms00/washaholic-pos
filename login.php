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
                <div class="box animation-left">
                    <div class="row">
                        <div class="col">
                            <form id="formLogin" style="padding: 2rem;">
                                <div class="row mb-5">
                                    <div class="col">
                                        <h1 class="custom-color text-center fw-bold">Login Your Account</h1>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p>Email</p>
                                        <input type="text" id="userEmail" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col">
                                        <p>Password</p>
                                        <input type="password" id="userPassword">
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="showPassword">
                                            <label class="form-check-label" for="showPassword">
                                                Show Password
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col text-center">
                                        <button type="submit"
                                            class="btn btn-primary w-50 custom-bg-color">Login</button>
                                    </div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col text-center">
                                        <p class="mb-0 text-primary fw-semibold" style="cursor: pointer;"
                                            data-bs-toggle="modal" data-bs-target="#modalForgotPassword">Forgot
                                            Password?</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-center">
                                        <p>Don't have an account? <span>
                                                <a href="registerAccount"
                                                    class="text-decoration-none fw-semibold text-success">Register
                                                    here.</a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-6 has-design">
                            <img src="assets/images/front-view-young-male-with-washer-holding-red-sale-banner-white-wall-removebg-preview.png"
                                alt="img">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php include("includes/footer.php"); ?>
    </div>
    <?php include("includes/default-components.php"); ?>
    <!-- Modal -->
    <div class="modal fade" id="modalForgotPassword" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid" id="containerContent">
                        <div class="row mb-3">
                            <div class="col text-center">
                                <h6 class="mb-0">Please enter your email to search for your account.</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating mb-1 text-center">
                                    <input type="email" class="form-control" id="findEmail"
                                        placeholder="name@example.com" autocomplete="off">
                                    <label for="findEmail">Email address</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="message-container d-flex justify-content-center"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button type="button" class="btn btn-primary btn-find w-50">Find Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("includes/scripts.php"); ?>
    <script src="assets/js/login.js"></script>
    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordField = document.getElementById('userPassword');
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });
    </script>
</body>

</html>