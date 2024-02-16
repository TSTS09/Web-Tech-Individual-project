
<?php
// Include the connection file
include '../settings/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $gender = intval($_POST['gender']);
    $familyRole = $_POST['familyRole'];
    $dob = $_POST['dob'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rid = 3;

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email is already in use
    $sql = "SELECT email FROM People WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        header('Location: ../login/login_view.php?error=Email already exists. Please use another one.');
        exit();
    }

    $sql = "INSERT INTO People (rid, fid, fname, lname, gender, dob, tel, email, passwd) VALUES ('$rid','$familyRole','$firstName', '$lastName', '$gender', '$dob', '$phoneNumber', '$email', '$hashedPassword')";

    $result = $conn->query($sql);


    if ($result) {
        echo "Sucessful Registration";
        header('Location: ../login/login_view.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    // If form is not submitted, redirect to register view page or take appropriate action
    echo 'error';
    header('Location: ../login/register_view.php');
    exit();
}

// Close the connection
$conn->close();
?>
