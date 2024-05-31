<?php include 'includes/header.html'; ?>
<div class="container">
    <div class="card">
        <h2>Sign Up</h2>
        <form action="sign_process.php" method="POST" onsubmit="return validateForm()">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="input-group">
                <button type="submit">SIGNUP</button>
            </div>
        </form>

        <!-- Display error messages -->
        <div id="error_message" class="error" style="display: none;"></div>
    </div>
</div>

<script>
    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // Regular expression to check for at least one special character in the password
        var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;

        // Check if username contains only letters
        if (!/^[a-zA-Z]+$/.test(username)) {
            document.getElementById("error_message").innerHTML = "Username must contain only letters.";
            document.getElementById("error_message").style.display = "block";
            return false;
        }

        // Check if password meets criteria (minimum length and contains at least one special character)
        if (password.length < 3 || !specialCharRegex.test(password)) {
            document.getElementById("error_message").innerHTML = "Password must be at least 3 characters long and contain at least one special character.";
            document.getElementById("error_message").style.display = "block";
            return false;
        }
        
        // If both username and password are valid, return true to submit the form
        return true;
    }
</script>
