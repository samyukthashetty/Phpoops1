<?php
session_start();
include '../classes/databases.php';
include '../classes/Task.php';

$database = new Database();
$db = $database->connect();
$task = new Task($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $task_id = $_POST["task_id"];

        if ($task->deleteTask($task_id)) {
            echo "Task deleted successfully.";
        } else {
            echo "Task deletion failed.";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
