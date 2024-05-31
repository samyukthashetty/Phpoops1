
<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    die("Invalid request.");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <form method="POST" action="handlepassword.php">
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <label for="password">New Password:</label>
        <input type="password" name="password" id="password" required>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <button type="submit">Reset Password</button>
    </form>
</body>
</html>
