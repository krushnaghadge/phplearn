<?php
$conn = mysqli_connect('localhost','root','','phplearning' );

//print_r($_POST);
//print_r($_FILES);

//echo $_FILES['profile_photo']['tmp_name'];

move_uploaded_file($_FILES['profile_photo']['tmp_name'],'upload/'.$_FILES['profile_photo']['name']);


$profile_photo = $_FILES['profile_photo']['name'];
extract($_POST);

$sql= "INSERT INTO  fileupload ( username, mobile, email,profile_photo) VALUES ( '$username', '$mobile', '$email', '$profile_photo') ";

$res = mysqli_query($conn,$sql) ;


if($res)
{
    echo"sucessfully stored";
}
else
{
    echo"failed to stored"; 
}
?>  