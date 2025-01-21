<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.html");
    exit();
}

$host = "localhost";
$dbname = "web_project";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" || (isset($_GET['item']) && isset($_GET['price']))) {
    $item = $_POST['item'] ?? $_GET['item'];
    $quantity = $_POST['quantity'] ?? 1;
    $price = $_POST['price'] ?? $_GET['price'];
    $total_price = $quantity * $price;

    // Store the item in the session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = [
        'item' => $item,
        'quantity' => $quantity,
        'price' => $price,
        'total_price' => $total_price
    ];

    // Redirect to the cart page
    header("Location: cart.php");
    exit();
} else {
    echo "Invalid input";
}

$conn->close();
?>