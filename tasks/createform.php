<?php include '../includes/headerc.html'; ?>

    <h2>Add Task</h2>
    <div class="container">
        <div class="addtask_container">
        <div class="form-container">
    <form action="create.php" method="post">
        <label for="title">Title:</label><br>
        <input type="text" name="title" placeholder="Title" required><br>
        <label for="description">description:</label><br>
        <textarea name="description" placeholder="Description"></textarea><br>
        <label for="priority">Priority:</label><br>
        <input type="number" name="priority" placeholder="Priority" required><br>
        <label for="date">Due date:</label><br>
        <input type="date" name="due_date" required><br>
        <label for="user_id">UserID:</label><br>
        <input type="text" name="user_id" required><br>

        <label for="completed">Completion Status:</label>
        <input type="radio" name="completed" value="yes"> Completed
        <input type="radio" name="completed" value="no" checked> Incomplete<br>
        <button type="submit" name="add_task">Add Task</button>
    </form>

