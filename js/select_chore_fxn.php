<?php
// Include the connection file
include_once '../settings/connection.php';

// Initialize an empty string to store the options HTML
$choreOptions = '';

$sql = "SELECT cid, chorename FROM Chores WHERE cid NOT IN (SELECT cid FROM Assignment)";

// Execute the query using the connection
$result = $conn->query($sql);

// Check if execution worked
if ($result) {
    // Fetch the results
    while ($row = $result->fetch_assoc()) {
        // Build the choreOptions HTML using the fetched roles
        $choreOptions .= "<option value=\"" . $row['cid'] . "\">" . $row['chorename'] . "</option>";
    }
} else {
    // If query execution failed, handle the error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
