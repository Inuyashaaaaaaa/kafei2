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
    <title>Delete Category</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
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
    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">Return to Home</a>
        
        <?php $getcategorybyid = getcategorybyid($pdo, $_GET['category_id']); ?>
        <h1 class="text-danger">Confirm Deletion of Category</h1>
        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Category Name: <?php echo htmlspecialchars($getcategorybyid['category_name']); ?></h5>
                <p class="card-text">Description: <?php echo htmlspecialchars($getcategorybyid['description']); ?></p>
                <p class="card-text">Date Added: <?php echo $getcategorybyid['created_at']; ?></p>
                <form action="core/handleforms.php?category_id=<?php echo $_GET['category_id']; ?>" method="POST">
                    <button type="submit" name="deletecategorybtn" class="btn btn-danger">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
