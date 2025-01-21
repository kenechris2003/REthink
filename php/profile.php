<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: home_logged_in.php");
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

$user_id = $_SESSION['user_id'];

$sql = "SELECT username FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<header>
                <div class="logo"><a href="landing_page.php">Rethink<span>.</span></a></div>
                    
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
        <section id="profile">
            <h2>Profile</h2>
            <p>Username: <?php echo htmlspecialchars($username); ?></p>
            <a href="../logout.php">Logout</a>
        </section>
    </main>
</body>
</html>