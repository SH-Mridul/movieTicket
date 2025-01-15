<?php 
require 'login_check.php';
require 'database_connection.php';

// Fetch the user ID from the GET request
$seat_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($seat_id > 0) {
    // Fetch current status of the user
    $query = "SELECT status FROM seats WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $seat_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_status = 0;

        // Update the status
        $updateQuery = "UPDATE seats SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ii", $new_status, $seat_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "seats status deleted successfully.";
        } else {
            $_SESSION['error'] = "Failed to update seats status.";
        }
    } else {
        $_SESSION['error'] = "seats not found.";
    }
} else {
    $_SESSION['error'] = "Invalid saeats ID.";
}

header("Location: seat_list.php");
exit;
?>
