<?php

session_start();

include "../includes/db.php";

?>

<!DOCTYPE html>
<html>
<head>

    <title>Kitchen Orders | SAVORA Eatery</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container py-5">

    <h2 class="fw-bold mb-4">
        Kitchen Orders
    </h2>

    <?php

        $orderQuery = "SELECT *
                    FROM orders
                    ORDER BY created_at DESC";

        $orderResult = mysqli_query($conn, $orderQuery);


        while($order = mysqli_fetch_assoc($orderResult)):

    ?>

    <div class="card mb-4 shadow-sm">

        <div class="card-body">

            <h5 class="fw-bold">
                Order No: <?= $order['order_number']; ?>
            </h5>

            <p>
                Table: <?= $order['table_id']; ?>
            </p>

            <p>
                Type: <?= $order['order_type']; ?>
            </p>

            <p>
                Status: <?= $order['order_status']; ?>
            </p>

        </div>

    </div>

    <?php endwhile; ?>

</div>

</body>
</html>