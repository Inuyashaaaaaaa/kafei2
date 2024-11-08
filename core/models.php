<?php  
function insertcategory($pdo, $category_name, $description, $username) {
    $sql = "INSERT INTO coffee_categories (category_name, description, created_by) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$category_name, $description, $username]);
}

function getallcategories($pdo) {
    $sql = "SELECT c.*, 
            c.created_by, 
            c.created_at,
            c.updated_by,
            c.updated_at
            FROM coffee_categories c";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll() ?: [];
}

function updatecategory($pdo, $category_name, $description, $category_id, $username) {
    $sql = "UPDATE coffee_categories 
            SET category_name = ?, 
                description = ?,
                updated_by = ?,
                updated_at = CURRENT_TIMESTAMP 
            WHERE category_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$category_name, $description, $username, $category_id]);
}

function deletecategory($pdo, $category_id) {
    // First delete all variants in this category
    $deleteVariants = "DELETE FROM coffee_variants WHERE category_id = ?";
    $deleteStmt = $pdo->prepare($deleteVariants);
    $deleteStmt->execute([$category_id]);
    
    // Now delete the category
    $sql = "DELETE FROM coffee_categories WHERE category_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$category_id]);
}

function getvariantsbycategory($pdo, $category_id) {
    $sql = "SELECT 
                v.variant_id,
                v.variant_name,
                v.description,
                v.price,
                c.category_name,
                v.created_by,
                v.created_at,
                v.updated_by,
                v.updated_at
            FROM coffee_variants v
            JOIN coffee_categories c ON v.category_id = c.category_id
            WHERE v.category_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category_id]);
    return $stmt->fetchAll() ?: [];
}

function getcategorybyid($pdo, $category_id) {
    $sql = "SELECT * FROM coffee_categories WHERE category_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$category_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
}

function insertvariant($pdo, $variant_name, $description, $price, $category_id, $username) {
    $sql = "INSERT INTO coffee_variants (variant_name, description, price, category_id, created_by) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$variant_name, $description, $price, $category_id, $username]);
}

function deletevariant($pdo, $variant_id) {
    $sql = "DELETE FROM coffee_variants WHERE variant_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$variant_id]);
}

function updatevariant($pdo, $variant_name, $description, $price, $variant_id, $username) {
    $sql = "UPDATE coffee_variants 
            SET variant_name = ?, 
                description = ?, 
                price = ?,
                updated_by = ?,
                updated_at = CURRENT_TIMESTAMP
            WHERE variant_id = ?";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$variant_name, $description, $price, $username, $variant_id]);
}

function getvariantbyid($pdo, $variant_id) {
    $sql = "SELECT * FROM coffee_variants WHERE variant_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$variant_id]);
    return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
}


function insertNewUser($pdo, $username, $password) {
    $checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
    $checkUserSqlStmt = $pdo->prepare($checkUserSql);
    $checkUserSqlStmt->execute([$username]);

    if ($checkUserSqlStmt->rowCount() == 0) {
        $sql = "INSERT INTO user_passwords (username, password) VALUES(?, ?)";
        $stmt = $pdo->prepare($sql);
        $executeQuery = $stmt->execute([$username, $password]);

        if ($executeQuery) {
            $_SESSION['message'] = "User successfully inserted";
            $_SESSION['message_type'] = 'success';
            return true;
        } else {
            $_SESSION['message'] = "An error occurred from the query";
            $_SESSION['message_type'] = 'danger';
        }
    } else {
        $_SESSION['message'] = "User already exists";
        $_SESSION['message_type'] = 'danger';
    }

    return false;
}




function loginUser($pdo, $username, $password) {
    $sql = "SELECT * FROM user_passwords WHERE username=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username]); 

    if ($stmt->rowCount() == 1) {
        $userInfoRow = $stmt->fetch();
        $usernameFromDB = $userInfoRow['username']; 
        $passwordFromDB = $userInfoRow['password'];

        if ($password == $passwordFromDB) {
            // Start the session if not already started
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['username'] = $usernameFromDB;

            return true;
        } else {
            $_SESSION['message'] = "Password is invalid";
            $_SESSION['message_type'] = 'danger';
            return false;
        }
    }
    
    $_SESSION['message'] = "Username doesn't exist. Please register first";
    $_SESSION['message_type'] = 'danger';
    return false;
}


function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}
?>



