<?php
session_start();

if (isset($_SESSION['from_home_logged_in']) && $_SESSION['from_home_logged_in'] === true) {
    unset($_SESSION['from_home_logged_in']);
    header("Location: checkout.php");
} else {
    header("Location:login_page.php");
}
exit();
?>