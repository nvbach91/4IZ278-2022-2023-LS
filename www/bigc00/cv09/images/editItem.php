<?php
require 'db/Database.php';
$name = @$_POST['name'];
$price = @$_POST['price'];
$categoryID = @$_POST['category'];
$discount = @$_POST['discount'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $db = new Database();
   $sql = "UPDATE `cv06_products` SET `name`= :name, `price`= :price, `category_id`= :categoryID, `discount`= :discount WHERE `product_id` = :id";
   $stmt = $db->pdo->prepare($sql);
   $stmt->execute([
      'id' => $_GET['id'],
      'name' => $name,
      'price' => $price,
      'categoryID' => $categoryID,
      'discount' => $discount
   ]);

   header('Location: index.php');
   exit();
}
?>
<?php require 'header.php'; ?>
   <main class="container">
      <form method="POST">
         <div class="form-group">
            <label for="name">Product Name</label>
            <input class="form-control" id="name" name="name" placeholder="Name">
         </div>
         <div class="form-group">
            <label for="name">Price</label>
            <input class="form-control" id="name" name="price" placeholder="Price">
         </div>
         <div class="form-group">
            <label for="name">Category</label>
            <input class="form-control" id="name" name="category" placeholder="Category">
         </div>
         <div class="form-group">
            <label for="name">Discount</label>
            <input class="form-control" id="name" name="discount" placeholder="Discount">
         </div>
         <button type="submit" class="btn btn-primary">Submit</button>  
      </form>
      <div style="margin-bottom: 600px"></div>
   </main>