<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'functions.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

if (!isSeller($user_id)) {
    header('Location: home.php');
    exit();
}

// Retrieve the food trucks associated with the user
$foodTrucks = getFoodTrucksByUserID($user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to your Dashboard</h1>

    <h2>Your Food Trucks</h2>
    <table>
        <tr>
            <th>Truck ID</th>
            <th>Name</th>
            <th>Location</th>
        </tr>
        <?php foreach ($foodTrucks as $foodTruck) { ?>
            <tr>
                <td><?php echo $foodTruck['truck_id']; ?></td>
                <td><?php echo $foodTruck['name']; ?></td>
                <td><?php echo $foodTruck['location']; ?></td>
            </tr>
        <?php } ?>
    </table>

<?php
    // Initialize variables
$name = $description = $location = '';
$error = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize form inputs
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
    $location = filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING);

    // Add food truck
    $foodTruck = insertFoodTruck($name, $location, $user_id);

    if ($foodTruck) {
        // Food truck added successfully
        header('Location: dashboard.php');
        exit();
    } 
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Food Truck</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Add Food Truck</h1>
    <?php if (!empty($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>"><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $location; ?>"><br>

        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>"><br>

        <input type="submit" name="addFoodTruck" value="Add Food Truck">
    </form>
</body>
</html>