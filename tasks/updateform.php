

<?php include '../includes/headerc.html'; ?>
<body>
    <h2>Edit Task</h2>
    <div class="container">
        <div class="edittask_container">
        <div class="form-container">
    <form action="update.php" method="post">
        <input type="number" name="task_id" placeholder = "task_id" required>
        <input type="text" name="title" placeholder="Title" required>
        <textarea name="description" placeholder="Description"></textarea>
        <input type="number" name="priority" placeholder="Priority" required>
        <input type="date" name="due_date" required><br>
        <label for="completed">Completion Status:</label>
        <input type="radio" name="completed" value="yes"> Completed
        <input type="radio" name="completed" value="no" checked> Incomplete
        <button type="submit" name="edit_task">Save Changes</button>
    </form>
</body>
</html>
