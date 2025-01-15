<?php
    require 'database_connection.php';
    $movies = null;
    if (isset($_GET['movie_id'])) {
        $movieId = $_GET['movie_id'];
        $movies = "SELECT *
                FROM movie_list m
                WHERE m.status = 1 and id = $movieId
                ORDER BY m.name";
    }else{
        $movies = "SELECT *
                FROM movie_list m
                WHERE m.status = 1
                ORDER BY m.name";
    }


    $result = $conn->query($movies);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Showtime - ChillFlix</title>
</head>
<body class="showtime">
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

    <section class="showtime">
        <h2>Upcoming Showtimes</h2>
        <table>
            <thead>
                <tr>
                    <th>Movie Title</th>
                    <th>Status</th>
                    <th>Ticket Price</th>
                    <th>Show Date & times</th>
                    
                </tr>
            </thead>
            <tbody>

                <?php
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['name']."</td>";
                        echo "<td>".$row['show_status']."</td>";
                        echo "<td>".$row['ticket_price']."</td>";

                         // Fetch movie showtimes
                        $movieId = $row['id'];
                        $movie_name = $row['name'];
                        $movie_date_time_list = "SELECT id, show_date_time FROM movie_show_date_time 
                                                    WHERE status = 1 AND movie_id = $movieId";

                        $movie_date_time_list_result = $conn->query($movie_date_time_list);

                        echo "<td>";

                        
                                   
                        while ($showtime = $movie_date_time_list_result->fetch_assoc()) {
                            $show_id = $showtime['id'];
                            // Format the showtime to human-readable format
                            $datetime = new DateTime($showtime['show_date_time']);
                            $formattedDateTime = $datetime->format('l, F j, Y \a\t g:i A'); // Example: Monday, January 1, 2025 at 5:00 PM
                            echo  $formattedDateTime." <a href='new_booking.php?movie_name=$movie_name&&show_time=$formattedDateTime' class='book-button'>Book Now</a><br />";
                        }
                                   
                               
                            
                        echo "</td>";
                        echo "</tr>";
                    }
                ?>
                


                <!-- <tr>
                    <td>Spider Man (No Way Home)</td>
                    <td>October 29, 2024</td>
                    <td>
                        2:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        5:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        8:00 PM <a href="book.html" class="book-button">Book Now</a>
                    </td>
                </tr>
                <tr>
                    <td>A Quiet Place 3</td>
                    <td>October 30, 2024</td>
                    <td>
                        1:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        4:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        7:00 PM <a href="book.html" class="book-button">Book Now</a>
                    </td>
                </tr>
                <tr>
                    <td>Shurongo</td>
                    <td>October 31, 2024</td>
                    <td>
                        12:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        3:00 PM <a href="book.html" class="book-button">Book Now</a><br />
                        6:00 PM <a href="book.html" class="book-button">Book Now</a>
                    </td>
                </tr> -->
                
            </tbody>
        </table>
    </section>

    <footer>
        <p>Copyright© 2024 ChillFlix Motion Limited. All Rights Reserved.</p>
    </footer>
</body>
</html>
