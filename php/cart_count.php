<?php
        $totalItems = 0;
        if (isset($_SESSION['cart'])) {
            $totalItems = count($_SESSION['cart']);
        }
        echo $totalItems;
?>