<?php
// Include the connection file
require_once '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $choreID = $_POST["chore-id"];
    $choreName = $_POST["chore-name"];
    
    // SQL query to update chore in database
    $sql = "UPDATE Chores SET chorename=? WHERE cid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $choreName, $choreID);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the chore display page after successful update
        header('Location: ../view/chore_control_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If the request method is not POST, redirect to the chore display page
    header('Location: ../view/chore_control_view.php');
    exit();
}

// Close the connection
$conn->close();