<?php
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $email, $password) {
        // Validate username
        if (!ctype_alpha($username)) {
            throw new Exception("Username must contain only letters.");
        }

        // Validate email
        if (!isValidEmail($email)) {
            throw new Exception("Email is not in a valid format.");
        }

        if (strlen($password) < 3) {
            throw new Exception('Password must be at least 3 characters long.');
        }

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert user into database
        $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function login($username, $password) {
        // Validate username and password
        if (!ctype_alpha($username)) {
            throw new Exception("Username must contain only letters.");
        }

        if (strlen($password) < 3) {
            throw new Exception('Password must be at least 3 characters long.');
        }

        // Retrieve user from database
        $query = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify password
            if (password_verify($password, $user['password'])) {
                return true;
            } else {
                throw new Exception('Password is incorrect.');
            }
        } else {
            throw new Exception('Username not found.');
        }
    } 
}
?>
