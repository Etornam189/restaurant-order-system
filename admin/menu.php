<?php
include "../includes/db.php";

include "includes/admin_auth.php";

include "includes/admin_header.php";

include "includes/admin_sidebar.php";
?>



<div class="main">

<header class="topbar">

    <h2 class="fw-bold">
        Manage Menu
    </h2>

</header>

<div class="content">

<div class="page-card">


    <?php

        $result = mysqli_query($conn, "SELECT * FROM menu_items ORDER BY id DESC");

    ?>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>Image</th>
                <th>Food Name</th>
                <th>Price</th>
                <th>Preparation Time</th>
                <th>Availability</th>
                <th>Featured</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

            <?php while($item = mysqli_fetch_assoc($result)): ?>

                <tr>

                    <td>
                        <img src="/restaurant-order-system/<?= $item['image']; ?>"
                            width="150"
                            height="100"
                            class="rounded"
                            style="object-fit: cover;">
                    </td>

                    <td><?= $item['name']; ?></td>

                    <td>GHS <?= number_format($item['price'], 2); ?></td>

                    <td><?= $item['preparation_time']; ?> mins</td>

                    <td><?= $item['availability']; ?></td>

                    <td><?= $item['featured']; ?></td>

                    <td>

                        <a href="#" class="btn btn-sm btn-info me-3">
                            View
                        </a>

                        <a href="#" class="btn btn-sm btn-warning me-3">
                            Edit
                        </a>

                        <a href="#" class="btn btn-sm btn-danger">
                            Delete
                        </a>

                    </td>

                </tr>

            <?php endwhile; ?>

        </tbody>

    </table>

</div>

</div>

</div>

<?php include "includes/admin_footer.php"; ?>