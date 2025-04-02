<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Learning";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$importMessage = "";

// Check if a file was uploaded
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $csvFile = $_FILES['csvFile']['tmp_name'];

    // Read the CSV file
    $csvData = file($csvFile);

    // Get the column names from the first row
    $columns = str_getcsv(array_shift($csvData));

    // Get the table name from the user input
    $tableName = $conn->real_escape_string($_POST['tableName']);

    // Sanitize and create the table if it doesn't exist
    $createTableQuery = "CREATE TABLE IF NOT EXISTS $tableName (";
    foreach ($columns as $column) {
        // Remove special characters and spaces from column names
        $cleanedColumn = preg_replace("/[^A-Za-z0-9_]/", '', $column);
        $createTableQuery .= "`$cleanedColumn` VARCHAR(255), ";
    }
    $createTableQuery = rtrim($createTableQuery, ", ") . ")";
    if ($conn->query($createTableQuery) !== TRUE) {
        $importMessage = "Error creating table: " . $conn->error;
    } else {
        // Process CSV data and insert into the specified table
        foreach ($csvData as $line) {
            $data = str_getcsv($line);
            $escapedData = array_map([$conn, 'real_escape_string'], $data);

            $insertColumns = [];
            $insertValues = [];

            foreach ($columns as $column) {
                $cleanedColumn = preg_replace("/[^A-Za-z0-9_]/", '', $column);
                if (in_array($cleanedColumn, $columns)) {
                    $insertColumns[] = "`$cleanedColumn`";
                    $insertedValue = $escapedData[array_search($column, $columns)];
                    $truncatedValue = substr($insertedValue, 0, 255); // Truncate to fit within column length
                    $insertValues[] = "'" . $truncatedValue . "'";
                }
            }

            $insertColumns = implode(', ', $insertColumns);
            $insertValues = implode(', ', $insertValues);

            $sql = "INSERT INTO $tableName ($insertColumns) VALUES ($insertValues)";
            if ($conn->query($sql) !== TRUE) {
                $importMessage = "Error inserting data: " . $conn->error;
                break;
            }
        }

        if (empty($importMessage)) {
            $importMessage = "CSV data imported successfully into table '$tableName'.";
        }
    }
} else {
    $importMessage = "Error uploading CSV file.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>CSV to MySQL Import</title>
</head>
<body>
    <h2>CSV to MySQL Import</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="tableName">Enter Table Name:</label>
        <input type="text" name="tableName" required><br><br>
        <input type="file" name="csvFile" accept=".csv" required><br><br>
        <input type="submit" name="submit" value="Import CSV">
    </form>
    <p><?php echo $importMessage; ?></p>
</body>
</html>
