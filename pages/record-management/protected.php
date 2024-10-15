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
    <link rel="stylesheet" href="/css-library/style.css">
</head>
<body class="body-light">
    <div class="card-img">
    <h1>Welcome to the Admin Panel</h1>
    <p>This is where you can edit the content for authorized users.</p>
    <ul>
        <button><li><a href="/pages/record-management/update_scores.php">Enter scores</a></li></button>
        <button><li><a href="logout.php">Logout</a></li></button>

    </ul>
    <!-- Additional content or features -->
    <p>Here you can add and edit table data you want for your users.</p>
    </div>
</body>
</html>
