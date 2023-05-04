<?php
require_once ('./db/ProductsDB.php');
$db = new ProductsDB();
$submittedForm = !empty($_POST);
if ($submittedForm) {
    $pdo = $db -> pdo;
    $sql = "UPDATE `products` SET `name`= :name,`description`= :description,`price`= :price,`category_id`= :categoryID WHERE `product_id` = :productID";
    $statement = $pdo -> prepare($sql);
    $statement -> execute([
        'productID' => $_GET['productID'],
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'categoryID' => $_POST['categoryID']
    ]);
}

?>

<body>
    <form method = "POST" action = 'edit.php?productID=<?php echo $_GET['productID']; ?>'>
        <h3>Name:
        <input type = 'text' name = 'name'>
        <h3>Description:
        <input type = 'text' name = 'description'>
        <h3>Price:
        <input type = 'number' name = 'price'>
        <h3>Category ID:
        <input type = 'number' name = 'categoryID'>
        <br>
        <input type = 'submit'>
    </form>
</body>