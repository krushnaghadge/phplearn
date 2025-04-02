<!DOCTYPE html>
<html>
<head>
<title>Import CSV File Into MySQL </title>
</head>
<body>
<div id="wrapper">
<form method="post" action="" enctype="multipart/form-data">
<input type="file" name="file" />
<input type="submit" name="submit" value="Upload File" />
</form>
</div>
</body>
</html>

<?php
$databaseHost = 'localhost';
$databaseuser = 'root';
$databasePassword = '';
$databaseName = 'phplearning';

$conn = mysqli_connect($databaseHost, $databaseuser, $databasePassword, $databaseName);

if (isset($_POST['submit'])) {
    $mimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');

    if (in_array($_FILES['file']['type'], $mimes)) {
        $file = $_FILES['file']['tmp_name'];
        $count = 0;
        $file_open = fopen($file, 'r');

        while (!feof($file_open)) {
            $csv = fgetcsv($file_open, 1000);
            $count++;

            if ($count == 1) {
                continue; //skips inserting titles.
            }
            

            $query = "INSERT INTO csv1 (First_Name, Last_Name, Title, Company, Company_Name_for_Emails, Email_ok, Email_Status, Email_Confidence) VALUES ('" . $csv[0] . "', '" . $csv[1] . "', '" . $csv[2] . "', '" . $csv[3] . "', '" . $csv[4] . "', '" . $csv[5] . "', '" . $csv[6] . "', '" . $csv[7] . "')";
            $result = mysqli_query($conn, $query);
        }

        echo '<br />Data Inserted in database';
        fclose($file_open);
    } else {
        die('<br/>Sorry, File type Error. Only CSV file allowed.');
    }
}

mysqli_close($conn);
?>
