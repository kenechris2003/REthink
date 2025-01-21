<?php
header('Content-Type: application/json');

// Database credentials
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['item']) && isset($_POST['quantity'])) {
        $item = $_POST['item'];
        $quantity = $_POST['quantity'];

        $sql = "INSERT INTO requests (item_name, quantity) VALUES ($item, $quantity)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $item, $quantity);

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Request submitted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid input"]);
    }
}

$conn->close();
?>