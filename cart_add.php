<?php
session_start();

$data = json_decode(file_get_contents("php://input"), true);

$item = [
    "id" => $data["id"],
    "name" => $data["name"],
    "price" => $data["price"],
    "quantity" => $data["quantity"],
    "notes" => $data["notes"],
    "spice" => $data["spice"]
];

$_SESSION['cart'][] = $item;

echo json_encode([
    "status" => "success",
    "cart" => $_SESSION['cart']
]);
?>