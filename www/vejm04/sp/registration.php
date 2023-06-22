<?php
session_start();
require_once 'config.php';

$firstName = '';
$lastName = '';
$address = '';
$city = '';
$zipCode = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zipCode = $_POST['zipCode'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    if (empty($firstName)) {
        $errors[] = "First name is required";
    }

    if (empty($lastName)) {
        $errors[] = "Last name is required";
    }

    if (empty($address)) {
        $errors[] = "Address is required";
    }

    if (empty($city)) {
        $errors[] = "City is required";
    }

    if (empty($zipCode)) {
        $errors[] = "Zip code is required";
    } elseif (!preg_match('/^\d{5}$/', $zipCode)) {
        $errors[] = "Invalid zip code format";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    } else {
        $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $existingEmail = $stmt->fetchColumn();
        if ($existingEmail) {
            $errors[] = "Email is already registered";
        }
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            if ($error == 'Email is already registered') {
                $errorHtml = "<p class='error'>$error - <a href='login.php'>Login instead</a></p>";
            } else {
                $errorHtml = "<p class='error'>$error</p>";
            }
            $errorHtmlArray[] = $errorHtml;
        }
    } else {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, address, city, zip, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$firstName, $lastName, $address, $city, $zipCode, $email, $hashedPassword]);
            $userId = $pdo->lastInsertId();
            $_SESSION['user_id'] = $userId;

            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Registration</title>
    <link rel="stylesheet" type="text/css" href="./styles/registration.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h2>User Registration</h2>
    <div class="container registration-container">
        <form method="POST" action="registration.php">
            <label>First Name:</label>
            <input type="text" name="firstName" value="<?php echo $firstName; ?>" required><br>

            <label>Last Name:</label>
            <input type="text" name="lastName" value="<?php echo $lastName; ?>" required><br>

            <label>Address:</label>
            <input type="text" name="address" value="<?php echo $address; ?>" required><br>

            <label>City:</label>
            <input type="text" name="city" value="<?php echo $city; ?>" required><br>

            <label>Zip Code:</label>
            <input type="text" name="zipCode" value="<?php echo $zipCode; ?>" required><br>

            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Register">
        </form>
        
        <?php if (!empty($errorHtmlArray)): ?>
            <?php foreach ($errorHtmlArray as $errorHtml): ?>
                <?php echo $errorHtml; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <div>
        <a href="privacyPolicy.php" class="privacyPolicyAndFB">Zásady ochrany osobních údajů</a>
    </div>
</body>
</html>
