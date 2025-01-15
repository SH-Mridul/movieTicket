<?php
include('database_connection.php');
require 'login_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = $_POST['customer_name'];
    $contactNumber = $_POST['contact_number'];
    $movieName = $_POST['movie_name'];
    $showTime = $_POST['show_time'];
    $selectedSeats = explode(',', $_POST['selected_seats']);

    foreach ($selectedSeats as $seatName) {
        $insertQuery = "INSERT INTO booking_lists (customer_name, contact_number, movie_name, show_time, seat_name, status)
                        VALUES ('$customerName', '$contactNumber', '$movieName', '$showTime', '$seatName', '1')";
        mysqli_query($conn, $insertQuery);
    }

     $_SESSION['success'] = "seat booked successfully.";
    header('Location: movies.php');
    exit();
}
?>
