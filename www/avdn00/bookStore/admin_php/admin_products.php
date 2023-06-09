<?php

include '../config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:./login.php');
}

if (isset($_POST['add_book'])) {
    $name = $_POST['name'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../uploaded_img/' . $image;

    $stmt = $connection->prepare("SELECT name FROM `products` WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message[] = 'Book with this name already exists';
    } else {
        $stmt = $connection->prepare("INSERT INTO `products` (name, author, genre, price, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssis", $name, $author, $genre, $price, $image);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
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
    $stmt = $connection->prepare("SELECT image FROM `products` WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image = $row['image'];
        $image_path = '../uploaded_img/' . $image;

        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $stmt = $connection->prepare("DELETE FROM `products` WHERE id = ?");
        $stmt->bind_param("i", $delete_id);
        $stmt->execute();

        header('Location: admin_products.php');
        exit();
    }
}


if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_name = $_POST['update_name'];
    $update_author = $_POST['update_author'];
    $update_genre = mysqli_real_escape_string($connection, $_POST['update_genre']);
    $update_price = $_POST['update_price'];

    $stmt = $connection->prepare("UPDATE `products` SET name=?, author=?, genre=?, price=? WHERE id=?");
    $stmt->bind_param("ssssi", $update_name, $update_author, $update_genre, $update_price, $update_p_id);
    $stmt->execute();

    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = '../uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image file size is too large';
        } else {
            $stmt = $connection->prepare("UPDATE `products` SET image=? WHERE id=?");
            $stmt->bind_param("si", $update_image, $update_p_id);
            $stmt->execute();
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('../uploaded_img/' . $update_old_image);
        }
    }

    header('Location: admin_products.php');
    exit();
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
                <select name="genre" class="box" required>
                    <option value="Action and Adventure">Action and Adventure</option>
                    <option value="Classics">Classics</option>
                    <option value="Detectives">Detectives</option>
                    <option value="Drama">Drama</option>
                    <option value="Humor and Satire">Humor and Satire</option>
                    <option value="Historical Fiction">Historical Fiction</option>
                    <option value="Poetry">Poetry</option>
                    <option value="Myths and Fairy Tales">Myths and Fairy Tales</option>
                    <option value="Biographies and Memoirs">Biographies and Memoirs</option>
                    <option value="Investing and Money">Investing and Money</option>
                    <option value="Business and Careers">Business and Careers</option>
                    <option value="Computing and Internet">Computing and Internet</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Arts and Photography">Arts and Photography</option>
                    <option value="Romance">Romance</option>
                    <option value="Science, Nature and Maths">Science, Nature and Maths</option>
                    <option value="History">History</option>
                    <option value="Thriller">Thriller</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Horror">Horror</option>
                </select>
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
                            <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_products['image']); ?>" alt="">
                            <div class="genre"><?php echo htmlspecialchars($fetch_products['genre']); ?></div>
                            <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
                            <div class="author"><?php echo htmlspecialchars($fetch_products['author']); ?></div>
                            <div class="price">$<?php echo htmlspecialchars($fetch_products['price']); ?>/-</div>
                            <a href="admin_products.php?update=<?php echo htmlspecialchars($fetch_products['id']); ?>" class="option-button">Update</a>
                            <a href="admin_products.php?delete=<?php echo htmlspecialchars($fetch_products['id']); ?>" class="delete-button" onclick="return confirm('Delete this product?')">Delete</a>

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
                $query = "SELECT * FROM `products` WHERE id = ?";
                $stmt = mysqli_prepare($connection, $query);
                mysqli_stmt_bind_param($stmt, "i", $update_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) > 0) {
                    while ($fetch_update = mysqli_fetch_assoc($result)) {
            ?>

                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="update_p_id" value="<?php echo htmlspecialchars($fetch_update['id']); ?>">
                            <input type="hidden" name="update_old_image" value="<?php echo htmlspecialchars($fetch_update['image']); ?>">
                            <img src="../uploaded_img/<?php echo htmlspecialchars($fetch_update['image']); ?>">
                            <input type="text" name="update_name" value="<?php echo htmlspecialchars($fetch_update['name']); ?>" class="box" required placeholder="enter new book name">
                            <input type="text" name="update_author" value="<?php echo htmlspecialchars($fetch_update['author']); ?>" class="box" required placeholder="enter new book author">
                            <select name="update_genre" class="box">
                                <?php
                                $genres = array(
                                    "Action and Adventure",
                                    "Classics",
                                    "Detectives",
                                    "Drama",
                                    "Humor and Satire",
                                    "Historical Fiction",
                                    "Poetry",
                                    "Myths and Fairy Tales",
                                    "Biographies and Memoirs",
                                    "Investing and Money",
                                    "Business and Careers",
                                    "Computing and Internet",
                                    "Science Fiction",
                                    "Arts and Photography",
                                    "Romance",
                                    "Science, Nature and Maths",
                                    "History",
                                    "Thriller",
                                    "Fantasy",
                                    "Horror"
                                );

                                foreach ($genres as $genre) {
                                    $selected = ($fetch_update['genre'] == $genre) ? 'selected="selected"' : '';
                                    echo '<option value="' . htmlspecialchars($genre) . '" ' . $selected . '>' . htmlspecialchars($genre) . '</option>';
                                }
                                ?>
                            </select>
                            <input type="number" min="0" name="update_price" value="<?php echo htmlspecialchars($fetch_update['price']); ?>" class="box" required placeholder="enter new book price">
                            <input type="file" name="update_image" accept="image/jpeg,image/jpg,image/png" class="box">
                            <input type="submit" value="update" name="update_product" class="button">
                            <input type="reset" value="cancel" id="close-update" class="option-button">
                        </form>

            <?php
                    }
                }
            } else {
                echo ' <script>
                document.querySelector(".edit-product-form").style.display = "none"
            </script>';
            }
            ?>

        </section>
    </div>

    <script src="../js/admin_script.js"></script>
</body>

</html>