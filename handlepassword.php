<?php
// Include necessary files
require 'classes/databases.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the new password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Connect to the database
    $database = new Database();
    $db = $database->connect();

    // Check if the token is valid
    $stmt = $db->prepare("SELECT email FROM password_resets WHERE token = :token");
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    if ($stmt->rowCount() === 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $row['email'];

        // Update the user's password
        $update_stmt = $db->prepare("UPDATE users SET password = :password WHERE email = :email");
        $update_stmt->bindParam(':password', $hashed_password);
        $update_stmt->bindParam(':email', $email);
        $update_stmt->execute();

        // Delete the token so it can't be used again
        $delete_stmt = $db->prepare("DELETE FROM password_resets WHERE token = :token");
        $delete_stmt->bindParam(':token', $token);
        $delete_stmt->execute();

        // Display success message and back button
        echo "Password reset successfully.<br>";
        echo "<a href='login.php'>Back to login</a>";
    } else {
        die("Invalid token.");
    }
}
?>
