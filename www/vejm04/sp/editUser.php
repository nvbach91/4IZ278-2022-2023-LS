<?php
require_once 'config.php';
require_once 'header.php';

if (isset($_SESSION['user_id'])) {
    try {
        $query = "SELECT * FROM users WHERE id = ?";
        $statement = $pdo->prepare($query);
        $statement->execute([$_SESSION['user_id']]);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $firstName = $result['first_name'];
        $lastName = $result['last_name'];
        $address = $result['address'];
        $city = $result['city'];
        $zipCode = $result['zip'];
        $email = $result['email'];
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
} else {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newFirstName = $_POST['first_name'];
    $newLastName = $_POST['last_name'];
    $newAddress = $_POST['address'];
    $newCity = $_POST['city'];
    $newZipCode = $_POST['zip_code'];

    try {
        $query = "UPDATE users SET first_name = :firstName, last_name = :lastName, address = :address, city = :city, zip = :zipCode WHERE id = :userId";
        $statement = $pdo->prepare($query);
        $statement->execute([
            'firstName' => $newFirstName,
            'lastName' => $newLastName,
            'address' => $newAddress,
            'city' => $newCity,
            'zipCode' => $newZipCode,
            'userId' => $_SESSION['user_id']
        ]);

        header("Location: account.php");
        exit();
    } catch (PDOException $e) {
        die("Error executing the query: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit User</title>
    <link rel="stylesheet" type="text/css" href="./styles/common.css">
    <link rel="stylesheet" type="text/css" href="./styles/editUser.css">
</head>
<body>
    <div class="container-editUser">
        <h1>Edit User</h1>
        <form action="editUser.php" method="post">
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" maxlength="20" value="<?php echo $firstName; ?>" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" maxlength="20" value="<?php echo $lastName; ?>" required>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" maxlength="50" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" name="city" id="city" maxlength="20" value="<?php echo $city; ?>" required>
            </div>
            <div class="form-group">
                <label for="zip_code">ZIP Code:</label>
                <input type="text" name="zip_code" id="zip_code" maxlength="10" value="<?php echo $zipCode; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $email; ?>" disabled>
            </div>
            <div class="button-group">
                <button type="submit" class="btn btn-save">Save</button>
                <button href="account.php" class="btn btn-back">Back</button>
            </div>
        </form>
    </div>
</body>
</html>
