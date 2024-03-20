<?php
include '../settings/connection.php';

function getAllChores()
{
    global $conn;
    $chores = array();
    $sql = "SELECT * FROM Chores";
    $result = $conn->query("$sql");
    
    if (!$result) {
        echo "Error: " . $conn->error;
    } else {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $chores[] = $row;
            }
            return $chores;
        }
    }
    $conn->close();
}