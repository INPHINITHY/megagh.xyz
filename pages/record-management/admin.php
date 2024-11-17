<?php
session_start();

// Function to read accounts from JSON file
function readAccounts() {
    if (file_exists('accounts.json')) {
        $json = file_get_contents('accounts.json');
        return json_decode($json, true);
    }
    return []; // Return an empty array if the file doesn't exist
}

// Function to write accounts to JSON file
function writeAccounts($accounts) {
    file_put_contents('accounts.json', json_encode($accounts, JSON_PRETTY_PRINT));
}

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset(); // Unset session variables
    session_destroy(); // Destroy the session
    header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to the same page
    exit;
}

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // If logged in, show protected content
    ?>
   <!DOCTYPE html>
<html lang="en">
<head>
<?php include('./../../includes/links.php'); ?>
</head>
<body class="body-light">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #eceffc;
        }
        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1; /* Take up available space between nav and footer */
        }
        .card-section{
            background-color:  rgba(0, 0, 0, 0.8);
            color:white
        }
    </style>
    <header>
        <?php include('./../../includes/nav.php'); ?>
    </header>
    <main class="main-content">
        <div class="card-section center">
            <h1>Welcome to the Admin Panel</h1>
            <p>This is where you can edit the content for authorized users.</p>
            <p>Here you can add and edit table data for your users.</p>
            <div class="grid-two-columns" style = "place-items:center">
                <div>
                    <p>Logged in as: <br><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                </div>
                <div>
                    <p>Login time: <br><?php echo htmlspecialchars($_SESSION['login_time']); ?></p>
                </div>
            </div>
            <div class="grid-three-columns" style = "place-items:center">
                <div>
                    <a class="btn btn-primary" href="/pages/record-management/clubScoreLogic.php" role="button">Club Scores</a>
                </div>
                <div>
                    <a class="btn btn-primary" href="/pages/record-management/playerScoresForm.php" role="button">Player Scores</a>
                </div>
                <div>
                    <a class="btn btn-primary" href="?action=logout"role="button">Logout</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer center">
        <?php include('./../../includes/footer.php'); ?>
    </footer>
</body>
</html>
    <?php
    exit; // Exit script
}

// Registration logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $accounts = readAccounts();

    // Check if username already exists
    if (array_key_exists($username, $accounts)) {
        $error = "Username already exists.";
    } else {
        // Add new account
        $accounts[$username] = [
            'password' => $password,
            'login_history' => [] // Initialize login history
        ];
        writeAccounts($accounts);
        $success = "Account created successfully. You can now log in.";
    }
}

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $accounts = readAccounts();

    // Check if username exists and verify password
    if (array_key_exists($username, $accounts) && password_verify($password, $accounts[$username]['password'])) {
        // Record login time
        $login_time = date("Y-m-d H:i:s");
        $accounts[$username]['login_history'][] = $login_time;
        writeAccounts($accounts);

        // Store session data
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username; // Store username in session
        $_SESSION['login_time'] = $login_time; // Store login time
        header('Location: ' . $_SERVER['PHP_SELF']); // Redirect to the same page
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('./../../includes/links.php'); ?>
    <title>WELCOME</title> 
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #eceffc;
        }
        
        
    </style>
</head>
<body>
    <header>
        <?php include('./../../includes/nav.php'); ?>
    </header>
    <div class="main-content">
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p style='color:green;'>$success</p>"; ?>
        <form class="login-form" action="" method="POST">
            <h1>Login</h1>
            <div class="form-input-material">
                <label for="username">Username</label><br>
                <input type="text" name="username" id="username" placeholder=" " autocomplete="off" class="form-control-material" required />
            </div>
            <div class="form-input-material">
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" placeholder="Admin Password" autocomplete="on" class="form-control-material" required />
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-ghost">Login</button>
            <!-- <button type="submit" name="register" class="btn btn-primary btn-ghost">Register</button> -->
        </form>
    </div>
    <footer class="footer center">
        <?php include('./../../includes/footer.php'); ?>
    </footer>
</body>
</html>