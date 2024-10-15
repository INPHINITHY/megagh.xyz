<?php
session_start(); // Start session
session_unset(); // Unset session variables
session_destroy(); // Destroy the session
header('Location: ./../../index.php'); // Redirect to the login page or wherever
exit;
?>
