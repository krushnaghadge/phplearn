<!DOCTYPE html>
<html>
<head>
    <title>Import CSV File Into MySQL</title>
</head>
<body>
    <div id="wrapper">
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="text" name="tablename" placeholder="Enter table name" />
            <input type="submit" name="submit" value="Upload File" />
        </form>
    </div>
</body>
</html>

<?php
$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePassword = '';
$databaseName = 'phplearning';

$conn = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $mimes = array('application/vnd.ms-excel', 'text/plain', 'text/csv', 'text/tsv');

    if (in_array($_FILES['file']['type'], $mimes)) {
        $tablename = $_POST['tablename'];
        $file = $_FILES['file']['tmp_name'];
        $count = 0;
        $file_open = fopen($file, 'r');

        // Check if the table exists before inserting data
        $check_table_query = "SHOW TABLES LIKE '$tablename'";
        $result_check_table = mysqli_query($conn, $check_table_query);

        if (!$result_check_table) {
            die("Error checking table existence: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result_check_table) == 0) {
            // Table does not exist, create the table first
            $create_table_query = "CREATE TABLE $tablename (
                id INT AUTO_INCREMENT PRIMARY KEY,
                First_Name VARCHAR(999),
                Last_Name VARCHAR(999),
                Title VARCHAR(999),
                Company VARCHAR(999), -- Increased the length to VARCHAR(500)
                Company_Name_for_Emails VARCHAR(999),
                Email_ok VARCHAR(999),
                Email_Status VARCHAR(999),
                Email_Confidence VARCHAR(999)
            )";

            $result_create_table = mysqli_query($conn, $create_table_query);

            if (!$result_create_table) {
                die("Error creating table: " . mysqli_error($conn));
            }

            echo "Table '$tablename' created successfully.<br>";
        }

        // Now, insert data into the table every 100 rows
        $batchSize = 1000;
        $batchValues = array();

        while (($csv = fgetcsv($file_open, 1000)) !== false) {
            $count++;

            if ($count == 1) {
                continue; //skip inserting titles.
            }

            // Truncate First_Name, Last_Name, and Company to a maximum length
            $truncated_first_name = substr($csv[0], 0, 255);
            $truncated_last_name = substr($csv[1], 0, 255);
            $truncated_company = substr($csv[3], 0, 500);

            // Escape values to prevent SQL injection
            $batchValues[] = "('" . mysqli_real_escape_string($conn, $truncated_first_name) . "', '" . mysqli_real_escape_string($conn, $truncated_last_name) . "', '" . mysqli_real_escape_string($conn, $csv[2]) . "', '" . mysqli_real_escape_string($conn, $truncated_company) . "', '" . mysqli_real_escape_string($conn, $csv[4]) . "', '" . mysqli_real_escape_string($conn, $csv[5]) . "', '" . mysqli_real_escape_string($conn, $csv[6]) . "', '')";

            if ($count % $batchSize === 0) {
                // Insert a batch of data every 100 rows
                $query = "INSERT INTO $tablename (First_Name, Last_Name, Title, Company, Company_Name_for_Emails, Email_ok, Email_Status, Email_Confidence) VALUES " . implode(",", $batchValues);

                $result = mysqli_query($conn, $query);

                if (!$result) {
                    die("Error inserting data at line $count: " . mysqli_error($conn));
                }

                $batchValues = array();
            }
        }

        // Insert any remaining rows (less than 100) if available
        if (!empty($batchValues)) {
            $query = "INSERT INTO $tablename (First_Name, Last_Name, Title, Company, Company_Name_for_Emails, Email_ok, Email_Status, Email_Confidence) VALUES " . implode(",", $batchValues);

            $result = mysqli_query($conn, $query);

            if (!$result) {
                die("Error inserting remaining data: " . mysqli_error($conn));
            }
        }

        echo '<br />Data Inserted in the database';
        fclose($file_open);
    } else {
        die('<br/>Sorry, File type Error. Only CSV files are allowed.');
    }
}

mysqli_close($conn);
?>
