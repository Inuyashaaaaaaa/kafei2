<?php  
require_once 'core/models.php'; 
require_once 'core/handleForms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4 shadow">
            <h1 class="mb-4">Register Here!</h1>
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-danger"><?php echo $_SESSION['message']; ?></div>
            <?php } unset($_SESSION['message']); ?>
            <form action="core/handleForms.php" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" name="registerUserBtn" class="btn btn-primary">Register</button>
            </form>
        </div>
    </div>
</body>
</html>