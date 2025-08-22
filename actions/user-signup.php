<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $streetAdress = mysqli_real_escape_string($con, $_POST['streetAdress']);
    $townCity = mysqli_real_escape_string($con, $_POST['townCity']);
    $zipCode = mysqli_real_escape_string($con, $_POST['zipCode']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $acceptTermsConditions = isset($_POST['acceptTermsConditions']) ? $_POST['acceptTermsConditions'] : '';

    // Base64 encode passwords
    $encodedPassword = base64_encode($password);
    $encodedConfirmPassword = base64_encode($confirmPassword);

    if (empty($fullName) || empty($email) || empty($phoneNumber) || empty($streetAdress) || empty($townCity) || empty($zipCode) || empty($password) || empty($confirmPassword)) {
        $data['status'] = "error";
        $data['message'] = "All fields are required";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $data['status'] = "error";
        $data['message'] = "Invalid email format";
    } else if ($encodedPassword !== $encodedConfirmPassword) {
        $data['status'] = "error";
        $data['message'] = "Passwords do not match";
    } else {
        $check_email_query = "SELECT user_email FROM users_accounts WHERE user_email = '$email'";
        $check_email_result = mysqli_query($con, $check_email_query);

        if (mysqli_num_rows($check_email_result) > 0) {
            $data['status'] = "error";
            $data['message'] = "Email already used";
        } else {
            $create_acc_query = "INSERT INTO users_accounts (user_id, user_name, user_email, user_password, user_street_address, user_town_city, user_zip_code, user_phone_number, user_type, user_status, date_created) VALUES (NULL, '$fullName', '$email', '$encodedPassword', '$streetAdress', '$townCity', '$zipCode', '$phoneNumber', 'user', 'active', NOW())";
            $create_acc_result = mysqli_query($con, $create_acc_query);

            if ($create_acc_result) {
                $data['status'] = "success";
            } else {
                $data['status'] = "error";
                $data['message'] = "Failed to create account. Please try again later.";
            }
        }
    }
}

echo json_encode($data);
