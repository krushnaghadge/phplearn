<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

require 'config.php';

$_DELETE = json_decode(file_get_contents("php://input"), true);

if (!isset($_DELETE['id'])) {
    echo json_encode(["status" => "error", "message" => "Product ID is required"]);
    exit;
}

$id = $_DELETE['id'];
$query = "DELETE FROM product WHERE product_id = $id";
$result = mysqli_query($conn, $query);

echo json_encode(["status" => $result ? "success" : "error", "message" => $result ? "Product deleted successfully" : "Failed to delete product"]);
?>
