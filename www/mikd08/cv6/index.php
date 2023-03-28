<?php
    require "Products.php";
    require "Categories.php";
    
    // $products = [
    //     ['name' => 'Tommy Atkins', 'price' => 49.90, 'img' => 'https://www.mango.org/wp-content/uploads/2017/11/kent-variety.jpg'],
    //     ['name' => 'Ataulfo',      'price' => 60.90, 'img' => 'http://elbefruit.eu/wp-content/uploads/2018/07/tommy-variety-1.jpg'],
    //     ['name' => 'Kent',         'price' => 47.90, 'img' => 'https://media.mercola.com/assets/images/foodfacts/mango-nutrition-facts.jpg'],
    //     ['name' => 'Haden',        'price' => 51.90, 'img' => 'https://images-na.ssl-images-amazon.com/images/I/21jivLJsAeL.jpg'],
    //     ['name' => 'Keitt',        'price' => 39.90, 'img' => 'http://betterhomegardening.com/wp-content/uploads/2015/05/pakistan-Ataulfo-mango.jpg'],
    //     ['name' => 'Francine',     'price' => 59.90, 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStvS-QHWIlsLILy-fIIGXcxlb2jUIrXNDjKXs4eLbSJt4gJKLu'],
    // ];

    $productsDB = new Products();
    if (isset($_GET["category_id"])) {
        $category_id = $_GET["category_id"];
        $products = $productsDB->fetchByCategory($category_id);
    } else {
        $products = $productsDB->fetchAll();
    }

    $categoriesDB = new Categories();
    $categories = $categoriesDB->fetchAll();
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
        <link href="style.css" rel="stylesheet" />

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
        <?php require "productsHTML.php" ?>
    </body>
</html>
