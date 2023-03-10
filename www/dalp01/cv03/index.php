<?php
$errors = [];

$name = empty( $_POST["name"] )?"":htmlspecialchars( trim( $_POST["name"] ) );
if( empty( $_POST["name"] ) ){
    array_push( $errors, "Name is empty." );
}

$email = empty( $_POST["email"] )?"":htmlspecialchars( trim( $_POST["email"] ) );
/*if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
    array_push( $errors, "Email is not valid (via FILTER)" );
}*/
if( !preg_match( "/^[a-z0-9]+@[a-z0-9]+\.[a-z0-9]{1,3}$/", $email ) ){
    array_push( $errors, "Email is not valid." );
}

$phone = empty( $_POST["phone"] )?"":htmlspecialchars( trim( $_POST["phone"] ) );
if( !preg_match( "/^\d{9}$/", $phone ) ){
    array_push( $errors, "Phone is not valid. Must contain 9 numbers" );
}

$gender = empty( $_POST["gender"] )?"N":$_POST["gender"];
if( !preg_match( "/^[FMO]$/", $gender ) ){
    array_push( $errors, "Gender is not valid, must be M, F or O" );
}

$avatar = empty( $_POST["avatar"] )?"":htmlspecialchars( trim( $_POST["avatar"] ) );
/*if( filter_var( $avatar, FILTER_VALIDATE_URL ) ){
    array_push( $errors, "Avatar is not valid" );
}*/
?>

<!DOCTYPE html>
<html lang="en">
<?php include "includes/head.php" ?>
<body>
    <main class="container px-0">
        <div class="title">
            <h1>Player's Registration Form</h1>
        </div>
        <div class="container px-0">
            <?php include "includes/registration-form.php" ?>
            <?php if( !empty($errors) ): ?>
                <div class="mx-0">
                    <h4>Problems detected:</h4>
                    <?php foreach( $errors as $error ): ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>