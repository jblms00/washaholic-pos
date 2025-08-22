<?php
session_start();

include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

$get_bookings_query = "
    SELECT booking_id, pickup_date, delivery_date, status, created_at 
    FROM bookings 
    WHERE customer_id = '$loggedInUser'
    ORDER BY created_at DESC
";
$get_bookings_result = mysqli_query($con, $get_bookings_query);

if ($get_bookings_result) {
    $bookings = [];
    while ($row = mysqli_fetch_assoc($get_bookings_result)) {
        $bookings[] = $row;
    }
    $data['status'] = 'success';
    $data['bookings'] = $bookings;
} else {
    $data['status'] = 'error';
    $data['message'] = 'Failed to fetch bookings.';
}

echo json_encode($data);
?>