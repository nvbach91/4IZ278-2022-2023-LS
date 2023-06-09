<?php require_once 'ProductsDatabase.php';?>
<?php
session_start();
$productsDatabase = new ProductsDatabase();
if(!empty($_GET)){
    $record = $productsDatabase->getRecordById($_GET['product_id']);
}
    
?>
<?php require 'header.php'; ?>
        <section style="width: 40%;display: table;margin: auto;" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Edit item</h1>
            <form action="edit.php?product_id=<?php echo $record['product_id'];?>" method="POST">
                <label for="">Name</label>
                <input name="name" value="<?php echo $record['name'];?>">
                <label for="">Price</label>
                <input name="price" value="<?php echo $record['price'];?>">
                <label for="">Description</label>
                <input name="description" value="<?php echo $record['description'];?>">
                <label for="">Image URL</label>
                <input name="img" value="<?php echo $record['img'];?>">
                <select name="category_id">
                    <option value="1" <?php if($record['category_id']==1)echo 'selected';?>>Basketball</option>
                    <option value="2" <?php if($record['category_id']==2)echo 'selected';?>>Football</option>
                    <option value="3" <?php if($record['category_id']==3)echo 'selected';?>>Hockey</option>
                    <option value="4" <?php if($record['category_id']==4)echo 'selected';?>>MMA</option>
                    <option value="5" <?php if($record['category_id']==5)echo 'selected';?>>Tennis</option>
                </select>
                <button>Edit</button>
            </form>
        </section>
<?php require 'footer.php'; ?>