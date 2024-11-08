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
    <title>Delete Variant</title>
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
        <a href="view_variants.php?category_id=<?php echo $_GET['category_id']; ?>" class="btn btn-secondary mb-3">Return to Variants</a>
        
        <?php $getvariantinfo = getvariantbyid($pdo, $_GET['variant_id']); ?>
        <h1 class="text-danger">Confirm Deletion of Variant</h1>
        
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Variant Name: <?php echo htmlspecialchars($getvariantinfo['variant_name']); ?></h5>
                <p class="card-text">Description: <?php echo htmlspecialchars($getvariantinfo['description']); ?></p>
                <p class="card-text">Price: ₱<?php echo number_format($getvariantinfo['price'], 2); ?></p>
                <form action="core/handleforms.php?variant_id=<?php echo $_GET['variant_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" method="POST">
                    <button type="submit" name="deletevariantbtn" class="btn btn-danger">Confirm Delete</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
