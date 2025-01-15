<?php
    require 'login_check.php';
    require 'database_connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="#" class="nav-link" data-target="customers">Customers</a></li>
            <li><a href="#" class="nav-link" data-target="bookings">Bookings</a></li>
            <li><a href="#" class="nav-link" data-target="movies">Movies</a></li>
            <li><a href="#" class="nav-link" data-target="seats">Seats</a></li>
            <li><a href="#" id="logoutButton">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Dashboard</h1>
            <div class="user-info">
               <span>Admin</span>
               <button id="logoutButton" onclick="window.location.href='logout.php';">Logout</button>
            </div>
        </header>

        <div id="content" class="content">
            <h2>Welcome Admin! Please select a category.</h2>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
