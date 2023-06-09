<?php require_once 'CategoriesDatabase.php';?>
<?php
$categoriesDatabase = new CategoriesDatabase();
$categories = $categoriesDatabase->fetchAll();
?>
<?php require 'header.php'; ?>
        <section style="width: 40%;display: table;margin: auto;" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Add item</h1>
            <form action="add.php" method="POST">
                <label for="">Name</label>
                <input name="name" value="">
                <label for="">Price</label>
                <input name="price" value="">
                <label for="">Description</label>
                <input name="description" value="">
                <label for="">Image URL</label>
                <input name="img" value="">
                <label for="">Category</label>
                <select name="category_id">
                <?php foreach($categories as $category):?>
                    <option value="<?php echo $category['category_id'];?>"><?php echo $category['name'];?></option>
                <?php endforeach;?>
                </select>
                <button>Add</button>
            </form>
        </section>
<?php require 'footer.php'; ?>