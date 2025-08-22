<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$staffId = $user_data['user_id'];
$conversationId = $_GET['conversation_id'] ?? '';

$data = [];

if (empty($conversationId)) {
    $data['status'] = 'error';
    $data['message'] = 'Conversation ID is missing.';
    echo json_encode($data);
    exit();
}

$query = "SELECT m.conversation_id, m.message_body, m.sent_at, u.user_type
          FROM messages m
          JOIN users_accounts u ON u.user_id = m.sender_id
          WHERE m.conversation_id = '$conversationId'
          ORDER BY m.sent_at ASC";

$result = mysqli_query($con, $query);

if ($result) {
    $messages = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $messages[] = $row;
    }
    $data['status'] = 'success';
    $data['messages'] = $messages;
} else {
    $data['status'] = 'error';
    $data['message'] = 'Failed to fetch chat messages.';
}

echo json_encode($data);
?>