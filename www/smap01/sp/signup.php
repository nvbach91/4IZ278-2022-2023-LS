<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php require_once __DIR__ . '/database/Database.php'; ?>

<?php

if (!empty($_POST) && isset($_POST['email']) && isset($_POST['password'])) {
    $database = new Database();
    if (!$database->userExists($_POST['email'])) {
        $result = $database->registerUser($_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT));
        if($result==null){
            setcookie("user_email", $_POST['email'], time()+3600);
            $_SESSION['logged_in']=1;
            header('Location:http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/')));
            exit;
        }
    } else {
        echo "<div style='background-color:red;color:white;text-align:center;'><a>User with this email address already exists.</a></div>";
    }
} else if (!empty($_POST)) {
    echo "<div style='background-color:red;color:white;text-align:center;'><a>Check the input fields.</a></div>";
}


?>

<body>
    <div style="margin-left:auto;margin-right:auto;width:60%;max-width:300px;">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <h1 style="text-align:center;padding-bottom:30px;">Sign up page</h1>
            <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="email" type="email" placeholder="Email">
            <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="password" type="password" placeholder="Password">
            <button class="btn" style="display:block;margin-left:auto;margin-right:auto;">Sign up</button>
        </form>
    </div>
</body>
<?php require_once __DIR__ . '/incl/footer.php'; ?>