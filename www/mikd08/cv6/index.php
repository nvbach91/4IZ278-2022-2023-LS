<?php
    require "Products.php";
    require "Categories.php";
    require "Slides.php";

    $productsDB = new Products();
    if (isset($_GET["category_id"])) {
        $category_id = $_GET["category_id"];
        $products = $productsDB->fetchByCategory($category_id);
    } else {
        $products = $productsDB->fetchAll();
    }

    $categoriesDB = new Categories();
    $categories = $categoriesDB->fetchAll();

    $slidesDB = new Slides();
    $slides = $slidesDB->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Shop Homepage - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="https://bootswatch.com/4/journal/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" defer></script>
    </head>
    <body>
        <!-- Navigation-->
        <?php require "categoriesHTML.php" ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
                </div>
            </div>
        </header>
        
        <!-- Section-->
        <?php require "slidesHTML.php" ?>
        <?php require "productsHTML.php" ?>


        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <!-- Popper.js -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <!-- Bootstrap 4.3.0 JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.0/js/bootstrap.min.js"></script>
    </body>
</html>
