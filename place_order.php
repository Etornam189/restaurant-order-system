<?php

session_start();

include "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $order_type = $_POST['order_type'];
    $table_id = $_POST['table_number'];

    $total_amount = 0;

    foreach ($_SESSION['cart'] as $item) {
        $total_amount += $item['price'] * $item['quantity'];
    }

    $order_number = "ORD" . time();

    $order_status = "Pending";
    $payment_status = "Pending";


    $sql = "INSERT INTO orders 
    (order_number, table_id, order_type, total_amount, order_status, payment_status)
    VALUES
    ('$order_number', '$table_id', '$order_type', '$total_amount', '$order_status', '$payment_status')";


    if (mysqli_query($conn, $sql)) {

    $order_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $item) {

        $menu_item_id = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];
        $spice = $item['spice'];
        $extras = implode(", ", $item['extras'] ?? []);
        $notes = $item['notes'];

        $item_sql = "INSERT INTO order_items
        (order_id, menu_item_id, quantity, price, spice_level, extras, notes)
        VALUES
        ('$order_id', '$menu_item_id', '$quantity', '$price', '$spice', '$extras', '$notes')";

        mysqli_query($conn, $item_sql);
    }

    echo "Order placed successfully";

    }else{

        echo "Error: " . mysqli_error($conn);

    }

}

?>