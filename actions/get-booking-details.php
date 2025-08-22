<?php
session_start();
include("database-connection.php");

$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['booking_id'])) {
        $bookingId = mysqli_real_escape_string($con, $_GET['booking_id']);

        // Fetch booking details, additional services, and user details
        $query = "
            SELECT 
                b.booking_id, b.customer_id, b.pickup_date, b.delivery_date, b.status, b.total_amount, 
                b.payment_method, b.gcash_reference_number, b.gcash_receipt, b.created_at, b.updated_at, 
                b.message, 
                a.extra_wash, a.extra_dry, a.extra_rinse, a.spin_dry,
                ua.user_name, ua.user_email, ua.user_phone_number
            FROM bookings b
            LEFT JOIN additional_services a ON b.booking_id = a.booking_id
            LEFT JOIN users_accounts ua ON b.customer_id = ua.user_id
            WHERE b.booking_id = '$bookingId'
        ";

        $result = mysqli_query($con, $query);

        if ($result) {
            $booking = null;
            $additionalServices = array();

            while ($row = mysqli_fetch_assoc($result)) {
                if (!$booking) {
                    // Fetch booking details
                    $booking = array(
                        'booking_id' => $row['booking_id'],
                        'customer_id' => $row['customer_id'],
                        'pickup_date' => $row['pickup_date'],
                        'delivery_date' => $row['delivery_date'],
                        'status' => $row['status'],
                        'total_amount' => $row['total_amount'],
                        'payment_method' => $row['payment_method'],
                        'gcash_reference_number' => $row['gcash_reference_number'],
                        'gcash_receipt' => $row['gcash_receipt'],
                        'created_at' => $row['created_at'],
                        'updated_at' => $row['updated_at'],
                        'message' => $row['message'],
                        'user_name' => $row['user_name'],
                        'user_email' => $row['user_email'],
                        'user_phone_number' => $row['user_phone_number']
                    );
                }

                // Fetch additional services if they exist
                if ($row['extra_wash'] !== null) {
                    $additionalServices[] = array(
                        'extra_wash' => $row['extra_wash'],
                        'extra_dry' => $row['extra_dry'],
                        'extra_rinse' => $row['extra_rinse'],
                        'spin_dry' => $row['spin_dry'],
                    );
                }
            }

            if ($booking) {
                $response['status'] = 'success';
                $response['booking'] = $booking;
                $response['additional_services'] = $additionalServices;
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Booking not found.';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Database query failed.';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Booking ID is required.';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>