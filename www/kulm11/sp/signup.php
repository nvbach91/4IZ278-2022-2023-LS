<?php require_once "./database/UsersDatabase.php" ?>
<?php
if (isset($_COOKIE["username"])) {
    header("Location: ./index.php");
    exit;
}
?>
<?php require "./checks/signupCheck.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Signup</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./signup.php">Sign up</a></li>
                <li><a href="./login.php">Login</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="./signup.php" method="POST" id="signupForm">
            <label>E-mail:</label>
            <input type="email" name="email" value=<?php echo $email;?>>
            <label>Password:</label>
            <input type="password" name="password">
            <label>Repeat password:</label>
            <input type="password" name="password2">
            <label>First name:</label>
            <input type="text" name="firstName" value=<?php echo $firstName;?>>
            <label>Last name:</label>
            <input type="text" name="lastName" value=<?php echo $lastName;?>>
            <label>City:</label>
            <input type="text" name="city" value=<?php echo $city;?>>
            <label>Street:</label>
            <input type="text" name="street" value=<?php echo $street;?>>
            <label>Building number:</label>
            <input type="number" name="buildingNo" value=<?php echo $buildingNo;?>>
            <label>Zip code:</label>
            <input type="text" name="zipCode" value=<?php echo $zipCode;?>>
            <p><a href="./login.php">Already have an account? Click here</a></p>
            <button type="submit">Signup</button>
        </form>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>