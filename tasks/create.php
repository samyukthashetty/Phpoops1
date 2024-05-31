<?php
session_start();

include '../classes/databases.php';
include '../classes/Task.php';

$database = new Database();
$db = $database->connect();
$task = new Task($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $user_id= $_POST['user_id']; 
        $title = $_POST["title"];
        $description = $_POST["description"];
        $priority = $_POST["priority"];
        $due_date = $_POST["due_date"];
        $completed = $_POST["completed"];
        
        if (!ctype_alpha($title)) {
            throw new Exception("Error: Title must contain only letters.");
        } elseif (!ctype_digit($user_id)) {
            throw new Exception("Error: User ID must contain only digits.");
        } else {
            if ($task->createTask($user_id, $title, $description, $priority, $due_date, $completed)) {
                echo "Task created successfully.";
            } else {
                echo "Task creation failed.";
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
