<?php require_once './ProductsDatabase.php';?>
<?php
session_start();
$productsDatabase = new ProductsDatabase();
if(!empty($_GET)){
    $record = $productsDatabase->getRecordById($_GET['good_id']);
}
    
?>
<?php require './header.php'; ?>
        <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>Edit item</h1>
            <form action="./edit.php?good_id=<?php echo $record['good_id'];?>" method="POST">
                <p>Name</p>
                <input name="name" value="<?php echo $record['name'];?>">
                <p>Price</p>
                <input name="price" value="<?php echo $record['price'];?>">
                <button>Edit</button>
            </form>
        </section>
<?php require './footer.php'; ?>