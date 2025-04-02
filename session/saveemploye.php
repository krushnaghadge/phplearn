<?php

$con=mysqli_connect('localhost','root','','phplearning');
//$sql= "CREATE TABLE employee (emp_id INT PRIMARY KEY AUTO_INCREMENT, emp_name VARCHAR (200), emp_mob VARCHAR (15), emp_mail VARCHAR (200), emp_pass VARCHAR (200))";
extract($_POST);
$sql= "INSERT INTO employee(emp_name,emp_mob,emp_mail,emp_pass) VALUES ('$emp_name','$emp_mob','$emp_mail','$emp_pass')";



$res=mysqli_query($con,$sql);

if ($res)
{
    header('location:login.php');
    //echo"created";
}
else
{
    echo"failed";
}
?>