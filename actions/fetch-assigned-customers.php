<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$staffId = $user_data['user_id'];

$data = [];

$query = "SELECT c.conversation_id, u.user_id, u.user_name, m.message_body, m.sent_at
          FROM conversations c
          JOIN users_accounts u ON u.user_id = c.initiator_id
          LEFT JOIN messages m ON m.conversation_id = c.conversation_id
          WHERE c.staff_id = '$staffId' AND c.status = 'active'
          GROUP BY c.conversation_id
          ORDER BY m.sent_at DESC";

$result = mysqli_query($con, $query);

if ($result) {
    $conversations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $conversations[] = $row;
    }
    $data['status'] = 'success';
    $data['conversations'] = $conversations;
} else {
    $data['status'] = 'error';
    $data['message'] = 'Failed to fetch assigned customers.';
}

echo json_encode($data);
?>