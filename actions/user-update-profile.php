<?php
session_start();

include("database-connection.php");

$data = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userName = !empty($_POST['userName']) ? mysqli_real_escape_string($con, $_POST['userName']) : null;
    $userEmail = !empty($_POST['userEmail']) ? mysqli_real_escape_string($con, $_POST['userEmail']) : null;
    $userPhoneNumber = !empty($_POST['userPhoneNumber']) ? mysqli_real_escape_string($con, $_POST['userPhoneNumber']) : null;
    $userStreetAddress = !empty($_POST['userStreetAddress']) ? mysqli_real_escape_string($con, $_POST['userStreetAddress']) : null;
    $userTownCity = !empty($_POST['userTownCity']) ? mysqli_real_escape_string($con, $_POST['userTownCity']) : null;
    $userZipCode = !empty($_POST['userZipCode']) ? mysqli_real_escape_string($con, $_POST['userZipCode']) : null;
    $userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    if (!$userName || !$userEmail || !$userPhoneNumber || !$userStreetAddress || !$userTownCity || !$userZipCode) {
        $data['status'] = "error";
        $data['message'] = "All fields except profile photo are required.";
    } else {
        if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == UPLOAD_ERR_OK) {
            $targetDir = "../assets/images/userProfile/";
            $fileName = basename($_FILES["fileToUpload"]["name"]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (!in_array($fileType, $allowTypes)) {
                $data['status'] = "error";
                $data['message'] = "Only JPG, JPEG, PNG, & GIF files are allowed.";
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)) {
                    $updatePhotoQuery = "UPDATE users SET user_photo='$fileName' WHERE user_id='$userId'";
                    mysqli_query($con, $updatePhotoQuery);
                } else {
                    $data['status'] = "error";
                    $data['message'] = "File upload failed.";
                    echo json_encode($data);
                    exit();
                }
            }
        }

        $updateQuery = "UPDATE users_accounts SET user_name = '$userName', user_email= '$userEmail', user_phone_number= '$userPhoneNumber', user_street_address= '$userStreetAddress', user_town_city= '$userTownCity', user_zip_code= '$userZipCode' WHERE user_id= '$userId'";
        if (mysqli_query($con, $updateQuery)) {
            $data['status'] = "success";
            $data['message'] = "Profile updated successfully.";
        } else {
            $data['status'] = "error";
            $data['message'] = "Database update failed.";
        }
    }
}

echo json_encode($data);
?>