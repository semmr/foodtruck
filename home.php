<?php
require_once 'functions.php';

// Retrieve all existing food trucks
$foodTrucks = getAllFoodTrucks();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Active Food Trucks</h1>
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
</body>
</html>