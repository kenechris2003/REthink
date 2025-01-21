<?php

$host = "localhost";
$dbname = "web_project";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Here you can handle the purchase logic, e.g., inserting a record into a purchases table
    // For simplicity, we'll just return a success message
    echo json_encode(["status" => "success", "message" => "Purchase successful!"]);
}

$conn->close();
?>