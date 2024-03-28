<?php
include_once "../settings/connection.php";
function get_all_assignment()
{
    global $conn;
    $chores = array();
    $sql = "SELECT * FROM Assignment";
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