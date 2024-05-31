<?php
include 'classes/databases.php';
include 'classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Check if username is a string
    if (!ctype_alpha($username)) {
        echo "Username must contain only letters.";
    } else {
        // If username is a string, proceed with registration
        if ($user->register($username, $email, $password)) {
            echo "Registration successful.";
        } else {
            echo "Registration failed.";
        }
    }
}
?>
