<?php require './db.php'; ?>
<?php


session_start();
require './admin_required.php';
if (!isset($_GET['id'])) {
    exit('no id specified');
}
if (!empty($_GET)) {
    $id = $_GET['id'];

    $statement = $db->prepare("
        SELECT * FROM products WHERE id = :id;
    ");
    $statement->execute([
        'id' => $id,
    ]);
    $products = $statement->fetchAll();

    if (count($products) < 1) {
        exit('No product found');
    }

    $product = $products[0];

    $name = $product['name'];
    $img = $product['img'];
    $price = $product['price'];
    $description = $product['description'];
}

if (!empty($_POST)) {
    $name = $_POST['name'];
    $img = $_POST['img'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $id = $_GET['id'];

    $statement = $db->prepare("
        UPDATE products
            SET name = :name,
                img = :img,
                price = :price,
                description = :description
            WHERE id = :id;
    ");
    $executionResult = $statement->execute([
        'name' => $name,
        'img' => $img,
        'price' => $price,
        'description' => $description,
        'id' => $id,
    ]);

    if ($executionResult) {

    } else {

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST">
        <input value="<?php echo @$name; ?>" name="name" placeholder="name">
        <input value="<?php echo @$price; ?>" name="price" placeholder="price">
        <input value="<?php echo @$img; ?>" name="img" placeholder="img">
        <input value="<?php echo @$description; ?>" name="description" placeholder="description">

        <button>Submit</button>
    </form>
</body>

</html>