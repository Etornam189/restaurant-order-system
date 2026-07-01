<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Your Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4 text-center">
        Your Cart
    </h2>

    <?php if (!empty($_SESSION['cart'])) : ?>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-dark">

                    <tr>

                        <th>Item</th>

                        <th>Price (GHS)</th>

                        <th>Quantity</th>

                        <th>Subtotal</th>

                        <th>Spice Level</th>

                        <th>Notes</th>

                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                <?php

                $total = 0;

                foreach ($_SESSION['cart'] as $index => $item) :

                    $subtotal = $item['price'] * $item['quantity'];

                    $total += $subtotal;

                ?>

                    <tr>

                        <td><?php echo htmlspecialchars($item['name']); ?></td>

                        <td><?php echo number_format($item['price'], 2); ?></td>

                        <td><?php echo $item['quantity']; ?></td>

                        <td><?php echo number_format($subtotal, 2); ?></td>

                        <td><?php echo htmlspecialchars($item['spice']); ?></td>

                        <td><?php echo htmlspecialchars($item['notes']); ?></td>

                        <td>

                            <a href="remove_item.php?index=<?php echo $index; ?>"
                               class="btn btn-danger btn-sm">

                                Remove

                            </a>

                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

        <div class="text-end">

            <h4 class="fw-bold">
                Total: GHS <?php echo number_format($total, 2); ?>
            </h4>

        </div>

        <div class="d-flex justify-content-between mt-4">

            <a href="index.php" class="btn btn-secondary">
                Continue Shopping
            </a>

            <a href="#" class="btn btn-success">
                Proceed to Checkout
            </a>

        </div>

    <?php else : ?>

        <div class="text-center">

            <h5>Your cart is empty.</h5>

            <a href="index.php" class="btn btn-primary mt-3">
                Browse Menu
            </a>

        </div>

    <?php endif; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>