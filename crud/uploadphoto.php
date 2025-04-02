<?php
echo "<pre>";


print_r($_FILES);

echo "</pre>";
$name = $_FILES['profile_photo']['name'];
$tmp_name = $_FILES['profile_photo']['tmp_name'];
//move_uploaded_file($_FILES['profile_photo']['tmp_name'], 'upload/aadhar.jpg');
move_uploaded_file($tmp_name,$name);
?>