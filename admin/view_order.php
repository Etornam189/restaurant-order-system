<?php
include "../includes/db.php";

if (!isset($_GET['id'])) {
    die("Order not found.");
}

$order_id = $_GET['id'];

$order = mysqli_query($conn, "SELECT * FROM orders WHERE id = '$order_id'");
$order = mysqli_fetch_assoc($order);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST['order_status'];

    mysqli_query($conn, "UPDATE orders
                         SET order_status = '$status'
                         WHERE id = '$order_id'");

    header("Location: view_order.php?id=" . $order_id);
    exit();
}

$items = mysqli_query($conn, "
    SELECT
        order_items.*,
        menu_items.name
    FROM order_items
    JOIN menu_items
        ON order_items.menu_item_id = menu_items.id
    WHERE order_items.order_id = '$order_id'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order | SAVORA Eatery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Order Details
    </h2>

    <div class="card">
        <div class="card-body">

            <p><strong>Order Number:</strong> <?= $order['order_number']; ?></p>

            <p><strong>Table:</strong> <?= $order['table_id']; ?></p>

            <p><strong>Order Type:</strong> <?= $order['order_type']; ?></p>

            <p><strong>Total:</strong> GHS <?= number_format($order['total_amount'],2); ?></p>

            <p><strong>Order Status:</strong> <?= $order['order_status']; ?></p>

            <p><strong>Payment Status:</strong> <?= $order['payment_status']; ?></p>

        </div>
    </div>

    <div class="card mt-4">

        <div class="card-header">
            <h5 class="mb-0">Update Order Status</h5>
        </div>

        <div class="card-body">

            <form method="POST">

                <div class="mb-3">

                    <label class="form-label">Order Status</label>

                    <select name="order_status" class="form-select">

                        <option value="Pending" <?= $order['order_status'] == 'Pending' ? 'selected' : ''; ?>>
                            Pending
                        </option>

                        <option value="Preparing" <?= $order['order_status'] == 'Preparing' ? 'selected' : ''; ?>>
                            Preparing
                        </option>

                        <option value="Ready" <?= $order['order_status'] == 'Ready' ? 'selected' : ''; ?>>
                            Ready
                        </option>

                        <option value="Completed" <?= $order['order_status'] == 'Completed' ? 'selected' : ''; ?>>
                            Completed
                        </option>

                    </select>

                </div>

                <button type="submit" class="btn btn-primary">
                    Update Status
                </button>

            </form>

        </div>

    </div>

    <div class="card mt-4">

        <div class="card-header">
            <h5 class="mb-0">Ordered Items</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Food Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Spice Level</th>
                        <th>Extras</th>
                        <th>Notes</th>
                    </tr>
                </thead>

                <tbody>

                <?php while($item = mysqli_fetch_assoc($items)): ?>

                    <tr>

                        <td><?= $item['name']; ?></td>
                        <td><?= $item['quantity']; ?></td>
                        <td>GHS <?= number_format($item['price'], 2); ?></td>
                        <td><?= $item['spice_level']; ?></td>
                        <td><?= $item['extras']; ?></td>
                        <td><?= $item['notes']; ?></td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        </div>

        

    </div>

</div>

</body>
</html>