<?php
session_start();
include 'classes/databases.php';
include 'classes/User.php';

$database = new Database();
$db = $database->connect();
$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        if ($user->login($username, $password)) {
            $_SESSION['username'] = $username;
            
            header("location: display.php");
            exit;
        } else {
            
            header("location: login.php?error=invalid_credentials");
            exit;
        }
    } catch (Exception $e) {
        
        header("location: login.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}