<?php
header("Content-Type: application/json");

// Simple API status check
$response = [
    "status" => "success",
    "message" => "API is working fine 🚀"
];

echo json_encode($response);
?>
