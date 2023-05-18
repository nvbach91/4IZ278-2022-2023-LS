<?php
session_start();
include('database.php');
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}
$special = 0;

if (isset($_POST['submit'])) {

    $stmt = $pdo->prepare("UPDATE `products` SET `name` = ?,`price` = ?, `special` = ?, `image` = ?  WHERE `products`.`product_id` = ?");
    $stmt->execute([$_POST['name'], $_POST['price'], $special, $_POST['image'], $_GET['id']]);
    header('Location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit product</title>
</head>

<body>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" name='name' placeholder="new name..." value="<?php echo $_GET['name']; ?>">
        <label for="price">Price:</label>
        <input type="text" name='price' placeholder="new price..." value="<?php echo $_GET['price']; ?>">
        <label for="special">Action product:</label>
        <?php if ($_GET['special'] == 1) {
            $special = 1;
            echo '<input type="checkbox" name="special" checked>';
        } else {
            $special = 0;
            echo '<input type="checkbox" name="special">';
        }
        ?>

        <label for="image">Image:</label>
        <input type="text" name='image' placeholder="new image..." value="<?php echo $_GET['image']; ?>">

        <input type="submit" name='submit' value="submit">
        <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
    </form>
    <a href="index.php">Back to the main site</a>
</body>

</html>