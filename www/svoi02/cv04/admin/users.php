<?php require '../utils.php' ?>

<?php 
$users = fetchUsers('../users.db');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="../css/users.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Users</h1>
        <ul>
            <?php
                foreach ($users as $email => $user) {
                    echo "<li>$email</li>";
                }
            ?>
        </ul>
    </div>
</body>
</html>