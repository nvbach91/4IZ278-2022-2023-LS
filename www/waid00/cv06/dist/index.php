<?php
include_once "database.php";
try {
    $stmt = $pdo->query('SELECT * FROM categories');
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
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
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/slider.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(function() {
            $('.fadein img:gt(0)').hide();
            setInterval(function() {
                $('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');
            }, 5000);
        });
    </script>
</head>

<body>
    <?php include_once("nav.php"); ?>
    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Shop in style</h1>
                <p class="lead fw-normal text-white-50 mb-0">Action offers below:</p>
            </div>
            <div class="fadein">
                <?php
                // Fetch special products from database
                $stmt = $pdo->prepare("SELECT * FROM products WHERE special = 1");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Loop through the products and display images
                foreach ($products as $product) {
                    echo '<img src="' . $product['image'] . '" alt="' . $product['name'] . '">';
                }
                ?>
            </div>
        </div>
    </header>
    <!-- Section-->
    <?php
    try {
        // Assuming $pdo is your PDO connection object
        if (!isset($_GET['id'])) {
            $stmt = $pdo->prepare('SELECT * FROM products');
        } else {
            $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = :category_id');
            $stmt->bindParam(':category_id', $_GET['id']); // Bind the value of $_GET['id'] to the :category_id placeholder
        }
        $stmt->execute(); // Execute the prepared statement
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the results as an associative array
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    include_once "ProductDisplay.php";
    ?>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>