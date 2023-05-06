<?php
session_start();
include_once('database.php');
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {

        $stmt = $pdo->prepare("SELECT MAX(user_id) AS max_id FROM users");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $user_id = $row['max_id'] + 1;

        $stmt = $pdo->prepare("INSERT INTO users (user_id, registration_date, name, email, phone, address, privilege, password) 
                               VALUES (:user_id, NOW(), :name, :email, :phone, :address, 0, :password)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        $_SESSION['success_message'] = "Registration successful. Please log in.";
        header("Location: login.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Registration failed. Please try again.";
        header("Location: register.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
</head>

<body>
    <div class="wrapper">
    <h1>Register</h1>

    <?php if (isset($_SESSION['error_message'])) : ?>
        <div style="color:red;"><?php echo $_SESSION['error_message']; ?></div>
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>

    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" class="form-control" required><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" class="form-control" required><br><br>

        <label>Address:</label>
        <input type="text" name="address" class="form-control" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" class="form-control" required><br><br>

        <button type="submit" class="btn btn-primary" name="register">Register</button>
        <p>Already have an account? <a href="login.php">Login</a>.</p>
    </form>
    </div>
</body>

</html>