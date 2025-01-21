<?php
session_start();

$host = "localhost";
$dbname = "web_project"; // Replace with your actual database name
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination logic
$limit = 10; // Number of products per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $limit) - $limit : 0;

// Fetch products from the database
$sql = "SELECT * FROM items LIMIT $start, $limit";
$result = $conn->query($sql);

// Fetch total number of products for pagination
$total_sql = "SELECT COUNT(*) FROM items";
$total_result = $conn->query($total_sql);
$total_products = $total_result->fetch_row()[0];
$total_pages = ceil($total_products / $limit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <header>
    <div class="logo"><a href="landing_page.php">Rethink<span>.</span></a></div>
        <nav>
            <ul class="nav-links">
                <li><a href="../php/landing_page.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../contact.php">Contact</a></li>
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
        <section class="products">
            <h2>Our Products</h2>
            <div class="product-list">
                <?php while ($product = $result->fetch_assoc()): ?>
                    <div class="product-item">
                        <img src="../images/bikes.png">
                        <h3><?php echo $product['name']; ?></h3>
                        <span class="price">$<?php echo $product['price']; ?></span>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <a href="products.php?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Rethink Mobility. All rights reserved.</p>
    </footer>
</body>
</html>
<?php
$conn->close();
?>