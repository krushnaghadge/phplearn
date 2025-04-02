<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "phplearning"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture filter criteria from user input
    $firstName = $_POST['firstName'] ?? '';
    $prospectCountry = $_POST['Prospect_Country'] ?? '';
    $companyCountry = $_POST['Company_Country'] ?? '';
    $industry = $_POST['industry'] ?? '';
    $jobTitle = $_POST['job_Title'] ?? '';

    // Construct the base SQL query
    $sql = "SELECT * FROM master_data WHERE 1=1 ";
    
    // Add filter conditions based on user input
    if (!empty($firstName)) {
        $sql .= " AND First_Name LIKE '%$firstName%'";
    }
   
    
    
    if (!empty($email)) {
        $sql .= " AND Email_Status LIKE '%$email%'";
    }
    

    
    if (!empty($Departments)) {
        $sql .= " AND Departments LIKE '%$Departments%'";
    }
    if (!empty($Seniority)) {
        $sql .= " AND Seniority LIKE '%$Seniority%'";
    }


    if (!empty($prospectCountry)) {
        $sql .= " AND Prospect_Country LIKE '%$prospectCountry%'";
    }

    if (!empty($companyCountry)) {
        $sql .= " AND Company_Country LIKE '%$companyCountry%'";
    }

    if (!empty($industry)) {
        $sql .= " AND Industry LIKE '%$industry%'";
    }

    if (!empty($jobTitle)) {
        $sql .= " AND Title LIKE '%$jobTitle%'";
    }

    // Execute the SQL query
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error executing query: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        // Display the results in a table
        echo '<table>';
        echo '<tr><th>ID</th><th>First Name</th><th>Title</th><th>...</th></tr>';

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["First_Name"]."</td>";
            echo "<td>".$row["Title"]."</td>";
            // Add more table columns as needed...
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo 'No results found.';
    }

    $conn->close();
}
?>