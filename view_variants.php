<?php 
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
    exit();
}

$getcategoryinfo = getcategorybyid($pdo, $_GET['category_id']);
$getvariantsbycategory = getvariantsbycategory($pdo, $_GET['category_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Variants</title>
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
        
        <?php $getcategoryinfo = getcategorybyid($pdo, $_GET['category_id']); ?>
        <h1>Category: <?php echo htmlspecialchars($getcategoryinfo['category_name']); ?></h1>
        
        <h2 class="mt-4">Add New Coffee Variant</h2>
        <form action="core/handleforms.php?category_id=<?php echo $_GET['category_id']; ?>" method="POST" class="mb-4">
            <div class="form-group">
                <label for="variant_name">Variant Name:</label>
                <input type="text" name="variant_name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" step="0.01" name="price" class="form-control" required>
            </div>
            <button type="submit" name="insertvariantbtn" class="btn btn-primary">Add Variant</button>
        </form>

        <h2 class="mt-5">Variants List</h2>
        <table class="table table-striped table-hover mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Variant ID</th>
                    <th>Variant Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Last Updated By</th>
                    <th>Last Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $getvariantsbycategory = getvariantsbycategory($pdo, $_GET['category_id']); ?>
                <?php foreach ($getvariantsbycategory as $row) { ?>
                    <tr>
                        <td><?php echo $row['variant_id']; ?></td>     
                        <td><?php echo htmlspecialchars($row['variant_name']); ?></td>        
                        <td><?php echo htmlspecialchars($row['description']); ?></td>             
                        <td>₱<?php echo number_format($row['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($row['created_by']); ?></td>
                        <td><?php echo date('M d, Y g:i A', strtotime($row['created_at'])); ?></td>
                        <td><?php echo $row['updated_by'] ? htmlspecialchars($row['updated_by']) : '-'; ?></td>
                        <td><?php echo $row['updated_at'] ? date('M d, Y g:i A', strtotime($row['updated_at'])) : '-'; ?></td>
                        <td>
                            <a href="edit_variant.php?variant_id=<?php echo $row['variant_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_variant.php?variant_id=<?php echo $row['variant_id']; ?>&category_id=<?php echo $_GET['category_id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        </td>      
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>