<?php

session_start();

function checkLogin() {
    // Check if user id session exists
    if (!isset($_SESSION['userId'])) {
        header('Location: ../login/login_view.php');    
        die();
    }
}
  // Check if role id session exists
  if (!isset($_SESSION['roleId'])) {
    header('Location: ../login/login_view.php');    
    die();
  }
?>
