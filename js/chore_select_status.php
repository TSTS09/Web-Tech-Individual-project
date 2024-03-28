<?php
// Include the connection file
include_once '../settings/connection.php';

// Initialize an empty string to store the options HTML
$statusOptions = '';

$sql = "SELECT * FROM `Status`";

// Execute the query using the connection
$result = $conn->query($sql);

// Check if execution worked
if ($result) {
    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        // Build the statusOptions HTML using the fetched roles
        $statusOptions .= "<option value=\"" . $row['sid'] . "\">" . $row['sname'] . "</option>";
    }
} else {
    // If query execution failed, handle the error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
