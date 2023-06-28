<?php
function connectToDatabase()
{
    $host = 'localhost';
    $dbname = 'foodtruck';
    $username = 'root';
    $password = '';

    try {
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

function insertUser($username, $email, $password)
{
    $db = connectToDatabase();

    $sql = "INSERT INTO users (Username, Email, Password) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username, $email, $password]);
}

function insertFoodTruck($name, $location, $user_id)
{
    $db = connectToDatabase();

    $sql = "INSERT INTO foodtruck (Name, location, user_id) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->execute([$name, $location, $user_id]);
}
function verifyUserCredentials($email, $password)
{
    $db = connectToDatabase();

    $sql = "SELECT user_id FROM users WHERE Email = ? AND Password = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email, $password]);

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && isset($result['user_id'])) {
        return $result['user_id'];
    }

    return null;
}
function emailExists($email)
{
    $db = connectToDatabase();

    $sql = "SELECT COUNT(*) FROM users WHERE Email = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);

    $result = $stmt->fetchColumn();
    return ($result > 0);
}
function getFoodTrucksByUserID($user_id)
{
    $db = connectToDatabase();

    $sql = "SELECT * FROM FoodTruck WHERE user_id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$user_id]);

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function getAllFoodTrucks()
{
    $db = connectToDatabase();

    $sql = "SELECT * FROM FoodTruck";
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
function isSeller($user_id)
{
    $db = connectToDatabase();

    $sql = "SELECT is_seller FROM Users WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['is_seller'] == 1;
}

?>