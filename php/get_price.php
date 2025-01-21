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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['item'])) {
        $item = $_POST['item'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT price FROM items WHERE name = ?");
        $stmt->bind_param("s", $item);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo json_encode(["status" => "success", "item" => $item, "price" => $row['price']]);
        } else {
            echo json_encode(["status" => "error", "message" => "Item not found"]);
        }

        $stmt->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Item not specified"]);
    }
}

$conn->close();
?>