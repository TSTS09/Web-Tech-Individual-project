<?php
// Include the connection file
include_once '../settings/connection.php';

// Initialize an array to store the options
$options = array();

// Fetch chore options
$sql = "SELECT cid, chorename FROM Chores WHERE cid NOT IN (SELECT cid FROM Assignment)";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $options['choreOptions'][$row['cid']] = $row['chorename'];
    }
}

// Fetch person options
$sql = "SELECT pid, CONCAT(fname, ' ', lname) AS full_name FROM People WHERE rid = 3";
$result = $conn->query($sql);
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $options['personOptions'][$row['pid']] = $row['full_name'];
    }
}

// Fetch status options
// $sql = "SELECT * FROM `Status`";
// $result = $conn->query($sql);
// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         $options['statusOptions'][$row['sid']] = $row['sname'];
//     }
// }

// Close the connection
$conn->close();

// Output the options as JSON
echo json_encode($options);