<?php
session_start();
include("database-connection.php");
include("check-login.php");

$user_data = check_login($con);
$loggedInUser = $user_data['user_id'];
$data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $messageContent = $_POST['message'] ?? '';

    if (empty($messageContent)) {
        $data['status'] = 'error';
        $data['message'] = 'Message content is missing.';
    } else {
        // Fetch user information
        $queryUser = "SELECT * FROM users_accounts WHERE user_id = '$loggedInUser'";
        $resultUser = mysqli_query($con, $queryUser);
        $user = mysqli_fetch_assoc($resultUser);

        // Create or fetch the conversation
        $queryConversation = "SELECT conversation_id, initiator_id, staff_id, created_at, updated_at, status FROM conversations WHERE initiator_id = '{$user['user_id']}' AND status = 'active'";
        $resultConversation = mysqli_query($con, $queryConversation);

        if (mysqli_num_rows($resultConversation) == 0) {
            // No active conversation found, create a new one
            $queryCreateConversation = "INSERT INTO conversations (initiator_id, status, created_at) VALUES ('{$user['user_id']}', 'pending', NOW())";
            $resultCreateConversation = mysqli_query($con, $queryCreateConversation);

            if (!$resultCreateConversation) {
                $data['status'] = 'error';
                $data['message'] = 'Failed to create a new conversation.';
                echo json_encode($data);
                exit();
            }

            $conversationId = mysqli_insert_id($con);
        } else {
            $conversation = mysqli_fetch_assoc($resultConversation);
            $conversationId = $conversation['conversation_id'];
        }

        // Check if a staff member is assigned to this user in general (not by conversation ID)
        $queryCheckStaffAssignment = "SELECT staff_id FROM staff WHERE status = 'assigned' LIMIT 1";
        $resultCheckStaffAssignment = mysqli_query($con, $queryCheckStaffAssignment);

        if (mysqli_num_rows($resultCheckStaffAssignment) > 0) {
            // Staff is already assigned
            $data['assignedStaff'] = true;
        } else {
            // No staff assigned, assign one
            $queryStaff = "SELECT staff_id FROM staff WHERE status = 'pending' LIMIT 1";
            $resultStaff = mysqli_query($con, $queryStaff);
            $staff = mysqli_fetch_assoc($resultStaff);

            if ($staff) {
                $staffId = $staff['staff_id'];
                $queryAssignStaff = "UPDATE conversations SET staff_id = '$staffId' WHERE conversation_id = '$conversationId'";
                $resultAssignStaff = mysqli_query($con, $queryAssignStaff);

                if (!$resultAssignStaff) {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed to assign staff to the conversation.';
                    echo json_encode($data);
                    exit();
                }

                // Mark the staff as assigned to this conversation
                $queryUpdateStaffAssignment = "UPDATE staff SET status = 'assigned' WHERE staff_id = '$staffId'";
                $resultUpdateStaffAssignment = mysqli_query($con, $queryUpdateStaffAssignment);

                if (!$resultUpdateStaffAssignment) {
                    $data['status'] = 'error';
                    $data['message'] = 'Failed to update staff assignment.';
                    echo json_encode($data);
                    exit();
                }

                $data['assignedStaff'] = true;
            } else {
                // No available staff
                $data['assignedStaff'] = false;
            }
        }

        // Insert the message into the messages table with receiver_id
        // $queryInsertMessage = "INSERT INTO messages (conversation_id, sender_id, receiver_id, message_body, sent_at) VALUES ('$conversationId', '$loggedInUser', '$staffId', '$messageContent', NOW())";
        // $resultInsertMessage = mysqli_query($con, $queryInsertMessage);

        // Insert the message into the messages table
        $queryInsertMessage = "INSERT INTO messages (conversation_id, sender_id, message_body, sent_at) VALUES ('$conversationId', '$loggedInUser', '$messageContent', NOW())";
        $resultInsertMessage = mysqli_query($con, $queryInsertMessage);

        if ($resultInsertMessage) {
            $data['status'] = 'success';
            $data['message'] = $data['assignedStaff']
                ? "Your message has been received and is being handled."
                : "Your message has been received. Please wait while we assign a staff member.";
            $data['user_type'] = $user_data['user_type'];
            $data['message_body'] = $messageContent; // Include the sent message body
        } else {
            $data['status'] = 'error';
            $data['message'] = 'Failed to send message.';
        }
    }

    echo json_encode($data);
}
?>