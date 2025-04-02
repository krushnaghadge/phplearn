<?php
echo "<pre>";
print_r($_POST);
extract($_POST);
$sql="UPDATE product SET Product_name='$product_name',product_price='$product_price',product_qty='$product_qty',product_description='$product_description',product_exp_date='$product_exp_date',product_company='$product_company' WHERE product_id='$product_id'";

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Learning";
// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$res = mysqli_query($conn,$sql);
if($res)
{
    header('location:addproduct.php');
    echo"record inserted";

}

else
{
echo "record not inserted";
}




?>