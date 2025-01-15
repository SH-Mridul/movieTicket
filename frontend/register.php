<?php 
    session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login">
    <div class="login.container">
        <div id="loginFormContainer" class="form-container show">
            <h2>Registration</h2>
            <form id="loginForm" action="register_action.php" method="post">
                <span style="color: red; text-align: center; display: block;">
                    <?php 
                        if(isset($_SESSION['error'])){ 
                            echo $_SESSION['error'];
                            unset($_SESSION['error']); 
                        }
                    ?>
                </span>

                <span style="color: green; text-align: center; display: block;">
                    <?php 
                        if(isset($_SESSION['success'])){ 
                            echo $_SESSION['success'];
                            unset($_SESSION['success']); 
                        }
                    ?>
                </span>

                <div class="form-group">
                    <label for="loginUsername">Username:</label>
                    <input type="text" name="username" id="loginUsername" required>
                </div>

                <div class="form-group">
                    <label for="loginUsername">email:</label>
                    <input type="email" name="email" id="loginUsername"  required>
                </div>

                <div class="form-group">
                    <label for="loginUsername">Contact Number:</label>
                    <input type="text" name="contact_number" id="loginUsername"  required>
                </div>

                <div class="form-group">
                    <label for="loginPassword">Password:</label>
                    <input type="password" name="password" id="loginPassword" required>
                </div>

                <div class="form-group">
                    <label for="loginPassword">Confirm Password:</label>
                    <input type="password" id="loginPassword" name="confirm_password" required>
                </div>
                <button type="submit">Register</button>
            </form>
            <p id="loginMessage"></p>
            <p style="text-align:center">have an account? <a href="login.php" id="showRegister">Login</a></p>
        </div>
</body>
</html>
