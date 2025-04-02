<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Method: GET, POST, PUT, PACH, DELETE');
header('Access-Control-Allow-Headers: content-type or other');
header('content-type: application/json ');
$_POST = json_decode(file_get_contents("php://input"),true);

$conn= mysqli_connect("localhost","root","","Learning");


$result = mysqli_query($conn,"SELECT * FROM product");

$res =[];
foreach ($result as $row)
{
    $res [] = $row;
}

echo json_encode($res);


?>