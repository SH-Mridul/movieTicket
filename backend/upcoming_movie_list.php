<?php require 'header.php'; ?>
<?php

$_SESSION['prev_url'] = "upcoming_movie_list.php";
// Fetch movie list with showtimes
$moviesQuery = "SELECT m.id, m.name, m.show_status, m.poster_path, m.ticket_price
                FROM movie_list m
                WHERE m.show_status = 'upcoming' AND m.status = 1
                ORDER BY m.name";


$result = $conn->query($moviesQuery);
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Movie Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">upcoming Movie List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            upcoming Movie List
        </div>
        <div class="card-body">
           <div class="row col-md-12">
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
                <table class="table table-sm table-bordered text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Movie Name</th>
                            <th>Show Status</th>
                            <th>Ticket Price</th>
                            <th>Poster</th>
                            <th>Show Date & Time</th>
                            <th>Actions</th> <!-- Add actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $movieCounter = 1;
                            while ($row = $result->fetch_assoc()) {

                                // Fetch movie showtimes
                                $movieId = $row['id'];
                                $movie_date_time_list = "SELECT show_date_time FROM movie_show_date_time 
                                                         WHERE status = 1 AND movie_id = $movieId";

                                $movie_date_time_list_result = $conn->query($movie_date_time_list);

                                $movieName = $row['name'];
                                $price = $row['ticket_price'];
                                $showStatus = $row['show_status'];
                                $posterPath = $row['poster_path'];

                                echo "<tr>";
                                echo "<td>$movieCounter</td>";
                                echo "<td>$movieName</td>";
                                echo "<td>$showStatus</td>";
                                echo "<td>$price</td>";
                                echo "<td><img src='$posterPath' alt='$movieName Poster' style='max-width: 100px;'></td>";
                                echo "<td>";
                                if ($movie_date_time_list_result->num_rows > 0) {
                                    echo "<table class='table table-sm table-bordered text-center'>";
                                    echo "<tbody>";
                                    while ($showtime = $movie_date_time_list_result->fetch_assoc()) {
                                        // Format the showtime to human-readable format
                                        $datetime = new DateTime($showtime['show_date_time']);
                                        $formattedDateTime = $datetime->format('l, F j, Y \a\t g:i A'); // Example: Monday, January 1, 2025 at 5:00 PM
                                        echo "<tr><td>$formattedDateTime</td></tr>";
                                    }
                                    echo "</tbody></table>";
                                } else {
                                    echo "<p>No showtimes available</p>";
                                }
                                echo "</td>";
                                echo "<td>";
                                // Update and Delete Actions
                                echo "<a href='update_movie.php?id=$movieId' class='btn btn-sm btn-primary'>Update</a> ";
                                echo "<a href='javascript:void(0);' class='btn btn-sm btn-danger' onclick='confirmDelete($movieId)'>Delete</a>";
                                echo "</td>";
                                echo "</tr>";
                                $movieCounter++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No movies found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
           </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(movieId) {
        // Confirm before deletion
        if (confirm("Are you sure you want to delete this movie?")) {
            // Redirect to delete script
            window.location.href = "delete_movie.php?id=" + movieId;
        }
    }
</script>

<?php require 'footer.php'; ?>
