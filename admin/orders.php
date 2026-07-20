<?php
include "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders | SAVORA Eatery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Manage Orders
    </h2>

    <?php

    $result = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");

    ?>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>Order Number</th>
                <th>Table</th>
                <th>Order Type</th>
                <th>Total</th>
                <th>Order Status</th>
                <th>Payment Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

        <?php while($order = mysqli_fetch_assoc($result)): ?>

            <tr>

                <td><?= $order['order_number']; ?></td>
                <td><?= $order['table_id']; ?></td>
                <td><?= $order['order_type']; ?></td>
                <td>GHS <?= number_format($order['total_amount'], 2); ?></td>
                <td><?= $order['order_status']; ?></td>
                <td><?= $order['payment_status']; ?></td>
                <td><?= $order['created_at']; ?></td>
                 <td>
                    <a href="/restaurant-order-system/admin/view_order.php?id=<?= $order['id']; ?>" class="btn btn-sm btn-primary">
                        View
                    </a>
                </td>
                

            </tr>

        <?php endwhile; ?>

        </tbody>

    </table>

</div>

</body>
</html>