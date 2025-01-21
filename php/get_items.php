<?php
header('Content-Type: application/json');

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

$sql = "SELECT name, price, image_url FROM items ORDER BY RAND() LIMIT 7";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $items = [];
    while ($row = $result->fetch_assoc()) {
        $items[] = $row;
    }
    echo json_encode(["status" => "success", "items" => $items]);
} else {
    echo json_encode(["status" => "error", "message" => "No items found"]);
}

$conn->close();
?>