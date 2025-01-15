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
            <h2>Login</h2>
            <form id="loginForm" action="user_login_action.php" method="post">
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
                    <label for="loginUsername">email:</label>
                    <input type="email" name="email" id="loginUsername"  required>
                </div>

               

                <div class="form-group">
                    <label for="loginPassword">Password:</label>
                    <input type="password" name="password" id="loginPassword" required>
                </div>

                <button type="submit">Login</button>
            </form>
            <p id="loginMessage"></p>
            <p style="text-align:center">Don't have an account? <a href="register.php" id="showRegister">Registration</a></p>
        </div>
</body>
</html>
