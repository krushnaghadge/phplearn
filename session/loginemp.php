<?php

session_start();

$con=mysqli_connect('localhost','root','','phplearning');

extract($_POST);

$sql= "SELECT * FROM employee WHERE emp_mob='$emp_mob'AND emp_pass='$emp_pass' ";

$res=mysqli_query($con,$sql);

if(mysqli_num_rows($res)>0)
{
    foreach($res as $row)
      {
        //echo "sucess login";
        $_SESSION['emp_id']=$row['emp_id'];
        header('location:home.php');
        break;
       }
}
else
     {
        echo"login Failed";
     }
?>