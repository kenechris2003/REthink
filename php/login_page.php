<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in page</title>
    <link rel="stylesheet" href="../css/styles.css">  
    <script src="../js/login_script.js" defer></script>
    <script src="../js/landing_page.js" defer></script>

</head>
<header>
<div class="logo"><a href="landing_page.php">Rethink<span>.</span></a></div>
    </header>
<body>
  <section id="login">
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Login</button>
      </form>

    <p class="reg">Don't have an account? <a href="register.php">Register here</a></p>
</section>      
</body>
</html>

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

if (isset($_SERVER["REQUEST_METHOD"]) && $_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            echo json_encode(["status" => "userFound"]);

        } else {
            echo json_encode(["status" => "invalid_data"]);
        }
    } else {
        echo "User not found.";
    }

    $conn->close();
}
?>
