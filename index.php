<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>咖啡 Coffee Shop Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
body {
  background-color:  #c19d67;
}

.card {
            background-color: #eac29a;
        }
    .form-control {
        background-color: #eac29a;
    }

</style>
</head>
<body>
    <!-- Add navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">咖啡 Coffee Shop</a>
            <div class="ml-auto">
                <span class="navbar-text mr-3">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                </span>
                <a href="core/handleForms.php?logoutAUser" class="btn btn-outline-light">Logout</a>
            </div>
        </div>
    </nav>
    
    <div class="container my-5">
        <h1 class="text-center mb-4">咖啡 Coffee Shop Menu Management</h1>
        <!-- Form to add a new category -->
        <form action="core/handleforms.php" method="POST" class="mb-4">
            <div class="form-row">
                <div class="col-md-5 mb-3">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Enter category name" required>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter description" required>
                </div>
                <div class="col-md-2 align-self-end">
                    <button type="submit" class="btn btn-primary btn-block" name="insertcategorybtn">Add Category</button>
                </div>
            </div>
        </form>

        <!-- Display list of categories as cards -->
        <div class="row">
    <?php $getallcategories = getallcategories($pdo); ?>
    <?php foreach ($getallcategories as $row) { ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5 class="card-title">Category: <?php echo htmlspecialchars($row['category_name']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
                    <div class="text-muted small">
                        <p class="mb-1">Created by: <?php echo htmlspecialchars($row['created_by']); ?></p>
                        <p class="mb-1">Created on: <?php echo date('M d, Y g:i A', strtotime($row['created_at'])); ?></p>
                        <?php if ($row['updated_by']): ?>
                            <p class="mb-1">Last updated by: <?php echo htmlspecialchars($row['updated_by']); ?></p>
                            <p class="mb-1">Updated on: <?php echo date('M d, Y g:i A', strtotime($row['updated_at'])); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="view_variants.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-info btn-sm">View Variants</a>
                    <a href="edit_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete_category.php?category_id=<?php echo $row['category_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

    <!-- Add Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>