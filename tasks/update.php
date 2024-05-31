<?php
session_start();

include '../classes/databases.php';
include '../classes/Task.php';

$database = new Database();
$db = $database->connect();
$task = new Task($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $taskId = $_POST["task_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $priority = $_POST["priority"];
        $dueDate = $_POST["due_date"];
        $completed = $_POST["completed"];

        
        if (!ctype_alpha($title)) {
            throw new Exception("Error: Title must contain only letters.");
        }
        
        
        if (!ctype_digit($taskId)) {
            throw new Exception("Error: Task ID must contain only digits.");
        }
        
        
        if (!ctype_digit($priority)) {
            throw new Exception("Error: Priority must contain only digits.");
        }

        

        if ($task->updateTask($taskId, $title, $description, $priority, $dueDate, $completed)) {
            echo "Task updated successfully.";
        } else {
            echo "Task update failed.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    try {
        $taskId = $_GET["id"];
        // Assuming you have a username available here, replace $username with the actual username
        $taskDetails = $task->displayTasks($username);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
