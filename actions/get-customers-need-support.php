<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "
        SELECT u.user_id, u.user_name, u.user_email, c.conversation_id
        FROM users_accounts u
        JOIN conversations c ON u.user_id = c.initiator_id
        WHERE u.user_type = 'user' AND c.status = 'pending'";

    $result = mysqli_query($con, $query);

    if ($result) {
        $customers = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $customers[] = [
                'user_id' => $row['user_id'],
                'user_name' => $row['user_name'],
                'user_email' => $row['user_email'],
                'conversation_id' => $row['conversation_id'],
            ];
        }

        $data['status'] = "success";
        $data['customers'] = $customers;
    } else {
        $data['status'] = "error";
        $data['message'] = "Failed to fetch customers.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request.";
}

echo json_encode($data);
?>