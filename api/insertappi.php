<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Method: GET, POST, PUT, PACH, DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('content-type: application/json ');
$_POST = json_decode(file_get_contents("php://input"),true);

$conn= mysqli_connect("localhost","root","","Learning");

extract($_POST);
$sql="INSERT INTO product ( product_name, product_price, product_qty) VALUES ( $product_name, $product_price, $product_qty) ";

$res = mysqli_query($conn,$sql);

$res =["status"=> "sucess","message"=>"product added sucessfully"];
echo json_encode($res);


?>