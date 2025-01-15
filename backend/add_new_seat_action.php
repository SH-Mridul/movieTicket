<?php
require 'login_check.php';
require 'database_connection.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $seat_name = isset($_POST['name']) ? trim($_POST['name']) : '';

    // Validate input
    if (empty($seat_name)) {
        $_SESSION['error'] = "Seat name cannot be empty.";
        header("Location: add_new_seat.php");
        exit;
    }

    try {
        // Check if seat name already exists
        $checkQuery = "SELECT id FROM seats WHERE seat_name = ? and status = 1";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param("s", $seat_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['error'] = "Seat name already exists.";
            header("Location: add_new_seat.php");
            exit;
        }

        // Insert new seat into the database
        $insertQuery = "INSERT INTO seats (seat_name) VALUES (?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("s", $seat_name);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Seat added successfully.";
        } else {
            $_SESSION['error'] = "Failed to add seat.";
        }
    } catch (Exception $e) {
        $_SESSION['error'] = "Error: " . $e->getMessage();
    }

    header("Location: add_new_seat.php");
    exit;
}
?>
