
<?php include '../includes/headerc.html'; ?>
<body>
    <h2>Delete Task</h2>
    <div class="container">
        <div class="delete_container">
        <div class="form-container">
    <form action="delete.php" method="post">
        <input type="text" name="task_id" placeholder="id" required>
        <p>Are you sure you want to delete this task?</p>
        <button type="submit" name="delete_task">Delete Task</button>
    </form>
</body>
</html>
