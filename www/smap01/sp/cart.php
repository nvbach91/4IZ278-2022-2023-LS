<?php
require_once './incl/header.php';
require_once './database/ProductsDB.php';
require_once './database/UsersDB.php';
$usersDB = UsersDB::getDatabase();
$productsDB = ProductsDB::getDatabase();

//First enter and input tests
if (!isset($_SESSION) || !isset($_COOKIE['user_email']) || !$usersDB->userExists(htmlspecialchars($_COOKIE['user_email']))) {
    header('Location: login.php');
    exit;
}
?>
<div class="container">
    <h1>Shopping cart</h1>
    <div class="cart">
        <?php

        if (isset($_SESSION['books']))
            foreach ($_SESSION['books'] as $book) : ?>
            <?php if (isset($book['book_id']) && isset($book['book_count']) && $productsDB->bookExists($book['book_id'])) : ?>
                <div class="cart-item">
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <div><img src='<?php $book_rec = $productsDB->getBook($book['book_id']);
                                                    echo $book_rec['thumbnail_url'] ?>' alt="book-image"></div>
                                </td>
                                <td>
                                    <div>
                                        <h5><?php echo "<a href='book-detail.php?book_id=" . $book_rec['book_id'] . "'>" . substr($book_rec['book_name'], 0, 50); ?></h5>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <a href='actions/add-to-cart.php?book_id=<?php echo $book_rec['book_id'] ?>'><b>+</b></a>
                                        <a>&nbsp<?php echo $book['book_count'] ?>&nbsp</a>
                                        <a href='actions/remove-from-cart.php?book_id=<?php echo $book_rec['book_id'] ?>'><b>-</b></a>
                                        <a href="actions/remove-from-cart.php?book_id=<?php echo $book['book_id'] ?>&all=1" style="width:100%;display:block;text-align:center;"><i class="btn btn-danger fa-solid fa-trash-can"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?php if (isset($_SESSION['books'])&&count($_SESSION['books']) > 0) : ?>
        <div class="order-btn-wrapper">
            <a href="actions/place-order.php" class="order-btn btn">Place the order</a>
        </div>
    <?php endif; ?>
</div>
<?php
require_once './incl/footer.php';
?>