<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conversationId = $_POST['conversation_id'] ?? '';
    $messageContent = $_POST['message'] ?? '';

    if (empty($conversationId) || empty($messageContent)) {
        $data['status'] = 'error';
        $data['message'] = 'Conversation ID or message content is missing.';
    } else {
        $queryInsertMessage = "INSERT INTO messages (conversation_id, sender_id, message_body, sent_at) VALUES ('$conversationId', '$loggedInUser', '$messageContent', NOW())";
        $resultInsertMessage = mysqli_query($con, $queryInsertMessage);

        if ($resultInsertMessage) {
            $data['status'] = 'success';
            $data['message'] = 'Message sent successfully.';
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Failed to send message.';
        }
    }

    echo json_encode($data);
}
?>