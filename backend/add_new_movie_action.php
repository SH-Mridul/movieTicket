<?php
require 'login_check.php';
require 'database_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize error array
    $errors = [];

    // Validate movie name
    $name = trim($_POST['name']);
    if (empty($name)) {
        $errors[] = "Movie name is required.";
    } elseif (strlen($name) > 255) {
        $errors[] = "Movie name must not exceed 255 characters.";
    }

    // Validate show status
    $show_status = trim($_POST['show_status']);
    if (!in_array($show_status, ['showing', 'upcoming'])) {
        $errors[] = "Invalid show status.";
    }

    
    // Validate movie name
    $price = trim($_POST['ticket_price']);
    if (empty($name)) {
        $errors[] = "Ticket Price name is required.";
    } elseif ($price<0) {
        $errors[] = "ticket price must be upto zero";
    }

    // Validate poster upload
    $poster = $_FILES['poster'];
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $posterExtension = strtolower(pathinfo($poster['name'], PATHINFO_EXTENSION));

    // Check if the uploaded file has a valid extension
    if ($poster['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Error uploading poster file.";
    } elseif (!in_array($posterExtension, $allowedExtensions)) {
        $errors[] = "Poster must be an image file (JPG, JPEG, PNG, or GIF).";
    } elseif ($poster['size'] > 2 * 1024 * 1024) { // Limit file size to 2MB
        $errors[] = "Poster size must not exceed 2MB.";
    }

    // Validate show date and time
    $show_date_time = $_POST['show_date_time'] ?? [];
    if (empty($show_date_time)) {
        $errors[] = "At least one show date and time is required.";
    } else {
        foreach ($show_date_time as $datetime) {
            if (!strtotime($datetime)) {
                $errors[] = "Invalid date and time format for show date.";
                break;
            }
        }
    }

    // If there are validation errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header("Location: add_new_movie.php");
        exit;
    }

    // Check if the movie already exists in the database
    $checkMovieQuery = "SELECT * FROM movie_list WHERE name = ?";
    $stmtCheck = $conn->prepare($checkMovieQuery);
    $stmtCheck->bind_param("s", $name);
    $stmtCheck->execute();
    $result = $stmtCheck->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['error'] = "Movie already exists in the database.";
        header("Location: add_new_movie.php");
        exit;
    }

    // Handle file upload
    $uploadDir = 'poster/';
    
    // Check if the directory exists, if not, create it
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            $_SESSION['error'] = "Failed to create poster directory.";
            header("Location: add_new_movie.php");
            exit;
        }
    }

    // Generate a unique name for the poster
    $uniquePosterName = uniqid('movie_', true) . '.' . $posterExtension;
    $uploadFilePath = $uploadDir . $uniquePosterName;

    // Move the uploaded file to the specified directory
    if (!move_uploaded_file($poster['tmp_name'], $uploadFilePath)) {
        $_SESSION['error'] = "Error saving poster file.";
        header("Location: add_new_movie.php");
        exit;
    }

    // Insert the movie into the movie_list table
    $insertMovieQuery = "INSERT INTO movie_list (name, show_status, poster_path,ticket_price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($insertMovieQuery);
    $stmt->bind_param("ssss", $name, $show_status, $uploadFilePath,$price);

    if ($stmt->execute()) {
        // Get the inserted movie ID
        $movie_id = $stmt->insert_id;

        // Insert each show datetime into the movie_show_date_time table
        $insertShowtimeQuery = "INSERT INTO movie_show_date_time (movie_id, show_date_time) VALUES (?, ?)";
        $stmtShowtime = $conn->prepare($insertShowtimeQuery);

        foreach ($show_date_time as $showtime) {
            $stmtShowtime->bind_param("is", $movie_id, $showtime);
            $stmtShowtime->execute();
        }

        $_SESSION['success'] = "Movie and showtimes added successfully!";
        header("Location: add_new_movie.php");
        exit;
    } else {
        $_SESSION['error'] = "Error adding movie: " . $conn->error;
        header("Location: add_new_movie.php");
        exit;
    }

    // Close the prepared statements and the database connection
    $stmt->close();
    if (isset($stmtShowtime)) {
        $stmtShowtime->close();
    }
    $conn->close();
} else {
    $_SESSION['error'] = "Invalid request method.";
    header("Location: add_new_movie.php");
    exit;
}
?>
