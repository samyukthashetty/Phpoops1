<?php include 'includes/header.html'; ?>

<div class="container">
    <div class="card">
        <h2>Login</h2>
        <form action="login_process.php" method="POST">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit">Login</button>
            </div>
            <a href="password.php">Forget pasword</a>
        </form>
    </div>
</div>