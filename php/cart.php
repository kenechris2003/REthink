<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../css/styles.css">

</head>
<body>
<header>
                <div class="logo"><a href="home_logged_in.php">Rethink<span>.</span></a></div>
                    
                <nav>
                    <button class="menu-toggle">☰</button>
                    <ul class="nav-links">
                        <li><a href="#product">Product</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#blog">Blog</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                        <li><a href="profile.php">Profile</a></li>
                    </ul>
                </nav>
                <div class="search-bar">
                    <form action="search_results.php" method="GET">
                        <input type="text" id="item" name="item" placeholder="Search for an item..." list="items" required>
                        <datalist id="items"></datalist>
                        <button type="submit" id="search-button">Search</button>
                    </form>
                </div>
                <div class="cart">
                    <a href="cart.php"><img class="cart_img" src="../images/cart_3.png" alt="cart"></a>
                    <span class="cart-count">
                    <?php
                    $totalItems = 0;
                    if (isset($_SESSION['cart'])) {
                        $totalItems = count($_SESSION['cart']);
                    }
                    echo $totalItems;
                    ?>
                </span>
                </div>
            </header>
    <main>
        <section id="cart">
            <h2>Your Cart</h2>
            <?php
            if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                $totalPrice = 0;
                echo "<table class='cart-item'>";
                echo "<tr><th>Item</th><th>Quantity</th><th>Price</th><th>Total Price</th><th>Actions</th></tr>";
                foreach ($_SESSION['cart'] as $index => $cart_item) {
                    echo "<tr>";
                    echo "<td class='center'>" . $cart_item['item'] . "</td>";
                    echo "<td class='center'>";
                    echo "<form action='update_cart.php' method='POST'>";
                    echo "<input type='hidden' name='index' value='" . $index . "'>";
                    echo "<input type='number' name='quantity' value='" . $cart_item['quantity'] . "' min='1'>";
                    echo "<button type='submit'>Update</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "<td class='center'>$" . $cart_item['price'] . "</td>";
                    echo "<td class='center'>$" . $cart_item['total_price'] . "</td>";
                    echo "<td class='center'>";
                    echo "<form action='delete_cart_item.php' method='POST'>";
                    echo "<input type='hidden' name='index' value='" . $index . "'>";
                    echo "<button type='submit'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    $totalPrice += $cart_item['total_price'];
                }
                
                echo "<tr>";
                echo "<td colspan='3' class='center'><strong>Total</strong></td>";
                echo "<td class='center'><strong>$" . $totalPrice . "</strong></td>";
                echo "</tr>";
                echo "</table>";
                echo "<form action='checkout_redirect.php' method='POST'>";
                echo "<button type='submit'>Checkout</button>";
                echo "</form>";
                echo "<form action='clear_cart.php' method='POST'>";
                echo "<button type='submit' class='clear-cart'>Clear Cart</button>";
                echo "</form>";
            } else {
                echo "<p>Your cart is empty.</p>";
            }
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Revolt Bikes. All rights reserved.</p>
    </footer>
</body>
</html>