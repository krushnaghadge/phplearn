<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Learning";
// Create a connection
$con = mysqli_connect($servername, $username, $password, $dbname);


extract($_POST);
$sql = "INSERT INTO product(product_name,product_price,product_qty,product_description,product_exp_date,product_company)
 VALUES('$product_name','$product_price','$product_qty','$product_description','$product_exp_date','$product_company' )";
$res = mysqli_query($con,$sql) ;
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