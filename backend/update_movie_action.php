<?php 
require 'login_check.php';
require 'database_connection.php';
// Fetch the movie ID and other form data
$movieId = isset($_POST['movie_id']) ? $_POST['movie_id'] : 0;
$movieName = isset($_POST['name']) ? $_POST['name'] : '';
$price = isset($_POST['ticket_price']) ? $_POST['ticket_price'] : '';
$showStatus = isset($_POST['show_status']) ? $_POST['show_status'] : '';
$showDateTimes = isset($_POST['show_date_time']) ? $_POST['show_date_time'] : [];
$poster = isset($_FILES['poster']) ? $_FILES['poster'] : null;

// Check if the movie ID is valid
if ($movieId > 0) {
    // Check if the movie name is unique (exclude current movie)
    $checkMovieQuery = "SELECT id, poster_path FROM movie_list WHERE name = ? AND id != ? AND status = 1";
    $stmt = $conn->prepare($checkMovieQuery);
    $stmt->bind_param("si", $movieName, $movieId);
    $stmt->execute();
    $checkResult = $stmt->get_result();

    if ($checkResult->num_rows > 0) {
        $_SESSION['error'] = "A movie with this name already exists.";
        header("Location: update_movie.php?id=" . $movieId);
        exit;
    }

    // Check if at least one showtime is provided
    if (count($showDateTimes) == 0) {
        $_SESSION['error'] = "At least one showtime must be provided.";
        header("Location: update_movie.php?id=" . $movieId);
        exit;
    }

    // Start a transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Fetch the current poster path
        $movieQuery = "SELECT poster_path FROM movie_list WHERE id = ?";
        $stmt = $conn->prepare($movieQuery);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();
        $movieResult = $stmt->get_result();

        if ($movieResult->num_rows > 0) {
            $movieData = $movieResult->fetch_assoc();
            $oldPosterPath = $movieData['poster_path'];
        }

        // Check if a new poster image is uploaded
        if ($poster && $poster['error'] === 0) {
            // Handle file upload: delete old image if it exists
            if (file_exists($oldPosterPath) && $oldPosterPath !== 'default_image.jpg') {
                unlink($oldPosterPath);
            }

            // Upload the new poster image
            $targetDir = 'poster/';
            $posterName = basename($poster["name"]);
            $posterPath = $targetDir . uniqid() . "_" . $posterName; // Ensure unique poster name
            move_uploaded_file($poster["tmp_name"], $posterPath);
        } else {
            // No new poster, keep the old one
            $posterPath = $oldPosterPath;
        }

        // Update movie details
        $updateMovieQuery = "UPDATE movie_list SET name = ?, show_status = ?,ticket_price = ?,poster_path = ? WHERE id = ?";
        $stmt = $conn->prepare($updateMovieQuery);
        $stmt->bind_param("ssssi", $movieName, $showStatus,$price, $posterPath, $movieId);
        $stmt->execute();

        // Remove existing showtimes for the movie
        $deleteShowtimesQuery = "DELETE FROM movie_show_date_time WHERE movie_id = ?";
        $stmt = $conn->prepare($deleteShowtimesQuery);
        $stmt->bind_param("i", $movieId);
        $stmt->execute();

        // Insert new showtimes
        foreach ($showDateTimes as $showDateTime) {
            $insertShowtimeQuery = "INSERT INTO movie_show_date_time (movie_id, show_date_time, status) VALUES (?, ?, 1)";
            $stmt = $conn->prepare($insertShowtimeQuery);
            $stmt->bind_param("is", $movieId, $showDateTime);
            $stmt->execute();
        }

        // Commit the transaction
        $conn->commit();

        $_SESSION['success'] = "Movie updated successfully!";
        header("Location:".$_SESSION['prev_url']);
        exit;
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        $_SESSION['error'] = "Error updating movie: " . $e->getMessage();
        header("Location: update_movie.php?id=" . $movieId);
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid movie ID.";
    header("Location: movie_list.php");
    exit;
}
?>
