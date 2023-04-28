<?php

session_start();

if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
    header("location: index.php");
}

require_once "database.php";

$email = $password = "";
$email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }


    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }


    if (empty($email_err) && empty($password_err)) {

        $sql = "SELECT user_id, email, privilege, password FROM users WHERE email = :email";

        if ($stmt = $pdo->prepare($sql)) {

            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);


            $param_email = trim($_POST["email"]);

            if ($stmt->execute()) {

                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["user_id"];
                        $name = $row["name"];
                        $email = $row["email"];
                        $phone = $row['phone'];
                        $address = $row['address'];
                        $privilege = $row['privilege'];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {

                            session_start();

                            $_SESSION["login"] = true;
                            $_SESSION["user_id"] = $row["user_id"];
                            $_SESSION["email"] = $email;
                            $_SESSION['privilege'] = $row['privilege'];
                            $_SESSION['name'] = $row["name"];
                            $_SESSION['address'] = $row['address'];
                            $_SESSION['phone'] = $row['phone'];

                                header("location: index.php");
                        } else {
                            $password_err = "The password you entered is not valid.";
                        }
                    }
                } else {

                    $email_err = "No account found with that email.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/css.css">
</head>

<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>
</body>

</html>