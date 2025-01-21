<?php
session_start();

if (isset($_POST['index']) && isset($_POST['quantity'])) {
    $index = $_POST['index'];
    $quantity = $_POST['quantity'];

    if (isset($_SESSION['cart'][$index])) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        $_SESSION['cart'][$index]['total_price'] = $_SESSION['cart'][$index]['price'] * $quantity;
    }
}

header('Location: cart.php');
exit();
?>