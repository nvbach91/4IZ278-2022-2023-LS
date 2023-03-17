<?php
require "includes/utils.php";

$sep = ";"; ##CSV separator
$errors = [];
$name = empty( $_POST["name"] )?"":htmlspecialchars( trim( $_POST["name"] ) );
if( empty( $name ) && !str_contains( $name, $sep ) ){
    array_push( $errors, "Name is empty." );
}

$email = empty( $_POST["email"] )?"":htmlspecialchars( trim( $_POST["email"] ) );
if( !preg_match( "/^[a-z0-9]+@[a-z0-9]+\.[a-z0-9]{1,3}$/", $email ) && !str_contains( $email, $sep ) ){
    array_push( $errors, "Email is not valid." );
}

$password = empty( $_POST["password"] )?"":htmlspecialchars( trim( $_POST["password"] ) );
if( !preg_match( "/^[^$sep]{9,}$/", $password ) ){
    array_push( $errors, "Password must be at least 9 characters long and must not contain \"$sep\"" );
}

$cpassword = empty( $_POST["cpassword"] )?"":htmlspecialchars( trim( $_POST["cpassword"] ) );
if( $password != $cpassword ){
    array_push( $errors, "Password and Check Password must be equal" );
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
if( empty( $_POST["avatar"] ) && !str_contains( $email, $sep ) ){
    array_push( $errors, "Avatar is not valid" );
}

if( empty($errors) ){
    $record = "$name$sep$email$sep$password$sep$phone$sep$gender$sep$avatar";
    if( registerNewUser( $record ) ){
        header( "Location: login.php?email=$email" );
    } else {
        array_push( $errors, "User already in database!" );
    }
}
?>

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