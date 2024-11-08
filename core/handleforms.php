<?php 
session_start();
require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertcategorybtn'])) {
    $query = insertcategory($pdo, $_POST['category_name'], $_POST['description'], $_SESSION['username']);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editcategorybtn'])) {
    $query = updatecategory($pdo, $_POST['category_name'], $_POST['description'], $_GET['category_id'], $_SESSION['username']);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Edit failed";
    }
}


if (isset($_POST['deletecategorybtn'])) {
    $query = deletecategory($pdo, $_GET['category_id']);
    if ($query) {
        header("Location: ../index.php");
    } else {
        echo "Deletion failed";
    }
}

if (isset($_POST['insertvariantbtn'])) {
    $query = insertvariant($pdo, $_POST['variant_name'], $_POST['description'], $_POST['price'], $_GET['category_id'], $_SESSION['username']);

    if ($query) {
        header("Location: ../view_variants.php?category_id=" . $_GET['category_id']);
    } else {
        echo "Insertion failed";
    }
}

if (isset($_POST['editvariantbtn'])) {
    $query = updatevariant($pdo, $_POST['variant_name'], $_POST['description'], $_POST['price'], $_GET['variant_id'], $_SESSION['username']);
    if ($query) {
        header("Location: ../view_variants.php?category_id=" . $_GET['category_id']);
    } else {
        echo "Edit failed";
    }
}


if (isset($_POST['deletevariantbtn'])) {
    $variant_id = $_GET['variant_id'];
    $category_id = $_GET['category_id'];
    $query = deletevariant($pdo, $variant_id);
    if ($query) {
        header("Location: ../view_variants.php?category_id=" . $category_id); // Redirect back to variants page
    } else {
        echo "Variant deletion failed";
    }
}



if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {
    $username = $_POST['username'];
    $password = sha1($_POST['password']);

    if (!empty($username) && !empty($password)) {
        if (loginUser($pdo, $username, $password)) {
            header("Location: ../index.php");
            exit(); // Add exit after redirect
        } else {
            header("Location: ../login.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Please fill in all fields";
        header("Location: ../login.php");
        exit();
    }
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}



?>


