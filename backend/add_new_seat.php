<?php require 'header.php'; ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Show seats Settings</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Add New seat</li>
    </ol>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Add New seat
        </div>
        <div class="card-body">
                <div class="row col-md-12">
                    <form class="bg-light" action="add_new_seat_action.php" method="post"> 

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
                            <label for="movieName" class="form-label">Seat Name</label>
                            <input type="text" class="form-control form-control-sm" id="movieName" name="name" placeholder="Enter name" required>
                        </div>
                        
                        <!-- Submit Button -->
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-sm btn-success">Submit</button>
                        </div>
                    </form>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php';?>