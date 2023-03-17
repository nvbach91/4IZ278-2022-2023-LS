<?php
require "includes/utils.php";
$file = "./users.db";
$sep = ";";
$email = empty($_GET['email'])?"":$_GET['email'];
if( empty($email) ){
    $email = empty($_POST['email'])?"":$_POST['email'];
}

$password = empty($_POST['password'])?"":$_POST['password'];
$success = authenticate( $email, $password );
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php" ?>
<body>
    <main class="container px-0">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="title">
                <h1>Player's Login</h1>
            </div>
            <div class="mx-0">
                <label class="form-label">Email address</label>
                <input name="email" class="form-control" value="<?php echo $email ?>">
            </div>
            <div class="mx-0">
                <label class="form-label">Password</label>
                <input name="password" class="form-control" value="<?php echo $password ?>">
            </div>
            <label></label>
            <div class="d-grid gap-2">
                <input class="<?php echo $success?"btn btn-success":"btn btn-danger" ?>" type="submit" value=<?php echo $success?"Success!":"Login" ?>>
            </div>
        </form>
    </main>
</body>
</html>
