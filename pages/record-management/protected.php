<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: /admin.php'); // Redirect to the login page
    exit;
}

// Protected content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Protected Content</title>
</head>
<body>
    <h1>Welcome to the Protected Page!</h1>
    <p>This is where you can edit the content for authorized users.</p>
    <ul>
        <li><a href="/pages/record-management/process_match.php">Match?</a></li>
        <li><a href="/pages/record-management/update_scores.php">Enter scores</a></li>
        <li></li>
    </ul>
    <!-- Additional content or features -->
    <p>Here you can add anything you want for your users.</p>
    <a href="logout.php">Logout</a> <!-- Link to log out -->
</body>
</html>
