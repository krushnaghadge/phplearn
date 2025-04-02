<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<form method="post" enctype="multipart/form-data"  action="">
	
	<input type="file" name="upload" id="upload">
	<input type="submit" name="submit">
</form>
</body>
</html>

<?php
	if(isset($_POST['submit'])){
		//$upload=$_POST['upload'];
		move_uploaded_file($_FILES['upload']['tmp_name'], "img/one.jpg");
	}