<?php require_once "./database/UsersDatabase.php" ?>
<?php
if (!isset($_COOKIE["username"]) && !isset($_COOKIE["first_name"]) && !isset($_COOKIE["last_name"])) {
    header("Location: ./index.php");
    exit;
}
?>
<?php require "./checks/changeProfileCheck.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Facebook info</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="./changeProfile.php" method="POST" id="signupForm">
            <label>City:</label>
            <input type="text" name="city">
            <label>Street:</label>
            <input type="text" name="street">
            <label>Building number:</label>
            <input type="number" name="buildingNo">
            <label>Zip code:</label>
            <input type="text" name="zipCode">
            <button type="submit">Signup</button>
        </form>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>