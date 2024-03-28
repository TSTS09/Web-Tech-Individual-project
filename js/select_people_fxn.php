<?php
// Include the connection file
include_once '../settings/connection.php';

// Initialize an empty string to store the options HTML
$personOptions = '';

$sql = "SELECT pid, CONCAT(fname, ' ', lname) AS full_name FROM People WHERE rid = 3";

// Execute the query using the connection
$result = $conn->query($sql);

// Check if execution worked
if ($result) {
    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        // Build the personOptions HTML using the fetched roles
        $personOptions .= "<option value=\"" . $row['pid'] . "\">" . $row['full_name'] . "</option>";
    }
} else {
    // If query execution failed, handle the error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
