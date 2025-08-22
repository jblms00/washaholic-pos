<?php
session_start();
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $bookingsQuery = "SELECT DATE(created_at) AS created_at, status FROM bookings";
    $bookingsResult = mysqli_query($con, $bookingsQuery);

    if ($bookingsResult) {
        $bookings = [];
        while ($row = mysqli_fetch_assoc($bookingsResult)) {
            $date = date('Y-m-d', strtotime($row['created_at']));
            $bookings[] = [
                'date' => $date,
                'status' => $row['status']
            ];
        }

        $capacity = 30; // Capacity of bookings per day
        $events = [];

        // Calculate availability for each date in the range
        $startDate = isset($_GET['start']) ? $_GET['start'] : date('Y-m-d');
        $endDate = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d', strtotime('+1 year'));

        $currentDate = $startDate;
        while (strtotime($currentDate) <= strtotime($endDate)) {
            // Filter bookings for the current date
            $filteredBookings = array_filter($bookings, function ($booking) use ($currentDate) {
                return $booking['date'] === $currentDate;
            });

            // Count the number of accepted bookings
            $countPendingProcessing = count(array_filter($filteredBookings, function ($booking) {
                return in_array($booking['status'], ['accepted', 'scheduled for pickup', 'in pickup', 'in processing']);
            }));

            // Determine availability
            $isAvailable = ($countPendingProcessing < $capacity) ? "Available" : "Fully Booked";

            $events[] = [
                'id' => 'availability_' . $currentDate,
                'title' => $isAvailable,
                'start' => $currentDate,
                'backgroundColor' => $isAvailable === "Available" ? '#28a745' : '#dc3545', // Green for available, red for not available
                'textColor' => 'white'
            ];

            $currentDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
        }

        // Include the count of available slots if needed
        $availableCount = array_reduce($events, function ($carry, $event) {
            return $event['title'] === 'Available' ? $carry + 1 : $carry;
        }, 0);

        $data['status'] = 'success';
        $data['events'] = $events;
        $data['available'] = $availableCount;
    } else {
        $data['status'] = 'error';
        $data['message'] = 'Failed to fetch bookings data';
    }
} else {
    $data['status'] = 'error';
    $data['message'] = 'Invalid request method';
}

echo json_encode($data);
?>