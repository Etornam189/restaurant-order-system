<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include "../includes/db.php";

include "includes/admin_auth.php";

include "includes/admin_header.php";

include "includes/admin_sidebar.php";


// Total orders
$total_orders_query = mysqli_query($conn, 
    "SELECT COUNT(*) AS total FROM orders"
);

$total_orders = mysqli_fetch_assoc($total_orders_query)['total'];


// Pending orders
$pending_query = mysqli_query($conn,
    "SELECT COUNT(*) AS total 
     FROM orders 
     WHERE order_status='Pending'"
);

$pending_orders = mysqli_fetch_assoc($pending_query)['total'];


// Completed orders
$completed_query = mysqli_query($conn,
    "SELECT COUNT(*) AS total 
     FROM orders 
     WHERE order_status='Completed'"
);

$completed_orders = mysqli_fetch_assoc($completed_query)['total'];


// Total revenue
$revenue_query = mysqli_query($conn,
    "SELECT SUM(total_amount) AS total 
     FROM orders 
     WHERE payment_status='Paid'"
);

$revenue_result = mysqli_fetch_assoc($revenue_query);

$total_revenue = $revenue_result['total'] ?? 0;



?>


<div class="main">


<header class="topbar">

    <div>
        <div class="eyebrow">
            Overview
        </div>

        <h1>
            Dashboard
        </h1>
    </div>


</header>



<div class="content">


<div class="content">


<div class="row g-4 mb-4">


    <!-- TOTAL ORDERS -->
    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-receipt-cutoff"></i>
            </div>

            <div class="stat-value">
               <?= $total_orders ?>
            </div>

            <div class="stat-label">
                Total Orders
            </div>

        </div>

    </div>



    <!-- PENDING ORDERS -->
    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="stat-value">
               <?= $pending_orders ?>
            </div>

            <div class="stat-label">
                Pending Orders
            </div>

        </div>

    </div>




    <!-- COMPLETED ORDERS -->
    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-check-circle"></i>
            </div>

            <div class="stat-value">
                <?= $completed_orders ?>
            </div>

            <div class="stat-label">
                Completed Orders
            </div>

        </div>

    </div>





    <!-- REVENUE -->
    <div class="col-md-6 col-xl-3">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="stat-value">
               GH₵ <?= number_format($total_revenue,2) ?>
            </div>

            <div class="stat-label">
                Total Revenue
            </div>

        </div>

    </div>


</div>


</div>


</div>



</div>


<?php

include "includes/admin_footer.php";

?>