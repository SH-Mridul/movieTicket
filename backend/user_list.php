<?php require 'header.php'; ?>
<?php

$_SESSION['prev_url'] = "user_list.php";
// Fetch movie list with showtimes
$users = "SELECT * from users";


$result = $conn->query($users);
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Data</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Users/Customers List</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Users/Customers List
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
                            <th>Username</th>
                            <th>Email</th>
                            <th>Contact Number</th>
                            <th>Status</th>
                            <th>Actions</th> <!-- Add actions column -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            $counter = 1;
                            while ($row = $result->fetch_assoc()) {
                                $user_id = $row['id'];
                                $username = $row['username'];
                                $email = $row['email'];
                                $contact_number = $row['contact_number'];
                                $status = ($row['status'] == 1) ? 'Active' : 'Inactive';

                                echo "<tr>";
                                echo "<td>$counter</td>";
                                echo "<td>$username</td>";
                                echo "<td>$email</td>";
                                echo "<td>$contact_number</td>";
                                echo "<td>$status</td>";
                                echo "<td>";
                                // Update and Delete Actions
                                if($status == 'Active'){
                                     echo "<a href='update_user.php?id=$user_id' class='btn btn-sm btn-danger'>Inactive</a> ";
                                }else{
                                    echo "<a href='update_user.php?id=$user_id' class='btn btn-sm btn-danger'>Active</a> ";
                                }   
                               

                                echo "</td>";
                                echo "</tr>";
                                $counter++;
                            }
                        } else {
                            echo "<tr><td colspan='6'>No users found</td></tr>";
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
