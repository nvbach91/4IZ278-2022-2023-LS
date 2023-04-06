<?php require 'utils.php' ?>

<?php 

$formIsSubmitted = !empty($_POST);

$email = (isset($_GET['email']) ? $_GET['email'] : null);
$fromRegistration = !empty($_GET['reg']);

if ($formIsSubmitted) {
    if (!$email) {
        $email = htmlspecialchars(trim($_POST['email']));
    }

    $password = htmlspecialchars(trim($_POST['password']));
    $result = authenticate($email, $password);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Login</h1>
        <form method="POST" action="./login.php">
            <?php if ($fromRegistration): ?>
                <div class="success-container">Registration was successful!</div>
            <?php elseif (!empty($result)): ?>
                <?php if ($result == "Login successful"): ?>
                    <div class="success-container"><?php echo $result ?></div>
                <?php else: ?>
                    <div class="error-container"><?php echo $result ?></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="input-container">
                <div class="input-group">
                    <label class="label" for="email">E-mail</label>
                    <input class="input" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
                </div>
                <div class="input-group">
                    <label class="label" for="password">Password</label>
                    <input class="input" id="password" name="password" type="password">
                </div>
                <button class="submit-button">Submit</button>
            </div>
            </form>
    </div>
</body>
</html>
