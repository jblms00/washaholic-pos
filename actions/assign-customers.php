<?php
header('Content-Type: application/json');
include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (
        isset($_POST['customerIds']) && is_array($_POST['customerIds']) &&
        isset($_POST['conversationIds']) && is_array($_POST['conversationIds']) &&
        isset($_POST['staffId'])
    ) {

        $customerIds = $_POST['customerIds'];
        $conversationIds = $_POST['conversationIds'];
        $staffId = mysqli_real_escape_string($con, $_POST['staffId']);

        if (count($customerIds) != count($conversationIds)) {
            $data['status'] = "error";
            $data['message'] = "Mismatched customer IDs and conversation IDs count.";
            echo json_encode($data);
            exit;
        }

        foreach ($customerIds as $index => $customerId) {
            $customerId = mysqli_real_escape_string($con, $customerId);
            $conversationId = mysqli_real_escape_string($con, $conversationIds[$index]);

            $updateQuery = "UPDATE conversations SET staff_id ='$staffId', updated_at = NOW(), status ='active' 
                            WHERE initiator_id = '$customerId' AND conversation_id = '$conversationId'";
            $updateQueryResult = mysqli_query($con, $updateQuery);

            $insertQuery = "INSERT INTO staff (staff_id, user_id, assigned_date, status) 
                            VALUES ('$staffId', '$customerId', NOW(), 'active')";
            $insertQueryResult = mysqli_query($con, $insertQuery);


            if (!$updateQueryResult && !$insertQueryResult) {
                $data['status'] = "error";
                $data['message'] = "Failed to assign customer with ID: $customerId";
                echo json_encode($data);
                exit;
            }
        }

        $data['status'] = "success";
        $data['message'] = "Customers assigned successfully.";
    } else {
        $data['status'] = "error";
        $data['message'] = "Missing customer IDs, conversation IDs, or staff ID.";
    }
} else {
    $data['status'] = "error";
    $data['message'] = "Invalid request.";
}

echo json_encode($data);
?>