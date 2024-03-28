<?php

mysqli_report(MYSQLI_REPORT_ALL);
error_reporting(E_ALL);
include_once '../settings/connection.php';
include_once '../settings/core.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $choreID = $_POST["chore-name"];
    // $personID = $_POST["assigned-to"];
    $dateAssigned = date('Y-m-d H:i:s');
    $dueDate = $_POST["due-date"];
    $choreStatus = "1";
    $currentDateTime = date('Y-m-d H:i:s'); // Current date and time
    $assignby = $_SESSION['userId'];

    // SQL query to insert assignment into database
    $sql = "INSERT INTO Assignment (cid, sid, date_assign, date_due, last_updated, who_assigned) VALUES ('$choreID','$choreStatus', '$dateAssigned', '$dueDate', '$currentDateTime', '$assignby')";

    $result = mysqli_query($conn, $sql);
   

    if ($result) {
        echo "Success";
        header('Location:../admin/assign_chore_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    header('Location:../admin/assign_chore_view.php');
    exit();
}

//$conn->close();