

<?php
include 'classes/databases.php';
include 'classes/Task.php';
include 'classes/Session.php';

Session::start(); // Start session

// Check if user is logged in
if (!Session::isLoggedIn()) {
    echo "<h2>You are not authorized. Please login <a href='login.php'>here</a></h2>";
    echo "<a href='logout.php'>Logout</a>";
    exit();
}

$database = new Database();
$db = $database->connect();

// Create an instance of the Task class
$task = new Task($db);

// Retrieve tasks for the logged-in user
$result = $task->displayTasks();

if ($result->rowCount() > 0) {
    echo "<h2>Tasks for ".$_SESSION['username']."</h2>";
    echo "<table border='1'>";
    echo "<tr>
    <th>Title</th>
    <th>Description</th>
    <th>Priority</th>
    <th>Due Date</th>
    <th>Completed</th>
    </tr>";
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr><td>".$row['title']."</td><td>".$row['description']."</td>
        <td>".$row['priority']."</td>
        <td>".$row['due_date']."</td>
        <td>".$row['completed']."</td>
        </tr>";
    }
    echo "</table>";
} else {
    echo "No tasks found for ".$_SESSION['username'];
}

?>

<a href="logout.php">Logout</a>
