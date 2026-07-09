<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | SAVORA Eatery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Checkout
    </h2>

    <p>This page will collect customer information before placing the order.</p>

</div>

</body>
</html>