<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking_id']) && isset($_POST['status'])) {
    $bookingId = trim(mysqli_real_escape_string($con, $_POST['booking_id']));
    $status = trim(mysqli_real_escape_string($con, $_POST['status']));

    if (empty($bookingId) || !is_numeric($bookingId)) {
        $data['status'] = "error";
        $data['message'] = "Invalid booking ID.";
    } elseif (empty($status) || $status === "Please select booking status") {
        $data['status'] = "error";
        $data['message'] = "Please select booking status.";
    } else {
        $pickupDate = isset($_POST['pickup_date']) ? trim(mysqli_real_escape_string($con, $_POST['pickup_date'])) : null;
        $deliveryDate = isset($_POST['delivery_date']) ? trim(mysqli_real_escape_string($con, $_POST['delivery_date'])) : null;

        $data['status'] = $status;

        if ($status === 'scheduled for pickup') {
            if (empty($pickupDate)) {
                $data['status'] = "error";
                $data['message'] = "Please select pickup date and time.";
            } else {
                $query = "UPDATE bookings SET status = '$status', pickup_date = '$pickupDate' WHERE booking_id = '$bookingId'";
                $result = mysqli_query($con, $query);
                $data['status'] = $result ? "success" : "error";
                $data['message'] = $result ? "Booking updated successfully." : "Failed to update booking. Please try again later.";
            }
        } elseif ($status === 'ready for delivery') {
            if (empty($deliveryDate)) {
                $data['status'] = "error";
                $data['message'] = "Please select delivery date and time.";
            } else {
                $query = "UPDATE bookings SET status = '$status', delivery_date = '$deliveryDate' WHERE booking_id = '$bookingId'";
                $result = mysqli_query($con, $query);
                $data['status'] = $result ? "success" : "error";
                $data['message'] = $result ? "Booking updated successfully." : "Failed to update booking. Please try again later.";
            }
        } else {
            $query = "UPDATE bookings SET status = '$status' WHERE booking_id = '$bookingId'";
            $result = mysqli_query($con, $query);
            $data['status'] = $result ? "success" : "error";
            $data['message'] = $result ? "Booking updated successfully." : "Failed to update booking. Please try again later.";
        }
    }

} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request. Please try again later.";
}

echo json_encode($data);
?>