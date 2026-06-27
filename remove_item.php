<?php
session_start();

if (isset($_GET['index'])) {
    $index = $_GET['index'];

    unset($_SESSION['cart'][$index]);

    // re-index array
    $_SESSION['cart'] = array_values($_SESSION['cart']);
}

header("Location: index.php#cart");
exit;
?>