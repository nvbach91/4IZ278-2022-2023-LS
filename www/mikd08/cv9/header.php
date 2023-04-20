<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
    <nav class="nav nav-pills flex-column flex-sm-row" style="background-color: black;">
        <a class="flex-sm-fill text-sm-center nav-link" href="index.php">Home</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="login.php">Log in</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="cart.php">Cart</a>
        <a class="flex-sm-fill text-sm-center nav-link" href="create.php">Create</a>
        <?php if (isset($_COOKIE["user"])): ?>
            <a class="flex-sm-fill text-sm-center nav-link" href="logout.php">Log out</a>
            <span style='color:red; font-size:1.5em'>Logged in as: <?php echo $_COOKIE["user"] ?></span>";
        <?php endif?>
    </nav>
