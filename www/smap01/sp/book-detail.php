<?php
require_once("./incl/header.php");
require_once("./database/ProductsDB.php");
require_once("./database/ReviewsDB.php");
require_once("./database/UsersDB.php");

$productsDB = ProductsDB::getDatabase();
$reviewsDB = ReviewsDB::getDatabase();
$usersDB = UsersDB::getDatabase();

//First enter and input tests
if (!isset($_GET) || !$productsDB->bookExists($_GET['book_id'])) {
    header('Location: index.php');
    exit;
}

$book = $productsDB->getBook($_GET['book_id']);
$reviews = $reviewsDB->getReviews($_GET['book_id']);

?>

<div class="container">
    <h1>Book detail</h1>
    <div class="detail-2c" style="width:100%!important;">
        <div>
            <div class="r1-3c">
                <img src="<?php echo $book['thumbnail_url'] ?>" alt="book-thumbnail">
                <div>
                    <h5>Price</h5>
                    <span><a><?php echo $book['price'] ?></a></span>
                </div>
                <div>
                    <h5>Book id</h5>
                    <span><a><?php echo $book['book_id'] ?></a></span>
                </div>
            </div>
            <div class="r2-1c">
                <div>
                    <h5>Book name</h5>
                    <h3><?php echo $book['book_name'] ?></h3>
                </div>
                <div>
                    <h5>Author/s</h5>
                    <h3><?php echo $book['book_author'] ?></h3>
                </div>
                <div>
                    <h5>Description</h5>
                    <h3><?php echo $book['book_description'] ?></h3>
                </div>
            </div>
        </div>
        <div>
            <div class="review-1r">
                <h5>Reviews</h5>
                <a href="add-review.php?book_id=<?php echo $book['book_id'] ?>">Add a review</a>
            </div>
            <div class="reviews">
                <?php foreach ($reviews as $review) : ?>
                    <div class="review">
                        <p>
                            <b><?php echo $review['review_title']; ?></b><br>
                            <?php $user = $usersDB->getUser($review['review_user_id']); ?>
                            <?php echo (isset($review['review_user_id']) && $usersDB->userExists($usersDB->getUser($review['review_user_id'])['user_email'])) ? "<a>By <a href='profile.php?user_id=" . $user['user_id'] . "'>" . $user['user_name'] . "</a></a><br>" : "" ?>
                            <?php for ($i = 0; $i < $review['review_stars']; $i++) echo '<i class="fa-sharp fa-solid fa-star"></i>'; ?><br>
                            <a><?php echo $review['review_text']; ?></a>
                        </p>
                    </div>
                <?php endforeach; ?>
                <?php if (count($reviews) == 0) echo "<div class='review'><a>There are no reviews yet :(</a></div>"; ?>
            </div>
        </div>
    </div>
    <div class="buy-btn">
        <a href='actions/add-to-cart.php?book_id=<?php echo $book['book_id'] ?>'>Buy</a>
    </div>
</div>

<?php

require_once("./incl/footer.php");
?>