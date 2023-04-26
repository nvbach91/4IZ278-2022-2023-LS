<?php
session_start();
require_once('../database/loadData.php');

include('../components/header.php');

if (isset($_POST['edit']) || isset($_POST['copy'])) {
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
} else {
    $category_id = '';
    $name = '';
    $image = '';
}


?>


<div class="card w-100 shadow-lg my-5 rounded" style="width: 18rem;">
    <div class="card-header py-3 text-bg-dark">

    </div>
    <div class="card-body text-dark">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <h3 class="text-center">Editor produktu</h3>
                <form method="GET" action="insertCategory.php">
                    <div class="form-group mb-3">
                        <label for="name">Název</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="avatar">Obrázek</label>
                        <input type="text" class="form-control" id="image" name="image" value="<?php echo $image ?>" onchange="previewImage()">

                        <div id="image-preview-container" class="mt-2">
                            <img id="image-preview" src="<?php echo $image ?>">
                        </div>
                    </div>

                    <input type="hidden" name="action" value="<?php echo (isset($_POST['edit'])) ? 'edit' : 'insert' ?>">
                    <input type="hidden" name="category_id" value="<?php echo $category_id ?>">


                    <button type="submit" class="btn btn-primary btn-block"><?php echo (isset($_POST['edit'])) ? "Upravit kategorii" : "Vložit novou kategorii" ?></button>
                    <a href="databaseManager.php?database=categories" class="btn btn-danger btn-block">Zrušit úpravy</a>
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