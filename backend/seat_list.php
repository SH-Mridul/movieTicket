<?php require 'header.php'; ?>
<?php
// Fetch movie list with showtimes
$seats = "SELECT * from seats where status = 1";


$result = $conn->query($seats);
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Show seats Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Seat List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Seat List
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
                            <th>Seat Name</th>
                            <th>Actions</th> <!-- Add actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $seat_id = $row['id'];
                                $name = $row['seat_name'];

                                echo "<tr>";
                                echo "<td>$counter</td>";
                                echo "<td>$name</td>";
                                echo "<td>";
                                echo "<a href='delete_seat.php?id=$seat_id' class='btn btn-sm btn-danger'>delete</a> ";
                                echo "</td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No Seats found</td></tr>";
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
