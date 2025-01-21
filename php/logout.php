<?php
session_start();
session_destroy();
header("Location: ../landing_page.html");
exit();
?>