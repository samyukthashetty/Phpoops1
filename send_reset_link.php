<?php
// Include PHPMailer files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
include 'classes/databases.php';
$database = new Database();
$db = $database->connect();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the users table
    $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Generate a token
        $token = bin2hex(random_bytes(50));

        // Store the token in the password_resets table
        $stmt = $db->prepare("INSERT INTO password_resets (email, token) VALUES (:email, :token)");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Get the current domain name dynamically
        $domain = $_SERVER['HTTP_HOST'];

        // Generate the reset link
        $resetLink = "http://$domain/phpoops/resetpasswordform.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";

        // Send email
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.office365.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'samyuktha.p@nichi.com';
            $mail->Password   = 'samyu@123';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('samyuktha.p@nichi.com', 'samyuktha');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            $mail->send();
            echo "Password reset link has been sent to your email.";
        } catch (Exception $e) {
            echo "Failed to send email. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "No account found with that email.";
    }
}
?>
