<?php

class Task {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createTask($user_id, $title, $description, $priority, $due_date , $completed) {
        $query = "INSERT INTO tasks (title, description, priority, due_date, completed, user_id) VALUES (:title, :description, :priority, :due_date, :completed, :user_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':completed', $completed);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    

    public function updateTask($task_id, $title, $description, $priority, $dueDate, $completed) {
        $query = "UPDATE tasks SET title = :title, description = :description, priority = :priority, due_date = :due_date, completed = :completed WHERE task_id = :task_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':task_id', $task_id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':priority', $priority);
        $stmt->bindParam(':due_date', $dueDate);
        $stmt->bindParam(':completed', $completed);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function displayTasks() {
        // Retrieve tasks for the logged-in user
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM tasks WHERE user_id IN (SELECT user_id FROM users WHERE username=:username)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(array(':username' => $username));
        return $stmt;
    }

    public function deleteTask($task_id) {
        $query = "DELETE FROM tasks WHERE task_id = :task_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':task_id', $task_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>




