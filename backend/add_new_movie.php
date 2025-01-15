<?php require 'header.php'; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Movie Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add New Movie</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Add New Movie
        </div>
        <div class="card-body">
                <div class="row col-md-12">
                    <form class="bg-light" action="add_new_movie_action.php" method="post" enctype="multipart/form-data"> 

                        <?php if(isset($_SESSION['success'])){?>
                            <div class="alert alert-success" role="alert">
                                <?php if(isset($_SESSION['success'])){  echo $_SESSION['success']; unset($_SESSION['success']); }?>
                            </div>
                        <?php }?>

                            <?php if(isset($_SESSION['error'])){?>
                            <div class="alert alert-danger" role="alert">
                                <?php if(isset($_SESSION['error'])){  echo $_SESSION['error']; unset($_SESSION['error']); }?>
                            </div>
                        <?php }?>

                        <!-- Movie Name -->
                        <div class="mb-3">
                            <label for="movieName" class="form-label">Movie Name</label>
                            <input type="text" class="form-control form-control-sm" id="movieName" name="name" placeholder="Enter movie name" required>
                        </div>
                        
                        <!-- Show Status -->
                        <div class="mb-3">
                            <label for="showStatus" class="form-label">Show Status</label>
                            <select class="form-select form-select-sm" id="showStatus" name="show_status" required>
                                <option selected disabled>----select----</option>
                                <option value="showing">Showing</option>
                                <option value="upcoming">Upcoming</option>
                            </select>
                        </div>

                        <!-- Ticket Price -->
                        <div class="mb-3">
                            <label for="Price" class="form-label">Ticket Price</label>
                            <input type="number" class="form-control form-control-sm" id="Price" name="ticket_price" placeholder="Enter movie name" required>
                        </div>
                        
                        <!-- Poster -->
                        <div class="mb-3">
                            <label for="poster" class="form-label">Poster</label>
                            <input type="file" class="form-control form-control-sm" id="poster" name="poster" accept="image/*" required>
                        </div>
                        
                        <!-- Show DateTime -->
                        <div class="mb-3">
                            <label class="form-label">Show DateTime</label>
                            <div id="showDatetimeContainer">
                                <div class="input-group mb-2">
                                    <input type="datetime-local" class="form-control form-control-sm" name="show_date_time[]" required>
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addDatetime">add more show time</button>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
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
<?php require 'footer.php';?>