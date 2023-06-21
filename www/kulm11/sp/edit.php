<?php
require_once "./database/UsersDatabase.php";
$userDatabase = new UsersDatabase();

if (!isset($_COOKIE["username"]) || !$userDatabase->isAdmin($_COOKIE["username"])) {
    header("Location: ./login.php");
    exit;
}
$mode = "";
if (isset($_GET["item_id"])) {
    require_once "./database/ItemsDatabase.php";
    require_once "./database/CategoriesDatabase.php";
    $itemsDatabase = new ItemsDatabase();
    $editedItem = $itemsDatabase->fetch(htmlspecialchars($_GET["item_id"]));
    $categoriesDatabase = new CategoriesDatabase();
    $categories = $categoriesDatabase->fetchAll();
    $mode = "item";
} elseif (isset($_GET["user_id"])) {
    require_once "./database/UsersDatabase.php";
    $usersDatabase = new UsersDatabase();
    $editedUser = $usersDatabase->fetch(htmlspecialchars($_GET["user_id"]));
    $mode = "user";
}
?>

<?php require "./checks/editCheck.php" ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Edit</title>
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
    <main>
        <form action="./edit.php" method="POST" id="editForm">

            <?php if ($mode == "item") : ?>
                <input type="number" name="itemid" value="<?php echo $editedItem["itemid"] ?>" hidden>
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo $editedItem["name"] ?>">
                <label>Price:</label>
                <input type="number" name="price" value="<?php echo $editedItem["price"]; ?>">
                <label>Description:</label>
                <input type="text" name="description" value="<?php echo $editedItem["description"]; ?>">
                <label>Image URL:</label>
                <input type="url" name="image" value="<?php echo $editedItem["image"]; ?>">
                <label>Category:</label>
                <select name="category">
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?php echo $category["categoryid"]; ?>" <?php if ($editedItem["category_categoryid"] == $category["categoryid"]) echo "selected"; ?>><?php echo $category["name"]; ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>
            <?php if ($mode == "user") : ?>
                <input type="number" name="userid" value="<?php echo $editedUser["userid"] ?>" hidden>
                <label>E-mail:</label>
                <input type="email" name="email" value="<?php echo $editedUser["username"] ?>">
                <label>First name:</label>
                <input type="text" name="firstname" value="<?php echo $editedUser["firstname"] ?>">
                <label>Last name:</label>
                <input type="text" name="lastname" value="<?php echo $editedUser["lastname"] ?>">
                <label>City:</label>
                <input type="text" name="city" value="<?php echo $editedUser["city"] ?>">
                <label>Street:</label>
                <input type="text" name="street" value="<?php echo $editedUser["street"] ?>">
                <label>Building number:</label>
                <input type="number" name="buildingno" value="<?php echo $editedUser["buildingno"] ?>">
                <label>Zip code:</label>
                <input type="text" name="zipcode" value="<?php echo $editedUser["zipcode"] ?>">
                <label>Role:</label>
                <select name="role">
                    <option value="user" <?php if ($editedUser["role"] == "user") echo "selected"; ?>>user</option>
                    <option value="admin" <?php if ($editedUser["role"] == "admin") echo "selected"; ?>>admin</option>
                </select>
            <?php endif; ?>
            <button type="submit">Edit</button>
        </form>
    </main>
    <?php include "./includes/footer.php"; ?>
</body>

</html>