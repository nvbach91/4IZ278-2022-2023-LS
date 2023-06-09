<?php

include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
}

if (isset($_POST['add_book'])) {

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $author = mysqli_real_escape_string($connection, $_POST['author']);
    $genre = mysqli_real_escape_string($connection, $_POST['genre']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $query = "SELECT name FROM `products` WHERE name = '$name'";
    $select_product_name = mysqli_query($connection, $query) or die('query failed');

    if (mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Book with this name already exists';
    } else {
        $query = "INSERT INTO `products`(name, author, genre, price, image) 
        VALUES ('$name', '$author','$genre', '$price', '$image')";
        $add_product_query = mysqli_query($connection, $query) or die('query failed');

        if ($add_product_query) {
            if ($image_size > 2000000) {
                $message[] = 'Image size is too big';
            } else {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Book was added successfully';
            }
        } else {
            $message[] = 'Book was not added';
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $query_delete = "SELECT image FROM `products` WHERE id = '$delete_id'";
    $delete_image_query =
        mysqli_query($connection, $query_delete) or die('query failed');;
    $query = "DELETE FROM `products` WHERE id=' $delete_id'";
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('../uploaded_img/') . $fetch_delete_image['image'];
    mysqli_query($connection, $query) or die('query failed');
    header('location:admin_products.php');
}

if (isset($_GET['update_product'])) {
    $update_product_id = $_POST['update_product_id'];
    $update_name = $_POST['update_name'];
    $update_author = $_POST['update_author'];
    $update_genre = $_POST['update_genre'];
    $update_price = $_POST['update_price'];

    $query = "UPDATE `products` SET name = '$update_name', author = '$update_author',
    genre = '$update_genre', price = '$update_price' WHERE id = '$update_product_id'";
    mysqli_query($connection, $query) or die('query failed');

    $update_image = $_FILES['update_image']['name'];
    $update_image_temp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = '../uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image size is too big';
        } else {
            $query = "UPDATE `products` SET image = '$update_image' WHERE id = '$update_product_id'";
            mysqli_query($connection, $query) or die('query failed');
            move_uploaded_file($update_image_temp_name, $update_folder);
            unlink('../uploaded_img/' . $update_old_image);
        }
    }

    header('location:.//admin_php/admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>

    <div class="window">
        <div class="logo-container">
            <div class="logo">
                <p><img alt="logo" src="../img/open-book.png"></p>
            </div>
        </div>
        <section class="add-products">
            <h1 class="title">Shop products</h1>
            <form action="" method="post" enctype="multipart/form-data">
                <h3>add product</h3>
                <input type="text" class="box" name="name" placeholder="Enter book name" required>
                <input type="text" class="box" name="author" placeholder="Enter book author" required>
                <input type="text" class="box" name="genre" placeholder="Enter book genre" required>
                <input type="number" class="box" name="price" min="0" placeholder="Enter product price" required>
                <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
                <input type="submit" class="button" name="add_book" value="add book">
            </form>

        </section>

        <section class="show-products">
            <div class="box-container">
                <?php
                $query = "SELECT * FROM `products`";
                $select_products = mysqli_query($connection, $query) or die('query failed');
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_products = mysqli_fetch_assoc($select_products)) {
                ?>
                        <div class="box">
                            <img src="../uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
                            <div class="genre"><?php echo $fetch_products['genre']; ?></div>
                            <div class="name"><?php echo $fetch_products['name']; ?></div>
                            <div class="author"><?php echo $fetch_products['author']; ?></div>

                            <div class="price">$<?php echo $fetch_products['price']; ?>/-</div>
                            <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-button">Update</a>
                            <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-button" onclick="return confirm('Delete this product?')">Delete</a>
                        </div>

                <?php
                    }
                } else {
                    echo '<p class="empty">No product added yet</p>';
                }
                ?>

            </div>
        </section>

        <section class="edit-product-form">
            <?php
            if (isset($_GET['update'])) {
                $update_id = $_GET['update'];
                $query = "SELECT * FROM `products` WHERE id = '$update_id'";
                $update_query = mysqli_query($connection, $query) or die('query failed');
                if (mysqli_num_rows($update_query) > 0) {
                    while ($fetch_update = mysqli_fetch_assoc($update_query)) {
            ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="update_product_id" value="<?php echo $fetch_update['id']; ?>">
                            <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
                            <img src="../uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
                            <input type="text" name="update_name" class="box" value="<?php echo $fetch_update['name']; ?>" required placeholder="Enter new book name">
                            <input type="text" name="update_author" class="box" value="<?php echo $fetch_update['author']; ?>" required placeholder="Enter new book author">
                            <input type="text" name="update_genre" class="box" value="<?php echo $fetch_update['genre']; ?>" required placeholder="Enter new book genre">
                            <input type="number" min="0" name="update_price" class="box" value="<?php echo $fetch_update['price']; ?>" required placeholder="Enter new book price">
                            <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
                            <input type="submit" value="update" name="update_product" class="button">
                            <input type="reset" value="cancel" id="close-update" class="option-button">
                        </form>
            <?php
                    }
                }
            } else {
                echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
            }
            ?>
        </section>
    </div>

    <script src="../js/admin_script.js"></script>
</body>

</html>