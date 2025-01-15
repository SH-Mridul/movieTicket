<?php 
require 'header.php'; 
require 'database_connection.php';

// Fetch the movie ID from the URL or POST data
$movieId = isset($_GET['id']) ? $_GET['id'] : 0;

if ($movieId > 0) {
    // Fetch movie details from the database
    $movieQuery = "SELECT m.id, m.name, m.show_status, m.poster_path,m.ticket_price
                   FROM movie_list m 
                   WHERE m.id = ? AND m.status = 1";
    $stmt = $conn->prepare($movieQuery);
    $stmt->bind_param("i", $movieId);
    $stmt->execute();
    $movieResult = $stmt->get_result();

    if ($movieResult->num_rows > 0) {
        $movieData = $movieResult->fetch_assoc();
        $movieName = $movieData['name'];
        $price = $movieData['ticket_price'];
        $showStatus = $movieData['show_status'];
        $posterPath = $movieData['poster_path'];

        // Fetch showtimes
        $showtimeQuery = "SELECT show_date_time FROM movie_show_date_time WHERE movie_id = ? AND status = 1";
        $showtimeStmt = $conn->prepare($showtimeQuery);
        $showtimeStmt->bind_param("i", $movieId);
        $showtimeStmt->execute();
        $showtimeResult = $showtimeStmt->get_result();
        
        // Store showtimes
        $showTimes = [];
        while ($showtime = $showtimeResult->fetch_assoc()) {
            $showTimes[] = $showtime['show_date_time'];
        }
    } else {
        $_SESSION['error'] = "Movie not found or is inactive.";
        header("Location: movie_list.php");
        exit;
    }
} else {
    $_SESSION['error'] = "Invalid movie ID.";
    header("Location: movie_list.php");
    exit;
}
?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Movie Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Update Movie</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Update Movie Details
        </div>
        <div class="card-body">
            <div class="row col-md-12">
                <form class="bg-light" action="update_movie_action.php" method="post" enctype="multipart/form-data">

                    <?php if(isset($_SESSION['success'])){?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                        </div>
                    <?php }?>

                    <?php if(isset($_SESSION['error'])){?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php }?>

                    <!-- Movie Name -->
                    <div class="mb-3">
                        <label for="movieName" class="form-label">Movie Name</label>
                        <input type="text" class="form-control form-control-sm" id="movieName" name="name" value="<?php echo $movieName; ?>" placeholder="Enter movie name" required>
                    </div>

                    <!-- Show Status -->
                    <div class="mb-3">
                        <label for="showStatus" class="form-label">Show Status</label>
                        <select class="form-select form-select-sm" id="showStatus" name="show_status" required>
                             <option selected disabled>--select--</option>
                            <option value="showing" <?php echo ($showStatus == 'showing') ? 'selected' : ''; ?>>Showing</option>
                            <option value="upcoming" <?php echo ($showStatus == 'upcoming') ? 'selected' : ''; ?>>Upcoming</option>
                        </select>
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="text" class="form-control form-control-sm" id="Price" name="ticket_price" value="<?php echo $price; ?>" placeholder="Enter movie name" required>
                    </div>

                    <!-- Poster -->
                    <div class="mb-3">
                        <label for="poster" class="form-label">Poster</label>
                        <input type="file" class="form-control form-control-sm" id="poster" name="poster" accept="image/*">
                        <?php if ($posterPath): ?>
                            <p>Current Poster: <img src="<?php echo $posterPath; ?>" alt="Poster" style="max-width: 100px;"></p>
                        <?php endif; ?>
                    </div>

                    <!-- Show DateTime -->
                    <div class="mb-3">
                        <label class="form-label">Show DateTime</label>
                        <div id="showDatetimeContainer">
                            <?php foreach ($showTimes as $showtime): ?>
                                <div class="input-group mb-2">
                                    <input type="datetime-local" class="form-control form-control-sm" name="show_date_time[]" value="<?php echo $showtime; ?>" required>
                                    <button type="button" class="btn btn-sm btn-danger remove-datetime">Remove</button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" id="addDatetime">Add More Show Time</button>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <input type="hidden" name="movie_id" value="<?php echo $movieId; ?>">
                        <button type="submit" class="btn btn-sm btn-success">Update Movie</button>
                    </div>
                </form>
            </div>

            <!-- Bootstrap JS and Dependencies -->
            <script>
                // Add new DateTime input dynamically
                document.getElementById('addDatetime').addEventListener('click', function () {
                    const container = document.getElementById('showDatetimeContainer');
                    const newInputGroup = document.createElement('div');
                    newInputGroup.classList.add('input-group', 'mb-2');
                    newInputGroup.innerHTML = `
                        <input type="datetime-local" class="form-control form-control-sm" name="show_date_time[]" required>
                        <button type="button" class="btn btn-sm btn-danger remove-datetime">Remove</button>
                    `;
                    container.appendChild(newInputGroup);
                });

                // Remove a DateTime input
                document.addEventListener('click', function (e) {
                    if (e.target && e.target.classList.contains('remove-datetime')) {
                        e.target.parentElement.remove();
                    }
                });
            </script>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
