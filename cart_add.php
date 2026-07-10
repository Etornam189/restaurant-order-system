<?php
session_start();
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "No data received"
    ]);
    exit;
}

$item = [
    "id" => $data["id"],
    "name" => $data["name"],
    "price" => $data["price"],
    "quantity" => $data["quantity"],
    "notes" => $data["notes"],
    "spice" => $data["spice"],
    "extras" => $data["extras"] ?? [],
    "image" => $data["image"]
];

$_SESSION['cart'][] = $item;

echo json_encode([
    "status" => "success",
    "message" => "Item added successfully",
    "cart" => $_SESSION['cart']
]);
?>