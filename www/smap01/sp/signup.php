<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/database/UsersDB.php'; ?>

<?php

//Verifies user input and if successful creates a user record effectively registering the user. If successful logs user in otherwise display error display
if (!empty($_POST) && isset($_POST['email']) && isset($_POST['password'])) {
    $database = UsersDB::getDatabase();
    if (!$database->userExists($_POST['email'])) {
        $verificationResult = verifyInput($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password_ver']);
        if (strlen($verificationResult) == 0) {
            $result = $database->registerUser($_POST['name'], $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['address']);
            if ($result == null) {
                setcookie("user_email", $_POST['email'], time() + 3600);
                $_SESSION['logged_in'] = 1;
                header('Location:http://' . $_SERVER['SERVER_NAME'] . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
                exit;
            } else {
                echo $result;
            }
        } else {
            echo "<div style='background-color:red;color:white;text-align:center;'><a>" . $verificationResult . ".</a></div>";
        }
    } else {
        echo "<div style='background-color:red;color:white;text-align:center;'><a>User with this email address already exists.</a></div>";
    }
} else if (!empty($_POST)) {
    echo "<div style='background-color:red;color:white;text-align:center;'><a>Check the input fields.</a></div>";
}


function verifyInput($name, $email, $password, $password_ver)
{
    $result = "";
    $namePattern = "/^(([a-zA-ZÁÉÍÓÚÝÄČĎĚÏŇÖŘŠŤÜÛÝŽáéíóúýäčďěïňöřšťüûýž]+)( )?)+$/";
    if (preg_match($namePattern, $name) == 0) {
        $result .= "Name is in incorrect format.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result .= "\nEmail is in incorrect format.";
    }
    if (strlen($password) < 6) {
        $result .= "\nPassword should be at least six characters.";
    }
    if (strcmp($password, $password_ver) != 0) {
        $result .= "\nPasswords do not match.";
    }
    return $result;
}


?>

<body>
    <div style="margin-left:auto;margin-right:auto;width:60%;max-width:300px;">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1 style="text-align:center;padding-bottom:30px;">Sign up page</h1>
            <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="name" type="text" placeholder="Name">
            <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="email" type="email" placeholder="Email">
            <div class="signup-2c">
                <div class="signup-1c">
                    <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="password" type="password" placeholder="Password">
                    <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="password_ver" type="password" placeholder="Verify password">
                    <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="address" type="text" placeholder="Address">
                </div>
                <button class="btn" style="display:block;margin-left:auto;margin-right:auto;">Sign up</button>
            </div>
        </form>
    </div>
</body>
<?php require_once __DIR__ . '/incl/footer.php'; ?>