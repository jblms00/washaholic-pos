<?php
session_start();

include("database-connection.php");

$data = [];

$get_faqs_query = "SELECT * FROM faqs ORDER BY faq_id ASC";
$get_faqs_result = mysqli_query($con, $get_faqs_query);

if ($get_faqs_result) {
    $faqs = [];
    while ($row = mysqli_fetch_assoc($get_faqs_result)) {
        $faqs[] = $row;
    }
    $data['status'] = 'success';
    $data['faqs'] = $faqs;
} else {
    $data['status'] = 'error';
    $data['message'] = 'Failed to fetch FAQs.';
}

echo json_encode($data);
?>