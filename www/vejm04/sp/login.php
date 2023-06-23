<?php
session_start();
require_once 'config.php';

$email = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $email = htmlspecialchars($email);
    $password = htmlspecialchars($password);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: index.php');
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    <link rel="stylesheet" type="text/css" href="./styles/login.css">
</head>
<body>
    <?php require_once 'header.php'; ?>
    <h2>User Login</h2>
    <?php if (isset($error)) : ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>
    <div class="container login-container">
        <form method="POST" action="login.php">
            <label>Email:</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required><br>

            <label>Password:</label>
            <input type="password" name="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
    <div>
        <a href="googleLogin.php?action=login" class="googleLogin">Login with Google instead</a>
    </div>
</body>
</html>