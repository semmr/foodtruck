<?php
require_once 'functions.php';

// Define variables to store user input
$username = $email = $password = '';
$name = $location = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the form is for adding a user
    if (isset($_POST['addUser'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        insertUser($username, $email, $password);

        // Clear the input fields
        $username = $email = $password = '';
    }

    // Check if the form is for adding a food truck
    if (isset($_POST['addFoodTruck'])) {
        $name = $_POST['name'];
        $location = $_POST['location'];
        $user_id = $_POST['user_id'];

        insertFoodTruck($name, $location, $user_id);

        // Clear the input fields
        $name = $description = $location = '';
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Users and Trucks</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add User</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>"><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $password; ?>"><br>

        <input type="submit" name="addUser" value="Add User">
    </form>

    <h1>Add Food Truck</h1>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>"><br>

        <label for="userID">User ID:</label>
        <input type="number" id="userID" name="user_id"><br>

        <input type="submit" name="addFoodTruck" value="Add Food Truck">
    </form>
</body>
</html>