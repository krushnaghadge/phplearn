<!DOCTYPE html>
<html>
<head>
    <title>Import CSV File Into MySQL</title>
</head>
<body>
    <div id="wrapper">
        <?php
        if (!isset($_POST['table_name']) && !isset($_POST['submit'])) {
        ?>
        <form method="post">
            <label for="table_name">Enter the table name:</label>
            <input type="text" name="table_name" required>
            <input type="submit" name="create_table" value="Create Table">
        </form>
        <?php
        } elseif (isset($_POST['table_name']) && !isset($_POST['submit'])) {
        ?>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="file" name="file" />
            <input type="hidden" name="table_name" value="<?php echo htmlspecialchars($_POST['table_name']); ?>">
            <input type="submit" name="submit" value="Upload File">
        </form>
        <?php
        }

        $databaseHost = 'localhost';
        $databaseUser = 'root';
        $databasePassword = '';
        $databaseName = 'phplearning';

        $conn = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

        if (isset($_POST['create_table'])) {
            $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);

            $query = "CREATE TABLE IF NOT EXISTS $table_name (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        First_Name VARCHAR(100),
                        Last_Name VARCHAR(100),
                        Company VARCHAR(100),
                        Company_Name_for_Emails VARCHAR(100),
                        Email_ok VARCHAR(100),
                        Email_Status VARCHAR(100),
                        Email_Confidence FLOAT
                    )";

            $result = mysqli_query($conn, $query);

            if ($result) {
                echo "Table '$table_name' created successfully.";
            } else {
                echo "Error creating table: " . mysqli_error($conn);
            }
        }

        if (isset($_POST['submit'])) {
            $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);
            // Rest of the CSV upload and insertion code goes here
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
        
                    $query = "INSERT INTO csv1 (First_Name, Last_Name, Company, Company_Name_for_Emails, Email_ok, Email_Status, Email_Confidence) VALUES ('" . $csv[0] . "', '" . $csv[1] . "', '" . $csv[2] . "', '" . $csv[3] . "', '" . $csv[4] . "', '" . $csv[5] . "', '" . $csv[6] . "')";
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
    </div>
</body>
</html>
