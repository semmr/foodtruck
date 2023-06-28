<?php
require_once 'functions.php';

session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verify user credentials
    $user_id = verifyUserCredentials($email, $password);

    if ($user_id !== null) {
        // Login successful, store the user ID in the session
        $_SESSION['user_id'] = $user_id;
        header('Location: dashboard.php');
        exit();
    } else {
        $loginError = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if (isset($loginError)) { ?>
            <p><?php echo $loginError; ?></p>
        <?php } ?>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Login">
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>