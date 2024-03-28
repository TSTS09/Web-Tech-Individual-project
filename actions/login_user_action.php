<?php

session_start();

include_once '../settings/connection.php';

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

            header('Location: ../view/chore_control_view.php');
            exit();

        } else {
            echo "<script>
        alert('Incorrect username or password. Please try again.');
        window.location.href='../view/login_view.php?msg=Incorrect username or password. Please try again.'
        </script>";
            // header('Location: ../view/login_view.php');
        }
    } else {
        echo "<script>
        alert('User does not exist, Please try again or register on the next page.');
        window.location.href='../view/register_view.php?error=User not registered or incorrect username or password, Please try again.'
        </script>";
        // header('Location: ../view/login_view.php');
        // exit();
    }
} else {
    header('Location: ../view/login_view.php');
    exit();
}

// Close the connection
$conn->close();
?>
