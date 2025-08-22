<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    // Query to get monthly bookings and revenue for the current year
    $year = date("Y");
    $bookingsQuery = "
        SELECT MONTHNAME(pickup_date) AS month, COUNT(*) AS bookings
        FROM bookings
        WHERE YEAR(pickup_date) = '$year'
        GROUP BY MONTH(pickup_date)
        ORDER BY MONTH(pickup_date)";

    $revenueQuery = "
        SELECT MONTHNAME(pickup_date) AS month, SUM(total_amount) AS revenue
        FROM bookings
        WHERE YEAR(pickup_date) = '$year'
        GROUP BY MONTH(pickup_date)
        ORDER BY MONTH(pickup_date)";

    $bookingsResult = mysqli_query($con, $bookingsQuery);
    $revenueResult = mysqli_query($con, $revenueQuery);

    if ($bookingsResult && $revenueResult) {
        $months = [];
        $bookingsData = [];
        $revenueData = [];

        while ($row = mysqli_fetch_assoc($bookingsResult)) {
            $months[] = $row['month'];
            $bookingsData[] = (int) $row['bookings'];
        }

        while ($row = mysqli_fetch_assoc($revenueResult)) {
            $revenueData[] = (float) $row['revenue'];
        }

        $data['status'] = "success";
        $data['months'] = $months;
        $data['bookingsData'] = $bookingsData;
        $data['revenueData'] = $revenueData;
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to fetch data";
    }
}

echo json_encode($data);
