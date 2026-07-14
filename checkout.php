<?php
session_start();

include 'includes/db.php';

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

<?php include 'includes/navbar.php'; ?>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Checkout
    </h2>

    <h4>Order Summary</h4>

    <?php
    $total = 0;

    foreach ($_SESSION['cart'] as $item):

        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>

    <div class="card mb-3">
        <div class="card-body">

            <h5>
                <?= $item['name']; ?>
            </h5>

            <p>
                Quantity: <?= $item['quantity']; ?>
            </p>

            <p>
                Spice: <?= $item['spice']; ?>
            </p>

            <p>
                Extras:
                <?= implode(", ", $item['extras'] ?? []); ?>
            </p>

            <p>
                Notes: <?= $item['notes']; ?>
            </p>

            <p>
                Subtotal: GHS <?= number_format($subtotal, 2); ?>
            </p>

        </div>
    </div>

    <?php endforeach; ?>


    <h4>
        Total: GHS <?= number_format($total, 2); ?>
    </h4>

    <form action="place_order.php" method="POST">
        <div class="card mb-4 shadow-sm" style="border: 4px solid #0d6efd;">

            <div class="card-body">

                <h5 class="card-title">
                    Order Type
                </h5>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order_type" value="Dine-in" checked>
                    <label class="form-check-label">
                        Dine-in
                    </label>
                </div>

                <div class="form-check">
                    <input class="form-check-input" type="radio" name="order_type" value="Takeaway">
                    <label class="form-check-label">
                        Takeaway
                    </label>
                </div>

            </div>

        </div>

        <div class="card mb-4 shadow-sm" style="border: 4px solid #0d6efd;">
            <div class="card-body">

                <h5 class="card-title">
                    🪑 Table Information
                </h5>

                <p class="text-muted">
                    Enter the table number you are seated at.
                </p>

                <label class="form-label fw-bold">
                    Table Number
                </label>

                <select name="table_id" class="form-select" required>

                    <option value="">
                        Select Table
                    </option>

                    <?php

                    $tableQuery = "SELECT * FROM tables 
                                WHERE status='Available'
                                ORDER BY table_number";

                    $tableResult = mysqli_query($conn, $tableQuery);

                    while($table = mysqli_fetch_assoc($tableResult)):

                    ?>

                    <option value="<?= $table['id']; ?>">
                        Table <?= $table['table_number']; ?>
                    </option>

                    <?php endwhile; ?>

                </select>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">
            Place Order
        </button>

    </form>

</div>



</body>
</html>