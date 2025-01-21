<?php
session_start();
$_SESSION['from_home_logged_in'] = true;
echo json_encode(["success" => true]);
?>