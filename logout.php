<?php
session_start();
// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page or any other desired page
header("Location: homeNotLogin.php"); // Change "login.php" to the appropriate login page
exit();
?>
