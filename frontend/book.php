<?php
     require 'database_connection.php';
     require 'login_check.php';

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
    <link rel="stylesheet" href="styles.css" />
  </head>
    <header>
        <div class="logo">ChillFlix  Cineplex</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="movies.php">Movies</a></li>
                <li><a href="showtime.php">Showtimes</a></li>
                <li><a href="book.php">Book Seats</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="logout.php" id="logoutButton">Logout</a></li>

            </ul>
        </nav>
    </header>

  <body class="book">
    <div class="movie-container">
      <label> Select a movie:</label>
      <select id="movie">
        <option selected disabled value = "">---select---</option>
        <?php 
                while ($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $price = $row['ticket_price'];
                    echo "<option value='".$id."'> $name (BDT. $price)</option>";
                    
                }
            ?>
      </select>
    </div>

    <ul class="showcase">
      <li>
        <div class="seat"></div>
        <small>Available</small>
      </li>
      <li>
        <div class="seat selected"></div>
        <small>Selected</small>
      </li>
      <li>
        <div class="seat sold"></div>
        <small>Sold</small>
      </li>
    </ul>
    <div class="container">
      <div class="screen"></div>

      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>

      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat sold"></div>
        <div class="seat sold"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat sold"></div>
        <div class="seat sold"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat sold"></div>
        <div class="seat sold"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
      </div>
      <div class="row">
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat"></div>
        <div class="seat sold"></div>
        <div class="seat sold"></div>
        <div class="seat sold"></div>
        <div class="seat"></div>
      </div>
    </div>

    <p class="text">
      You have selected <span id="count">0</span> seat for a price of BDT.<span
        id="total"
        >0</span
      >
    </p>
    <!-- Payment Form -->
    <div class="main-container">
      <div class="movie-container">
          <!-- Your existing movie selection and seating layout here -->
      </div>
  
      <div class="sidebar">
          <div id="paymentForm" class="hidden form-container">
              <form id="billingForm">
                  <h2>Billing Information</h2>
                  <input type="text" id="name" placeholder="Name" required />
                  <input type="text" id="address" placeholder="Address" required />
                  <input type="text" id="phone" placeholder="Phone Number" required />
                  <button type="submit">Confirm Booking</button>
              </form>
          </div>
  
          <div id="bill" class="hidden bill-container">
              <h3>Bill Details</h3>
              <div id="billDetails"></div>
          </div>
      </div>
  </div>
  
    <script src="script.js"></script>
  </body>
</html>