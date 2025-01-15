<?php
require 'login_check.php';
require 'database_connection.php';

// Fetch the movie ID from the request
$movieId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check if the movie ID is valid
if ($movieId > 0) {
    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Update the status of the movie in the movie_list table
        $updateMovieStatusQuery = "UPDATE movie_list SET status = 0 WHERE id = ?";
        $stmt = $conn->prepare($updateMovieStatusQuery);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();

        // Update the status of associated showtimes in the movie_show_date_time table
        $updateShowtimesStatusQuery = "UPDATE movie_show_date_time SET status = 0 WHERE movie_id = ?";
        $stmt = $conn->prepare($updateShowtimesStatusQuery);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();

        // Commit the transaction
        $conn->commit();

        // Set success message and redirect
        $_SESSION['success'] = "Movie and its showtimes have been deactivated successfully!";
        header("Location:".$_SESSION['prev_url']);
        exit;
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        $_SESSION['error'] = "Error deactivating movie: " . $e->getMessage();
        header("Location:".$_SESSION['prev_url']);
        exit;
    }
} else {
    // Invalid movie ID
    $_SESSION['error'] = "Invalid movie ID.";
    header("Location:".$_SESSION['prev_url']);
    exit;
}
?>
