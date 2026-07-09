<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top shadow-sm">
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
                   <a href="/restaurant-order-system/cart.php" class="btn btn-warning">
                    Cart (
                    <?php echo count($_SESSION['cart']); ?>
                    )
                </a>
                </li>

            </ul>

        </div>

    </div>
</nav>