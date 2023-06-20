<?php
require_once "./database/UsersDatabase.php";
$userDatabase = new UsersDatabase();

if(!isset($_COOKIE["username"]) || !$userDatabase->isAdmin($_COOKIE["username"])){
    header("Location: ./login.php");
    exit;
}
if(isset($_GET["mode"])){
    $mode=$_GET["mode"];
    if($mode=="item"){
        require_once "./database/ItemsDatabase.php";
        require_once "./database/CategoriesDatabase.php";
        $itemsDatabase = new ItemsDatabase();
        $categoriesDatabase = new CategoriesDatabase();
        $categories = $categoriesDatabase->fetchAll();
    }
    elseif($mode=="user"){
        require_once "./UsersDatabase.php";
        $usersDatabase = new UsersDatabase();
        $mode="user";
    }
}
?>

<?php require "./checks/addCheck.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Add</title>
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
        <form action="./add.php" method="POST" id="addForm">

            <?php if($mode=="item"):?>
                <label>Name:</label>
                <input type="text" name="name">
                <label>Price:</label>
                <input type="number" name="price">
                <label>Description:</label>
                <input type="text" name="description">
                <label>Image URL:</label>
                <input type="url" name="image">
                <label>Category:</label>
                <select name="category">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category["categoryid"]; ?>"><?php echo $category["name"]; ?></option>
                    <?php endforeach;?>
                </select>
            <?php endif;?>
            <?php if($mode=="user"):?>
                <label>E-mail:</label>
                <input type="email" name="email">
                <label>Password:</label>
                <input type="password" name="password">
                <label>Repeat password:</label>
                <input type="password" name="password2">
                <label>First name:</label>
                <input type="text" name="firstname">
                <label>Last name:</label>
                <input type="text" name="lastname">
                <label>City:</label>
                <input type="text" name="city">
                <label>Street:</label>
                <input type="text" name="street">
                <label>Building number:</label>
                <input type="number" name="buildingno">
                <label>Zip code:</label>
                <input type="text" name="zipcode">
                <label>Role:</label>
                <select name="role">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                </select>
            <?php endif;?>
            <button type="submit">Add</button>
        </form>
    </main>
    <?php include "./includes/footer.php"; ?>
</body>
</html>