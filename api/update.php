<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require 'config.php';

$_POST = json_decode(file_get_contents("php://input"), true);

if (!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "Product ID is required"]);
    exit;
}

$id = $_GET['id'];
$name = $_POST['product_name'];
$price = $_POST['product_price'];
$qty = $_POST['product_qty'];
$desc = $_POST['product_description'] ?? '';
$exp_date = $_POST['product_exp_date'] ?? null;
$company = $_POST['product_company'] ?? '';

$query = "UPDATE product SET product_name='$name', product_price='$price', product_qty='$qty', 
          product_description='$desc', product_exp_date='$exp_date', product_company='$company' 
          WHERE product_id=$id";
$result = mysqli_query($conn, $query);

echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Product updated successfully" : "Failed to update product"]);
?>
