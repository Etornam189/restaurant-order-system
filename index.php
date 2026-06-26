<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger fixed-top shadow-sm">
    <div class="container">

        <a class="navbar-brand fw-bold" href="index.php">
            🍽 SAVORA EATERY
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Menu
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact
                    </a>
                </li>

                <li class="nav-item ms-lg-3">
                    <a href="#" class="btn btn-warning">
                        Cart (0)
                    </a>
                </li>

            </ul>

        </div>

    </div>
</nav>

<section id="hero" class="py-5">

    <div class="container">

        <div class="row align-items-center">

            <div class="col-lg-6">

                <h1 class="display-4 fw-bold">
                    Digital Restaurant Ordering Experience
                </h1>

                <p class="lead mt-3">
                    Browse the restaurant menu, customize your meal, and place your order directly from your phone, tablet, or the restaurant's digital ordering screen.
                </p>

                <a href="#menu" class="btn btn-warning btn-lg mt-3">
                    Order Now
                </a>

            </div>

            <div class="col-lg-6 text-center">

                <img src="/restaurant-order-system/assets/images/fufu.jpg"
                     style="width:500px; height:400px; object-fit:cover;"
                     class="img-fluid"
                     alt="Food Image">

            </div>

        </div>

    </div>

</section>

<section id="menu" class="py-5" style="background-color: #FFF8E7;">

    <div class="container">

        <h2 class="text-center mb-5 fw-bold">
            Our Menu
        </h2>

        <?php

        $categoryQuery = "SELECT * FROM categories
                          WHERE status='Available'
                          ORDER BY name";

        $categoryResult = mysqli_query($conn, $categoryQuery);

        while($category = mysqli_fetch_assoc($categoryResult)){

        ?>

            <div class="mb-5">

                <h3 class="fw-bold text-primary mb-4 border-bottom pb-2">
                    <?php echo $category['name']; ?>
                </h3>

                <div class="row">

                    <?php

                    $menuQuery = "SELECT *
                                  FROM menu_items
                                  WHERE category_id = {$category['id']}
                                  AND availability='Available'
                                  ORDER BY featured DESC, name";

                    $menuResult = mysqli_query($conn,$menuQuery);

                    while($row = mysqli_fetch_assoc($menuResult)){

                    ?>

                        <div class="col-6 col-md-3 mb-4">

                            <div class="card h-100 shadow-sm">

                                <img src="/restaurant-order-system/<?php echo $row['image']; ?>"
                                     class="card-img-top"
                                     style="height:180px; object-fit:cover;">

                                <div class="card-body d-flex flex-column">

                                    <h6 class="fw-bold">
                                        <?php echo $row['name']; ?>
                                    </h6>

                                    <p class="small text-muted mb-2">
                                        <?php echo $row['description']; ?>
                                    </p>

                                    <h5 class="text-success fw-bold">
                                        GHS <?php echo number_format($row['price'],2); ?>
                                    </h5>

                                    <button class="btn btn-dark mt-auto">
                                        Order
                                    </button>

                                </div>

                            </div>

                        </div>

                    <?php } ?>

                </div>

            </div>

        <?php } ?>

    </div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>