<?php
session_start();
//error_reporting(E_ALL & ~E_WARNING);
include('database.php');

// Redirect if user is not logged in or does not have sufficient privilege
if (!isset($_SESSION['login']) || $_SESSION['privilege'] == 0) {
    header('Location: login.php');
}
// Get the product ID from the URL parameter
$productID = $_GET['id'];
if (!isset($_SESSION['data_fetched'])) {
    // Fetch the current editopt value for the product
    $stmt = $pdo->prepare("SELECT `editopt` FROM `products` WHERE `product_id` = ?");
    $stmt->execute([$productID]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['currentEditOpt'] = $result['editopt'];
    $_SESSION['currentEditOpt']++;
    $_SESSION['newEditOpt'] = $_SESSION['currentEditOpt'];
    $_SESSION['currentEditOpt']--;
    $_SESSION['data_fetched'] = true;
}

if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("SELECT `editopt` FROM `products` WHERE `product_id` = ?");
    $stmt->execute([$productID]);
    $find = $stmt->fetch(PDO::FETCH_ASSOC);
    $futureEditOpt = $find['editopt'];

    if ($_SESSION['currentEditOpt'] == $find['editopt']) {

        $name = $_POST['name'];
        $price = $_POST['price'];
        $special = isset($_POST['special']) ? 1 : 0;
        $image = $_POST['image'];

        $stmt = $pdo->prepare("UPDATE `products` SET `name` = ?, `price` = ?, `special` = ?, `image` = ?, `editopt` = ? WHERE `product_id` = ?");
        $stmt->execute([$name, $price, $special, $image, $_SESSION['newEditOpt'], $productID]);


        unset($_SESSION['data_fetched']);
        unset($_SESSION['newEditOpt']);
        unset($_SESSION['currentEditOpt']);

        header('Location: index.php');
        exit();
    } else {
        $error = "Someone submitted their edit of the product before you, so your change did not go through. Redirecting to the main site in 5 seconds...";
        unset($_SESSION['data_fetched']);
        unset($_SESSION['newEditOpt']);
        unset($_SESSION['currentEditOpt']);

        header('refresh:5;url=index.php');
    }
}


if (isset($_POST['index'])) {

    $stmt = $pdo->prepare("UPDATE `products` SET `editopt` = COALESCE(?, `editopt`) WHERE `product_id` = ?");
    $stmt->execute([$currentEditOpt, $productID]);

    unset($_SESSION['data_fetched']);

    header('Location: index.php');
    exit();
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
        }
        ?>

        <label for="image">Image:</label>
        <input type="text" name='image' placeholder="new image..." value="<?php echo $_GET['image']; ?>">

        <input type="submit" name='submit' value="submit">
        <p style="color: red;"><?php echo isset($error) ? $error : ''; ?></p>
    </form>

    <form method="POST">
        <button type="submit" name="index">Go to Index</button>
    </form>
</body>

</html>