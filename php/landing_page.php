<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rethink Mobility</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/script.js" defer></script>
    <script src="../js/landing_page.js" defer></script>

</head>
<body>
    <header>
    <div class="logo"><a href="landing_page.php">Rethink<span>.</span></a></div>
        <nav>
            <button class="menu-toggle">☰</button>
            <ul class="nav-links" id="nav-links">
                <li><a href="login_page.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#contact">Contact Us</a></li>
            </ul>
        </nav>
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
        <section class="hero">
            <div class="hero-content">
                <h1 style="font-size: 60px; color: #000;">Rethinking Mobility </h1>
                <h1 style="font-size: 60px; color: #000;">in Design<p class="subheading">Making easy to use.</p></h1>
               
            </div>
            <div class="product-display">
                <img src="../images/scooter.png" alt="Scooter for Life" class="product-image">
            </div>
        </section>
        <section class="hero-description">
            <p class="description">
                The Scooter for Life is a special prototype designed to provide users with greater mobility.
            </p>
            <div class="pricing">
                <span class="price">$260.00</span>
                <button class="buy-now"><a href="login_page.php">Buy Now</a></button>
            </div>
            <a href="../php/products.php" class="browse-accessories">Browse all accessories</a>
        </section>

        <section class="statistics">
            <div class="stat">
                <h2>20K+</h2>
                <p>Customers</p>
            </div>
            <div class="stat">
                <h2>6K</h2>
                <p>Reviews</p>
            </div>
        </section>

        <section class="accessories" id="accessories">
            <div class="accessory">
                <h3>Hand Grip</h3>
                <p>Unique Shape Light</p>
                <span class="price">$20.00</span>
            </div>
            <div class="accessory">
                <h3>Hubless Rear</h3>
                <p>Ease Movement</p>
                <span class="price">$30.00</span>
            </div>
        </section>
    </main>

    <footer>
        <div class="socials">
            <a href="#facebook">Facebook</a>
            <a href="#twitter">Twitter</a>
            <a href="#instagram">Instagram</a>
        </div>
    </footer>
</body>
</html>
