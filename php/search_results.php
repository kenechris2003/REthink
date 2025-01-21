<?php
session_start();

$host = "localhost";
$dbname = "web_project";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchTerm = isset($_GET['item']) ? $_GET['item'] : '';

if ($searchTerm) {
    $sql = "SELECT name, price, image_url FROM items WHERE name = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $result = null;
    }
} else {
    $result = null;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/item_suggestions.js" defer></script>
    
</head>
<body>
        <header>
        <div class="logo"><a href="../test.html">Rethink<span>.</span></a></div>
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
                <form action="php/search_results.php" method="GET">
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
                        foreach ($_SESSION['cart'] as $cart_item) {
                            $totalItems += $cart_item['quantity'];
                        }
                    }
                    echo $totalItems;
                    ?>
                </span>
            </div>
        </header>
    <main>
        <section id="search-results">
            <h2>Search Results</h2>
            <?php
            if ($result && $result->num_rows > 0) {
                echo "<div class='results-container'>";
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='result-item'>";
                    echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
                    echo "<h3>" . $row['name'] . "</h3>";
                    echo "<p>Price: $" . $row['price'] . "</p>";
                    echo "<form id='item-request' action='add_to_cart.php' method='POST'>";
                    echo "<input type='hidden' name='item' value='" . $row['name'] . "'>";
                    echo "<input type='hidden' name='price' value='" . $row['price'] . "'>";
                    echo "<label for='quantity'>Quantity:</label>";
                    echo "<input type='number' id='quantity' name='quantity' required>";
                    echo "<button type='submit'>Add to Cart</button>";
                    echo "</form>";
                    echo "</div>";
                }
                echo "</div>";
            } else {
                echo "<p>No items found matching your search.</p>";
            }
            if ($stmt) {
                $stmt->close();
            }
            $conn->close();
            ?>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Online Store. All rights reserved.</p>
    </footer>
</body>
</html>