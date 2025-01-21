<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
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
        <section id="payment">
            <h2>Payment Page</h2>
            <form action="php/process_payment.php" method="POST" id="payment-form">
                <div class="form-group">
                    <label for="card-number">Card Number:</label>
                    <input type="text" id="card-number" name="card_number" placeholder="XXXX-XXXX-XXXX-XXXX" required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="month" id="expiry-date" name="expiry_date" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="password" id="cvv" name="cvv" required>
                </div>
                <button type="submit">Pay</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Online Store. All rights reserved.</p>
    </footer>
</body>
</html>