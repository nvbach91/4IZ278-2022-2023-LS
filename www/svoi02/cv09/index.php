<?php
if(isset($_GET['msg'])) {
    $message = $_GET['msg'];
}

if(isset($_GET['delete'])) {
    $deleteMsg = $_GET['delete'];
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
    </head>
    <body>
        <!-- Navigation-->
        <?php require './CategoryDisplay.php'; ?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <?php require './SlideDisplay.php' ?>
                </div>
            </div>
        </header>
        <?php if (isset($_GET['msg']) || isset($_GET['delete'])) : ?>
            <div class=<?php echo isset($deleteMsg) ? "error-container": "success-container" ;?>>
                <?php echo isset($deleteMsg) ? $deleteMsg : $message ?>
            </div>
        <?php endif; ?>
        <section>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <a class="btn btn-outline-dark login" href="./create-item.php">Create product</a>
                </div>
            </div>
        </section>
        <!-- Section-->
        <?php require './ProductDisplay.php'; ?>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
