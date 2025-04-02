<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require 'config.php';

$_POST = json_decode(file_get_contents("php://input"), true);

if (!isset($_POST['product_name'], $_POST['product_price'], $_POST['product_qty'])) {
    echo json_encode(["status" => "error", "message" => "Invalid input"]);
    exit;
}

$name = $_POST['product_name'];
$price = $_POST['product_price'];
$qty = $_POST['product_qty'];
$desc = $_POST['product_description'] ?? '';
$exp_date = $_POST['product_exp_date'] ?? null;
$company = $_POST['product_company'] ?? '';

$query = "INSERT INTO product (product_name, product_price, product_qty, product_description, product_exp_date, product_company) 
          VALUES ('$name', '$price', '$qty', '$desc', '$exp_date', '$company')";
$result = mysqli_query($conn, $query);

echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Product added successfully" : "Failed to add product"]);
?>
