<?php 
require 'login_check.php';
require 'database_connection.php';

// Fetch the user ID from the GET request
$user_id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($user_id > 0) {
    // Fetch current status of the user
    $query = "SELECT status FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_status = ($row['status'] == 1) ? 0 : 1;

        // Update the status
        $updateQuery = "UPDATE users SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ii", $new_status, $user_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "User status updated successfully.";
        } else {
            $_SESSION['error'] = "Failed to update user status.";
        }
    } else {
        $_SESSION['error'] = "User not found.";
    }
} else {
    $_SESSION['error'] = "Invalid user ID.";
}

header("Location: user_list.php");
exit;
?>
