<?php

session_start();

include '../settings/connection.php';

if ((isset($_SERVER['REQUEST_METHOD']) == "POST") && isset($_POST['signInButton'])) {

    $email = $_POST['emailInput'];
    $password = $_POST['passwordInput'];
   
    $sql = "SELECT * FROM People WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['passwd'])) {
            $_SESSION['userId'] = $row['pid'];
            $_SESSION['roleId'] = $row['rid'];

            header('Location: ../view2/chore_control_view.php');
            exit();

        } else {
            echo "Incorrect username or password. Please try again.";
            header('Location: ../login/login_view.php');
        }
    } else {
        echo "User not registered or incorrect username or password, Please try again.";
        header('Location: ../login/login_view.php');
        exit();
    }
} else {
    header('Location: ../login/login_view.php');
    exit();
}

// Close the connection
$conn->close();
?>
