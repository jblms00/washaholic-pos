<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

$queryConversation = "
    SELECT c.conversation_id, c.initiator_id, c.staff_id, c.created_at, c.updated_at, c.status, 
           m.message_id, m.sender_id, m.message_body, m.sent_at, u.user_type
    FROM conversations c
    LEFT JOIN messages m ON c.conversation_id = m.conversation_id
    LEFT JOIN users_accounts u ON m.sender_id = u.user_id
    WHERE c.initiator_id = '$loggedInUser'
    ORDER BY m.sent_at ASC
";

$result = mysqli_query($con, $queryConversation);

if (!$result) {
    $data['status'] = 'error';
    $data['message'] = 'Failed to fetch conversation.';
} else {
    $conversations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $conversations[] = $row;
    }
    $data['status'] = 'success';
    $data['conversations'] = $conversations;
}

echo json_encode($data);
?>