<?php
// Include the database connection file
include('database_connection.php');
require 'login_check.php';

if (!isset($_GET['movie_name']) && !isset($_GET['show_time'])){
    header("Location: index.php");
}

// Fetch the movie name and show time from a dropdown or input (hardcoded here for demo)
$selectedMovie = $_GET['movie_name']; // Replace with $_POST['movie_name'] for dynamic input
$showTime = $_GET['show_time']; // Replace with $_POST['show_time'] for dynamic input

// Fetch all seats from the seats table
$seatsQuery = "SELECT * FROM seats";
$seatsResult = mysqli_query($conn, $seatsQuery);

// Fetch booked seats for the selected movie and show time
$bookedSeatsQuery = "SELECT seat_name FROM booking_lists WHERE movie_name = '$selectedMovie' AND show_time = '$showTime' and status = 1";
$bookedSeatsResult = mysqli_query($conn, $bookedSeatsQuery);

// Store booked seat names in an array
$bookedSeats = [];
while ($row = mysqli_fetch_assoc($bookedSeatsResult)) {
    $bookedSeats[] = $row['seat_name'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Booking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #4B0082; /* Purple background */
            color: white;
        }
        .seat {
            width: 30px;
            height: 30px;
            margin: 5px;
            background-color: gray;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            margin-right: 20px;
        }
        .seat.booked {
            background-color: white;
            cursor: not-allowed;
        }
        .seat.selected {
            background-color: green;
        }
        .screen {
            background-color: white;
            height: 20px;
            width: 80%;
            margin: 20px auto;
            border-radius: 5px;
        }
        .seat-row {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #29003b !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">ChillFlix Cineplex</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="movies.php">Movies</a></li>
                    <li class="nav-item"><a class="nav-link" href="showtime.php">Showtimes</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php" id="logoutButton">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container text-center py-4">
        <h1>ChillFlix Cineplex</h1>
        <h3>Movie: <?= $selectedMovie ?> | Show Time: <?= $showTime ?></h3>

        <div class="text-center ms-4">
            <p>
                <span class="seat"></span> 
                <span class="seat booked"></span> 
                <span class="seat selected"></span> 
                <br>
                <span class="mr-2">Available</span>
                <span class="mr-2">Booked</span>
                <span class="mr-2">Selected</span>
            </p>
        </div>
        <div class="screen"></div>

        <div>
            <?php
            // Organize seats into rows based on seat naming convention (e.g., A1, A2, B1, B2)
            $rows = [];
            mysqli_data_seek($seatsResult, 0); // Reset pointer
            while ($seat = mysqli_fetch_assoc($seatsResult)) {
                $seatName = $seat['seat_name'];
                $row = substr($seatName, 0, 1); // Extract row name (e.g., 'A' from 'A1')
                $rows[$row][] = $seatName;
            }

            // Generate rows
            foreach ($rows as $rowName => $rowSeats) {
                echo "<div class='seat-row'>";
                foreach ($rowSeats as $seatName) {
                    $isBooked = in_array($seatName, $bookedSeats);
                    $seatClass = $isBooked ? 'seat booked' : 'seat';
                    echo "<div class='$seatClass' data-seat-name='$seatName' onclick='selectSeat(this)'>{$seatName}</div>";
                }
                echo "</div>";
            }
            ?>
        </div>

        <p class="mt-4">You have selected <span id="seatCount">0</span> seat(s).</p>
        <div class="card bg-dark text-white p-4 mt-4">
            <h4>Billing Information</h4>
            <form action="process_booking.php" method="POST" class="p-3 bg-dark text-white rounded">
                <input type="hidden" name="movie_name" value="<?= $selectedMovie ?>">
                <input type="hidden" name="show_time" value="<?= $showTime ?>">
                <input type="hidden" id="selectedSeats" name="selected_seats">

                <div class="mb-2">
                    <input type="text" class="form-control form-control-sm" id="name" name="customer_name" value="<?php echo $_SESSION['username']; ?>" placeholder="Enter your name" required>
                </div>
                <div class="mb-2">
                    <input type="text" class="form-control form-control-sm" id="phone" name="contact_number" value="<?php echo $_SESSION['contact_number']; ?>" placeholder="Enter your phone number" required>
                </div>
                <button type="submit" class="btn btn-success btn-sm w-100">Confirm Booking</button>
            </form>
        </div>
    </div>

    <script>
        let selectedSeats = [];
        function selectSeat(seat) {
            if (seat.classList.contains('booked')) return;
            seat.classList.toggle('selected');
            const seatName = seat.getAttribute('data-seat-name');
            if (seat.classList.contains('selected')) {
                selectedSeats.push(seatName);
            } else {
                selectedSeats = selectedSeats.filter(name => name !== seatName);
            }
            document.getElementById('seatCount').textContent = selectedSeats.length;
            document.getElementById('selectedSeats').value = selectedSeats.join(',');
        }
    </script>
</body>
</html>
