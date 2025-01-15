<?php
    require 'database_connection.php';
    $posters = "SELECT *
                FROM movie_list m
                WHERE m.status = 1
                ORDER BY m.name";


$result = $conn->query($posters);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Movies Section</title>
</head>

<body class="movies">
    <header>
        <div class="logo">ChillFlix Cineplex</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="showtime.php">Showtimes</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="logout.php" id="logoutButton">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="movies-section">
        <h2>Featured Movies</h2>
        
        <?php 
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='movie-card'>";
                    echo "<img src='../backend/".$row['poster_path']."' class='movie-image'>";
                    $movie_id = $row['id'];
                    echo "<h3 class='movie-title'><a href='showtime.php?movie_id=$movie_id'>".$row['name']."</a></h3>";
                    echo "</div>";
                }
            ?>
    </div>
</body>
</html>
