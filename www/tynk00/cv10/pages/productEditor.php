<?php
session_start();
require_once('../database/loadData.php');

include('../components/header.php');

if (isset($_POST['edit']) || isset($_POST['copy'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $setCategory = $_POST['category'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $description = $_POST['description'];
} else {
    $product_id = '';
    $name = '';
    $setCategory = 1;
    $price = '';
    $image = '';
    $description = '';
}


?>


<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">

    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Editor produktu</h3>
                <form method="GET" action="insertProduct.php">
                    <div class="form-group mb-3">
                        <label for="name">Název</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Kategorie</label>
                        <select class="form-select" name="category">
                            <?php foreach ($categoriesDatabase->fetchAll() as $category) : ?>
                                <option value="<?php echo $category['category_id'] ?>" <?php echo ($category['category_id'] == $setCategory) ? 'selected' : '' ?>><?php echo $category['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="price">Cena</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Obrázek</label>
                        <input type="text" class="form-control" id="image" name="image" value="<?php echo $image ?>" onchange="previewImage()">

                        <div id="image-preview-container" class="mt-2">
                            <img id="image-preview" src="<?php echo $image ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Popis produktu</label>
                        <textarea name="description" class="form-control" rows="4" cols="50"><?php echo $description ?></textarea>
                    </div>

                    <input type="hidden" name="action" value="<?php echo (isset($_POST['edit'])) ? 'edit' : 'insert' ?>">
                    <input type="hidden" name="product_id" value="<?php echo $product_id ?>">


                    <button type="submit" class="btn btn-primary btn-block"><?php echo (isset($_POST['edit'])) ? "Upravit produkt" : "Vložit nový produkt" ?></button>
                    <a href="databaseManager.php?database=products" class="btn btn-danger btn-block">Zrušit úpravy</a>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    #image-preview-container {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100px;
        height: 100px;
        overflow: hidden;
    }

    #image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>

<script>
    function previewImage() {
        var input = document.getElementById('image');
        var url = input.value;
        var preview = document.getElementById('image-preview');
        if (url) {
            preview.onerror = function() {
                preview.src = '../img/avatar-placeholder.jpeg';
            };
            preview.src = url;
        } else {
            preview.src = '../img/avatar-placeholder.jpeg';
        }
    }
</script>

<?php

include('../components/footer.php');

?>