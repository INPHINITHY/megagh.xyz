<?php
// db.php
$host = 'localhost'; // Database host
$username = 'your_username'; // Your database username
$password = 'your_password'; // Your database password
$database = 'your_database'; // Your database name
$port = 3000;

// Create a new mysqli connection
$db = new mysqli($host, $username, $password, $database);

// Check for connection errors
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>
