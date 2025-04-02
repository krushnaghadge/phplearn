<?php
$sql= 'DELETE FROM product WHERE product_id="'.$_GET['id'].'"';

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
    echo"record deleted";

}

else
{
echo "record not deleted";
}