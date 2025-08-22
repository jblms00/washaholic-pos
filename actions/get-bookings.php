<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $status = isset($_GET['status']) ? mysqli_real_escape_string($con, $_GET['status']) : '';

    $query = "
        SELECT 
            b.booking_id, 
            b.customer_id, 
            b.pickup_date, 
            b.delivery_date, 
            b.status, 
            b.total_amount, 
            b.payment_method, 
            b.gcash_reference_number, 
            b.gcash_receipt, 
            b.created_at, 
            b.updated_at, 
            b.message,
            u.user_name AS customer_name,
            u.user_email AS customer_email
        FROM bookings b
        LEFT JOIN users_accounts u ON b.customer_id = u.user_id
        WHERE b.status = '$status'
    ";

    $result = mysqli_query($con, $query);

    if ($result) {
        $bookings = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $bookings[] = [
                'booking_id' => $row['booking_id'],
                'customer_name' => $row['customer_name'],
                'customer_email' => $row['customer_email'],
                'total_amount' => number_format($row['total_amount'], 2),
                'status' => ucfirst($row['status']),
                'date_created' => date("F j, Y, g:i a", strtotime($row['created_at'])),
                'pickup_date' => date("F j, Y", strtotime($row['pickup_date'])),
                'delivery_date' => date("F j, Y", strtotime($row['delivery_date'])),
                'payment_method' => $row['payment_method'],
                'gcash_reference_number' => $row['gcash_reference_number'],
                'gcash_receipt' => $row['gcash_receipt'],
                'updated_at' => date("F j, Y, g:i a", strtotime($row['updated_at'])),
                'message' => $row['message']
            ];
        }

        $data['status'] = "success";
        $data['bookings'] = $bookings;
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to fetch bookings.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request.";
}

echo json_encode($data);
?>