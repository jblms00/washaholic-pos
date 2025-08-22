<?php
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Query to get total profit
    $profit_query = "SELECT SUM(total_amount) AS totalProfit FROM bookings WHERE status = 'completed'";
    $profit_result = mysqli_query($con, $profit_query);
    $profit_row = mysqli_fetch_assoc($profit_result);
    $data['totalProfit'] = $profit_row['totalProfit'] ?? 0;

    // Query to get total sales (can be different from profit)
    $sales_query = "SELECT SUM(total_amount) AS totalSales FROM bookings WHERE status = 'completed'";
    $sales_result = mysqli_query($con, $sales_query);
    $sales_row = mysqli_fetch_assoc($sales_result);
    $data['totalSales'] = $sales_row['totalSales'] ?? 0;

    // Query to get total bookings
    $bookings_query = "SELECT COUNT(*) AS totalBookings FROM bookings";
    $bookings_result = mysqli_query($con, $bookings_query);
    $bookings_row = mysqli_fetch_assoc($bookings_result);
    $data['totalBookings'] = $bookings_row['totalBookings'] ?? 0;

    // Query to get total customers
    $customers_query = "SELECT COUNT(DISTINCT customer_id) AS totalCustomers FROM bookings";
    $customers_result = mysqli_query($con, $customers_query);
    $customers_row = mysqli_fetch_assoc($customers_result);
    $data['totalCustomers'] = $customers_row['totalCustomers'] ?? 0;

    $data['status'] = 'success';
} else {
    $data['status'] = 'error';
    $data['message'] = 'Invalid request method.';
}

echo json_encode($data);
?>