<?php 
require 'login_check.php';
require 'database_connection.php';

// Fetch the user ID from the GET request
$booking_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($booking_id > 0) {
    // Fetch current status of the user
    $query = "SELECT status FROM booking_lists WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_status = 0;

        // Update the status
        $updateQuery = "UPDATE booking_lists SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ii", $new_status, $booking_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "booking cancelled!";
        } else {
            $_SESSION['error'] = "Failed to cancel.";
        }
    } else {
        $_SESSION['error'] = "booking not found.";
    }
} else {
    $_SESSION['error'] = "Invalid booking ID.";
}

header("Location: booking_list.php");
exit;
?>
