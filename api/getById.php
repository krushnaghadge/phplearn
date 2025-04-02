<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require 'config.php';

if (!isset($_GET['id'])) {
    echo json_encode(["status" => "error", "message" => "Product ID is required"]);
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM product WHERE product_id = $id";
$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);
echo json_encode($data ?: ["status" => "error", "message" => "Product not found"]);
?>
