<?php 
$databaseHost = 'localhost';
$databaseuser = 'root';
$databasePassword = '';
$databaseName = 'phplearning';

$conn = mysqli_connect($databaseHost, $databaseuser, $databasePassword, $databaseName); 
 
if(isset($_POST["submit"]))

{
 
$mimes =  
array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
 
 
if(in_array($_FILES["file"]["type"],$mimes)){


$file =    $_FILES["file"]["tmp_name"];
 
$count = 0;

$file_open = fopen($file, "r");
 
while (!feof($file_open))
{
	 
	$csv = fgetcsv($file_open, 1000);
	
	$count++;
	
	$id = $csv[0];
	$First_Name = $csv[1];
	$Last_Name = $csv[2]; 
    $Company = $csv[2]; 
    $Company_Name_for_Emails = $csv[2]; 
    $Email_ok = $csv[2]; 
    $Email_Status = $csv[2]; 
    $Email_Confidence = $csv[2]; 
	
	if($count == 1)   continue; //skips inserting titles. 
	 
$query = "insert into csv(First_Name,Last_Name,Company,Company_Name_for_Emails,Email_ok,Email_Status,Email_Confidence) values('".$First_Name."','".$Last_Name."','".$Company."','".$Company_Name_for_Emails."','".$Email_ok."','".$Email_Status."','".$Email_Confidence."')";
	
	$result = mysqli_query($conn,$query);
}
 
echo "<br />Data Inserted in dababase";

fclose($file_open); 
 
}
 
else { 
 
die("<br/>Sorry, File type Error. Only CSV file allowed."); 
 
}

mysqli_close($conn); 
 
}

?>
 
<html>
 
<head>

<title> :Import CSV File Into MySQL Using PHP  
 
</title>  
 
</head> 
 
<body>
 
<div id="wrapper">
 
<form method="post" action="" enctype="multipart/form-data"> 
 
 <input type="file" name="file"/>
 <input type="submit" name="submit" value="Upload File"/>
 
</form>
 
</div>
 
</body>
</html>