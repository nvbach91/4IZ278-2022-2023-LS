<div id="addCategory" class="overlay">
    <form action="addCategory.php" method="POST">
        <h1>New category</h1>
        <input type="text" name="category_name" placeholder="category name">
        <button type="submit" name="add_category">Add</button>
    </form>
</div>

<div id="addProduct" class="overlay">
    <form action="addProduct.php" method="POST">
        <h1>New product</h1>
        <input type="text" name="name" placeholder="name" required>
        <input type="number" name="price" placeholder="price" required>
        <input type="text" name="pic" placeholder="picture url" required>
        <input type="text" name="category" placeholder="category" required>
        <button type="submit" name="add_product">Add</button>
    </form>
</div>

<div id="editProduct" class="overlay">
    <form action="editProduct.php" method="POST" id="editProductForm">
        <h1>Edit Product</h1>
        <input type="number" name="product_id" style="display:none;" required>
        <input type="text" name="name" placeholder="name" required>
        <input type="number" name="price" placeholder="price"  required>
        <textarea name="img" placeholder="image URL" cols="23" rows="8"></textarea>
        <input type="text" name="category" placeholder="category" required>
        <button type="submit" name="edit_product">Edit</button>
    </form>
</div>
