
<?php
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $choreName = $_POST["chore-name"];
    
    // SQL query to insert chore into database
    $sql = "INSERT INTO Chores (chorename) VALUES ('$choreName')";
    
    $result = $conn->query($sql);
    if ($result) {
        header('Location: ../view2/chore_control_view.php');
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