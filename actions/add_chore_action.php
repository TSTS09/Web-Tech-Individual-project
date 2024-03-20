
<?php
// Include the connection file
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $choreName = $_POST["chore-name"];
    $sql = "INSERT INTO Chores (chorename) VALUES ('$choreName')";

    $result = $conn->query($sql);
    if ($result) {
        header('Location: ../chore_control_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo 'error';
    header('Location: ../chore_control_view.php');
    exit();
}
$conn->close();
?>