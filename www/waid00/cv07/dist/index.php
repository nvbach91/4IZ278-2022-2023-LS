<?php
session_start();
include_once "database.php";
if (!isset($_SESSION['login'])) {
    header('Location: login.php');
}

if (isset($_POST['cart'])) {
    header('Location: cart.php');
}
if (isset($_GET['add'])) {

    $product_id = $_GET['add'];

    $stmt = $pdo->prepare("INSERT INTO orders (date, discount, user_id, product_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([date('Y-m-d H:i:s'), 0, $_SESSION['id'], $product_id]);

    echo "Product added to cart successfully!";
    header('Location: index.php');
}

$limit = 5;

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT COUNT(*) as total FROM products";
$stmt = $pdo->query($sql);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$total_products = $row['total'];
$total_pages = ceil($total_products / $limit);

try {
    $stmt = $pdo->query('SELECT * FROM categories');
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}

$username = $_SESSION['login'];
$query = "SELECT COUNT(o.order_id) AS order_count
          FROM orders o
          LEFT JOIN products p ON o.product_id = p.product_id
          LEFT JOIN categories c ON p.category_id = c.category_id
          LEFT JOIN users u ON o.user_id = u.user_id
          WHERE u.name = :username";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Eshop</title>
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
                $stmt = $pdo->prepare("SELECT * FROM products WHERE special = 1");
                $stmt->execute();
                $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        if (!isset($_GET['id'])) {
            $sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        } else {
            $stmt = $pdo->prepare('SELECT * FROM products WHERE category_id = :category_id LIMIT :limit OFFSET :offset');
            $stmt->bindParam(':category_id', $_GET['id']);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        }
        $stmt->execute();
        $viewed_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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