<div id="addCategory" class="overlay">
    <form id="addCategoryForm">
        <h1>New category</h1>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <input type="text" name="category_name" placeholder="category name" required>
        <button type="submit" name="add_category">Add</button>
    </form>
</div>

<div id="addProduct" class="overlay">
    <form id="addProductForm">
        <h1>New product</h1>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <input type="text" name="name" placeholder="name" required>
        <input type="number" name="price" placeholder="price" required>
        <input type="text" name="img" placeholder="img url" required>
        <input type="text" name="category" placeholder="category" required>
        <button type="submit" name="add_product">Add</button>
    </form>
</div>

<div id="editProduct" class="overlay">
    <form id="editProductForm">
        <h1>Edit Product</h1>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <input type="hidden" name="product_id" required>
        <input type="text" name="name" placeholder="name" required>
        <input type="number" name="price" placeholder="price"  required>
        <textarea name="img" placeholder="image URL" cols="23" rows="8" required></textarea>
        <input type="text" name="category" placeholder="category" required>
        <button type="submit" name="edit_product">Edit</button>
    </form>
</div>
