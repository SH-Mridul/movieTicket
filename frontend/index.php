<?php
    require 'database_connection.php';
    require 'login_check.php';
    $posters = "SELECT m.poster_path
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
    <title>Cineplex Web</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body class="home">
    <header>
        
        <div class="logo">ChillFlix  Cineplex</div>
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

    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to ChillFlix Movie Ticket Booking</h1>
            <a href="movies.php" class="cta-button">Browse Movies</a>
        </div>
    </section>

    <div class="container">
        <div class="wrapper">
            <?php 
                while ($row = $result->fetch_assoc()) {
                    echo "<img src='../backend/".$row['poster_path']."'>";
                }
            ?>
        </div>
    </div>
    <section class="features">
        
        <div class="feature-cards">
            <div class="feature-card">
                <h3>Easy Booking</h3>
                <p>Simple and user-friendly interface to book your tickets in just a few clicks.</p>
            </div>
            <div class="feature-card">
                <h3>Wide Selection</h3>
                <p>Choose from a variety of movies, genres, and showtimes that suit your schedule.</p>
            </div>
            <div class="feature-card">
                <h3>Secure Payment</h3>
                <p>Safe and secure payment options to ensure your transactions are protected.</p>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <h2>What Our Customers Say</h2>
        <div class="testimonial-container">
            <div class="testimonial-item">
                <blockquote>"Great experience! Booking was a breeze!"</blockquote>
                <cite>- Happy Customer</cite>
                <div class="rating">⭐️⭐️⭐️⭐️⭐️</div>
            </div>
            <div class="testimonial-item">
                <blockquote>"The selection of movies is fantastic, and the seats are comfy!"</blockquote>
                <cite>- Movie Lover</cite>
                <div class="rating">⭐️⭐️⭐️⭐️</div>
            </div>
            <div class="testimonial-item">
                <blockquote>"I loved the easy payment process. Will book again!"</blockquote>
                <cite>- Frequent Moviegoer</cite>
                <div class="rating">⭐️⭐️⭐️⭐️⭐️</div>
            </div>
            <div class="testimonial-item">
                <blockquote>"An amazing experience overall. Highly recommend!"</blockquote>
                <cite>- Satisfied Customer</cite>
                <div class="rating">⭐️⭐️⭐️⭐️⭐️</div>
            </div>
        </div>
    </section>
    
    <section class="contact-info">
        <div class="info-item">
            <h4>Location</h4>
            <p>1462, Sanmer Ocean City, 8th Floor</p>
            <p>Chittagong, Bangladesh</p>
        </div>
        <div class="info-item">
            <h4>Contact Us</h4>
            <p>Phone Number:</p>
            <p>+880 1839855010</p>
            <p>Email:</p>
            <p>contact@chillflix.com</p>
        </div>
    </section>
    
    <footer>
        <p>Copyright© 2024 ChillFlix Motion Limited. All Rights Reserved.</p>
    </footer>
</body>
</html>
