<?php
include '../settings/connection.php';

function getAllChores() {
    global $conn;
    $chores = [];
    
    $sql = "SELECT * FROM Chores";
    
    $result = $conn->query($sql);
    
    if ($result) {
        if ($result->num_rows > 0) {
            $chores = array(); 
            while ($row = $result->fetch_assoc()) {
                $chores[] = $row;
            }
            return $chores;
        }
    }
 
}
$conn->close();

