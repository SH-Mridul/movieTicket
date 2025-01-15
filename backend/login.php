<?php 
    session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="container">
        <div id="form-container">
            <form id="loginForm" class="form" action="admin_login_action.php" method="post">
                <h2>Login</h2>

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
                
                <input type="text" id="loginUsername" placeholder="Username" name="username" required>
                <input type="password" id="loginPassword" placeholder="Password" name="password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>
