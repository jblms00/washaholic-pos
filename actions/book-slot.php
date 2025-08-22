<?php
session_start();

include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = mysqli_real_escape_string($con, $_POST['fullName']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($con, $_POST['phoneNumber']);
    $serviceOption = mysqli_real_escape_string($con, $_POST['serviceOption']);
    $extraWash = isset($_POST['extraWash']) ? mysqli_real_escape_string($con, $_POST['extraWash']) : '0';
    $extraDry = isset($_POST['extraDry']) ? mysqli_real_escape_string($con, $_POST['extraDry']) : '0';
    $extraRinse = isset($_POST['extraRinse']) ? mysqli_real_escape_string($con, $_POST['extraRinse']) : '0';
    $spinDry = isset($_POST['spinDry']) ? mysqli_real_escape_string($con, $_POST['spinDry']) : '0';
    $totalCost = mysqli_real_escape_string($con, $_POST['totalCost']);
    $paymentMethod = mysqli_real_escape_string($con, $_POST['paymentMethod']);
    $referenceNumber = mysqli_real_escape_string($con, $_POST['referenceNumber']);
    $comments = mysqli_real_escape_string($con, $_POST['comments']);

    $data['payment-method'] = $paymentMethod;

    // Validate required fields
    if (empty($fullName) || empty($email) || empty($phoneNumber) || empty($serviceOption) || empty($paymentMethod)) {
        $data['status'] = "error";
        $data['message'] = "Please fill in all required fields.";
    } else if ($paymentMethod === "Please select payment method") {
        $data['status'] = "error";
        $data['message'] = "Please select payment method.";
    } else {
        // Generate a random 7-digit booking ID
        $bookingId = generateRandom7Digit();

        $receiptFileName = "";
        if ($paymentMethod === "gcash") {
            if ($_FILES['gcashReceipt']['error'] == 0) {
                $receiptFileName = uploadReceipt($_FILES['gcashReceipt']);
            }
            if (empty($receiptFileName)) {
                $data['status'] = 'error';
                $data['message'] = 'Failed to upload image receipt for GCASH payment.';
                echo json_encode($data);
                exit();
            }
        }

        $insertBookingQuery = "INSERT INTO bookings (booking_id, customer_id, delivery_date, status, total_amount, payment_method, gcash_reference_number, gcash_receipt, created_at, updated_at, message) 
            VALUES ('$bookingId', '$loggedInUser', NOW(), 'pending', '$totalCost', '$paymentMethod', '$referenceNumber', '$receiptFileName', NOW(), NOW(), '$comments')";

        $insertBookingResult = mysqli_query($con, $insertBookingQuery);

        if ($insertBookingResult) {
            $insertExtraServicesQuery = "INSERT INTO additional_services (booking_id, extra_wash, extra_dry, extra_rinse, spin_dry, created_at) 
                VALUES ('$bookingId', '$extraWash', '$extraDry', '$extraRinse', '$spinDry', NOW())";

            $insertExtraServicesResult = mysqli_query($con, $insertExtraServicesQuery);

            if ($insertExtraServicesResult) {
                $data['status'] = "success";
                $data['message'] = "Booking submitted successfully!";
            } else {
                $data['status'] = "error";
                $data['message'] = "Failed to insert additional services.";
            }
        } else {
            $data['status'] = "error";
            $data['message'] = "Failed to submit booking.";
        }
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request method.";
}

echo json_encode($data);

function generateRandom7Digit()
{
    return random_int(1000000, 9999999);
}
function uploadReceipt($file)
{
    $targetDir = "../assets/images/gcashReceipts/";
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'jpeg', 'png');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            return $fileName;
        } else {
            return "";
        }
    } else {
        return "";
    }
}
?>