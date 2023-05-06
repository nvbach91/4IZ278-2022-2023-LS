<?php
session_start();
include('database.php');
if (!isset($_SESSION['login']) && $_SESSION['privilege'] == 0) {
    header('Location: login.php');
}

$special = 0;

$stmt = $pdo->prepare("SELECT `edit` FROM `products` WHERE `product_id` = ?");
$stmt->execute([$_GET['id']]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$new_result = $result['edit'];

if (isset($_POST['submit'])) {

    $stmt = $pdo->prepare("UPDATE `products` SET `name` = ?,`price` = ?, `special` = ?, `image` = ?, `edit` = 0  WHERE `products`.`product_id` = ?");
    $stmt->execute([$_POST['name'], $_POST['price'], $special, $_POST['image'], $_GET['id']]);
    header('Location: index.php');
}

if (isset($_POST['index']) or isset($_POST['submit'])) {
    $stmt = $pdo->prepare("UPDATE `products` SET `edit` = 0  WHERE `products`.`product_id` = ?");
    $stmt->execute([$_GET['id']]);
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
    <?php
    if (is_array($result)) {
        if ($new_result == 0) {
            $stmt = $pdo->prepare("UPDATE `products` SET `edit` = ? WHERE `products`.`product_id` = ?");
            $stmt->execute([$_SESSION['user_id'], $_GET['id']]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        }
        if ($new_result == $_SESSION['user_id'] || $new_result == 0) {

    ?>

            <form method="post">
                <label for="name">Name:</label>
                <input type="text" name='name' placeholder="new name..." value="<?php echo $_GET['name']; ?>">
                <label for="price">Price:</label>
                <input type="text" name='price' placeholder="new price..." value="<?php echo $_GET['price']; ?>">
                <label for="special">Action product:</label>
                <?php
                if (isset($_GET['special'])) {
                    if ($_GET['special'] == 1) {
                        $special = 1;
                        echo '<input type="checkbox" name="special" checked>';
                    } else {
                        $special = 0;
                        echo '<input type="checkbox" name="special">';
                    }
                } else {
                    echo '<input type="checkbox" name="special">';
                }        ?>

                <label for="image">Image:</label>
                <input type="text" name='image' placeholder="new image..." value="<?php echo $_GET['image']; ?>">

                <input type="submit" name='submit' value="submit">
                <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
            </form>
            <form method="POST">
                <button type="submit" name="index">Go to Index</button>
            </form>

        <?php
        } else {
        ?>

            <p>THIS PRODUCT IS BEING EDITED RIGHT NOW, PLEASE WAIT...</p>
            <a href="index.php">Go to index</a>
    <?php
        }
    }
    ?>
</body>

</html>