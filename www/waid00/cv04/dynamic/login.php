<?php
session_start();
error_reporting(0);
function fetchUser($email) {
    $handle = fopen("users.db", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $fields = explode(",", $line);
            if ($fields[1] == $email) {
                fclose($handle);
                return array(
                    "name" => $fields[0],
                    "email" => $fields[1],
                    "password" => $fields[2]
                );
            }
        }
        fclose($handle);
    }
    return null;
}

function authenticateUser($email, $password) {
    $user = fetchUser($email);
    $trimm = trim($password);
    $trimUser = trim($user['password']);
    if (!$user) {
        return "User not found";
    }

    if ($trimm === $trimUser) {
        $_SESSION['logged'] = true;
        header("Location: ../index.php");
        return "Login successful";
    } else {
        return "Incorrect password";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $errors = array();

    if (empty($email)) {
        $errors["email"] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Invalid email format";
    }

    if (empty($password)) {
        $errors["password"] = "Password is required";
    }

    if (empty($errors)) {
        $authError = authenticateUser($email, $password);
        if ($authError) {
            $errors["login"] = $authError;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://esotemp.vse.cz/~waid00/cv03/css/style.css">
    <link rel="stylesheet" href="https://esotemp.vse.cz/~waid00/cv02/css/style.css">
</head>
<body>
<?php include_once('../static/header.php'); ?>
<p><a href="register.php">register</a></p>
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="fields">
        <label>Email*</label>
        <input class="inputform" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <?php if (isset($errors['email'])) { echo "<div class='text-danger'>" . $errors['email'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <label>Password*</label>
        <input class="inputform" type="password" name="password">
        <?php if (isset($errors['password'])) { echo "<div class='text-danger'>" . $errors['password'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <input type="submit" class="submit" name="submit" value="Login">
        <?php if (isset($errors['login'])) { echo "<div class='text-danger'>" . $errors['login'] . "</div>"; } ?>
    </div>
    <?php if (isset($_GET['success'])) {?>
    <p><?php echo $_GET['success']; ?></p>
    <?php }?>
</form>

<?php include_once('../static/footer.php'); ?>
