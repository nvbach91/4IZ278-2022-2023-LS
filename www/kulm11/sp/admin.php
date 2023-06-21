<?php require_once "./database/UsersDatabase.php" ?>
<?php require_once "./database/ItemsDatabase.php" ?>
<?php
session_start();
$userDatabase = new UsersDatabase();
$users = $userDatabase->fetchAll();
$itemsDatabase = new ItemsDatabase();
$items = $itemsDatabase->fetchAll();

if (!isset($_COOKIE["username"]) || !$userDatabase->isAdmin($_COOKIE["username"])) {
    header("Location: ./login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Admin</title>
</head>

<body>
    <header>
        <?php include "./includes/logo.php" ?>
        <nav>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./admin.php">Admin</a></li>
                <li><a href="./logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main id="admin-content">
        <h2>Users</h2>
        <table>
            <tr>
                <th>E-mail</th>
                <th>First name</th>
                <th>Last name</th>
                <th>City</th>
                <th>Street</th>
                <th>Building number</th>
                <th>Zip code</th>
                <th>Role</th>
                <th\>
            </tr>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user["username"]; ?></td>
                    <td><?php echo $user["firstname"]; ?></td>
                    <td><?php echo $user["lastname"]; ?></td>
                    <td><?php echo $user["city"]; ?></td>
                    <td><?php echo $user["street"]; ?></td>
                    <td><?php echo $user["buildingno"]; ?></td>
                    <td><?php echo $user["zipcode"]; ?></td>
                    <td><?php echo $user["role"]; ?></td>
                    <td><a href="./edit.php?user_id=<?php echo $user["userid"] ?>">Edit</a></td>
                    <td><a href="./remove.php?user_id=<?php echo $user["userid"] ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><a href='./add.php?mode=user'>Add user</a></p>
        <h2>Items</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image URL</th>
                <th>Category</th>
                <th\>
            </tr>
            <?php foreach ($items as $item) : ?>
                <tr>
                    <td><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["price"]; ?></td>
                    <td><?php echo $item["description"]; ?></td>
                    <td><?php echo $item["image"]; ?></td>
                    <td><?php echo $item["category_categoryid"]; ?></td>
                    <td><a href="./edit.php?item_id=<?php echo $item["itemid"] ?>">Edit</a></td>
                    <td><a href="./remove.php?item_id=<?php echo $item["itemid"] ?>">Remove</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <p><a href='./add.php?mode=item'>Add item</a></p>
    </main>
    <?php include "./includes/footer.php" ?>
</body>

</html>