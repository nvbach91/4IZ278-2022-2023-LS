<?php require_once './db/Database.php';
session_start();

$db = new Database();
if (!empty($_GET)) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM `cv06_products` WHERE `product_id` = :productID";
    $statement = $db -> pdo -> prepare($sql);
    $statement -> execute([
        'productID' => $_GET['id']
    ]);
    
    $product = $statement -> fetchAll()[0];
    if (!$product) {
        exit();
    }

    if (isset($product['last_edit_by']) && time() - strtotime($product['last_edit']) < 60 * 5 && $_SESSION['user_id'] != $product[0]['last_edit_by']) {
        echo 'This product in currently being edited by someone else.';
        exit();
    }

    $db->pessimisticEdit($id, $_COOKIE['name'] ? $_COOKIE['name'] : 0);
}

if ('POST' == $_SERVER['REQUEST_METHOD']) {

    $name = @$_POST['name'];
    $price = @$_POST['price'];
    $categoryID = @$_POST['category'];
    $discount = @$_POST['discount'];

    $sql = "UPDATE `cv06_products` SET `name`= :name, `price`= :price, `category_id`= :categoryID, `discount`= :discount WHERE `product_id` = :id";
    $stmt = $db->pdo->prepare($sql);
    $stmt->execute([
       'id' => $_GET['id'],
       'name' => $name,
       'price' => $price,
       'categoryID' => $categoryID,
       'discount' => $discount
    ]);

    echo 'Product info successfully updated.';
}

$_SESSION[$product['product_id'] . '_last_edit'] = $product['last_edit'] ? $product['last_edit'] : "";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<?php require 'header.php'; ?>
<body>
    <form method="POST">
         <div class="form-group">
            <label for="name">Product Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name" value=<?php echo $product['name']; ?>>
         </div>
         <div class="form-group">
            <label for="name">Price</label>
            <input class="form-control" id="name" name="price" placeholder="Price" value=<?php echo $product['price']; ?>>
         </div>
         <div class="form-group">
            <label for="name">Category</label>
            <input class="form-control" id="name" name="category" placeholder="Category" value=<?php echo $product['category_id']; ?>>
         </div>
         <div class="form-group">
            <label for="name">Discount</label>
            <input class="form-control" id="name" name="discount" placeholder="Discount" value=<?php echo $product['discount']; ?>>
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
</form>
</body>
</html>
