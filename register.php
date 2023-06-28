<?php
require_once 'functions.php';

session_start();

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}

// Handle registration form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the email is already registered
    if (emailExists($email)) {
        $registrationError = "Email already registered";
    } else {
        // Register the user
        insertUser($username, $email, $password);
        $registrationSuccess = "Registration successful. You can now login.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <?php if (isset($registrationError)) { ?>
            <p><?php echo $registrationError; ?></p>
        <?php } elseif (isset($registrationSuccess)) { ?>
            <p><?php echo $registrationSuccess; ?></p>
        <?php } ?>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Register">
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>