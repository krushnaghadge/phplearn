<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require 'config.php';

$_PUT = json_decode(file_get_contents("php://input"), true);

if (!isset($_PUT['product_id'], $_PUT['product_name'], $_PUT['product_price'], $_PUT['product_qty'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$id = $_PUT['product_id'];
$name = $_PUT['product_name'];
$price = $_PUT['product_price'];
$qty = $_PUT['product_qty'];
$desc = $_PUT['product_description'] ?? '';
$exp_date = $_PUT['product_exp_date'] ?? null;
$company = $_PUT['product_company'] ?? '';

$query = "UPDATE product SET 
    product_name = '$name', 
    product_price = '$price', 
    product_qty = '$qty', 
    product_description = '$desc', 
    product_exp_date = '$exp_date', 
    product_company = '$company' 
    WHERE product_id = $id";

$result = mysqli_query($conn, $query);

echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Product updated successfully" : "Failed to update product"]);
?>
