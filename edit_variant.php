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
    <title>Edit Coffee Variant</title>
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
        
        <h1>Edit Coffee Variant</h1>
        <?php $getvariantinfo = getvariantbyid($pdo, $_GET['variant_id']); ?>
        
        <form action="core/handleforms.php?variant_id=<?php echo $_GET['variant_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" method="POST" class="mt-3">
            <div class="form-group">
                <label for="variant_name">Variant Name:</label>
                <input type="text" name="variant_name" class="form-control" value="<?php echo htmlspecialchars($getvariantinfo['variant_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($getvariantinfo['description']); ?>" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?php echo number_format($getvariantinfo['price'], 2); ?>" required>
            </div>
            <button type="submit" name="editvariantbtn" class="btn btn-primary">Update Variant</button>
        </form>
    </div>
</body>
</html>
