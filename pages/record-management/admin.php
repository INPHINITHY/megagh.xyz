<?php
// Define the password
define('PASSWORD', 'Ironman'); // Change 'yourpassword' to your desired password

session_start(); // Start a session to store password status

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // If logged in, show protected content
    echo "<h1>Protected Content</h1>";
    echo "<p>Welcome to the protected page!</p>";
    echo "<a href='logout.php'>Logout</a>"; // Link to logout
    exit; // Exit script
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the password from the form
    $password = $_POST['password'] ?? '';

    // Check if the password is correct
    if ($password === PASSWORD) {
        $_SESSION['logged_in'] = true; // Set the session variable
        header('Location:/pages/record-management/protected.php'); // Redirect to the same page
        exit; // Exit script
    } else {
        $error = "Incorrect password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css-library/style.css">
    <title>Password Protected Page</title>
</head>
<body  class="body-light">
    <div class="card-img">
    <h1>Please Enter the Password</h1>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="">
    <input type="password" name="password" required>
    <button type="submit">Submit</button>
</form>
    </div>
    
</body>
</html>
