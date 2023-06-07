<?php
require_once("./incl/header.php");
require_once("./database/ProductsDB.php");
require_once("./database/ReviewsDB.php");
require_once("./database/UsersDB.php");

$productsDB = ProductsDB::getDatabase();
$reviewsDB = ReviewsDB::getDatabase();
$usersDB = UsersDB::getDatabase();

//Fist enter and input tests
if(!isset($_COOKIE['user_email'])||!$usersDB->userExists($_COOKIE['user_email'])){
    header('Location: login.php');
    exit;
}

if (!isset($_COOKIE['user_email'])||!isset($_GET)&&!isset($_POST) || !$productsDB->bookExists($_GET['book_id'])) {
    header('Location: index.php');
    exit;
}

//Adds a review if the length or result is 0
$result=validateInput($_POST);
if(strlen($result)==0){
    $result=$reviewsDB->addReview(htmlspecialchars($_POST['book_id']),htmlspecialchars($usersDB->getUserID($_COOKIE['user_email'])), htmlspecialchars($_POST['review_stars']), htmlspecialchars($_POST['review_title']), htmlspecialchars($_POST['review_text']));
    if($result==NULL){
        header('Location: index.php');
        exit;
    }
}

//Function that validates input in POST and returns result string with errors if there are some
function validateInput($POST){
    $result="";
    if(!isset($POST['book_id'])||!filter_var($POST['book_id'], FILTER_VALIDATE_INT)){
        $result.="Book ID cannot be empty and has to be a whole number.";
    }
    if(!isset($POST['book_name'])||!filter_var($POST['book_name'], FILTER_UNSAFE_RAW)){
        $result.="Book name is not right.";
    }
    if(!isset($POST['review_title'])||!filter_var($POST['review_title'], FILTER_UNSAFE_RAW)){
        $result.="Review title is in a wrong format.";
    }
    if(!isset($POST['review_text'])||!filter_var($POST['review_text'], FILTER_UNSAFE_RAW)){
        $result.="Review text is in a wrong format.";
    }
    if(!isset($POST['review_stars'])||!filter_var($POST['review_stars'],FILTER_VALIDATE_INT)||$POST['review_stars']>5||$POST['review_stars']<1){
        $result.="Review stars has to be selected and has to be within 1-5.";
    }
    return $result;
}


?>
<div class="container">
    <h1>Add a review</h1>
    <form class="review-f" action='add-review.php?book_id=<?php echo $_GET['book_id']?>' method="POST">
        <div class="detail-2c" style="width:100%!important;">
            <div>
                <div class="r2-1c">
                    <div>
                        <h5>Book ID</h5>
                        <span><a><input type="text" name="book_id" value='<?php echo $_GET['book_id'] ?>' required readonly></a></span>
                    </div>
                </div>
                <div class="r2-1c fw">
                    <div>
                        <h5>Book name</h5>
                        <span><a><input type="text" name="book_name" value='<?php echo $productsDB->getBook($_GET['book_id'])['book_name'] ?>' required readonly></a></span>
                    </div>
                </div>
                <div class="r2-1c fw">
                    <div>
                        <h5>Review title</h5>
                        <span><a><input type="text" name="review_title" value='<?php echo (isset($_POST['review_title'])) ? $_POST['review_title'] : "" ?>' required></a></span>
                    </div>
                </div>
                <div class="r2-1c fw">
                    <div>
                        <h5>Review text</h5>
                        <span><a><textarea type="text" name="review_text" required><?php echo isset($_GET['review_text']) ? $_GET['review_text'] : "" ?></textarea></a></span>
                    </div>
                </div>
            </div>
            <div class="review-stars">
                <div class="review-2r">
                    <h5>Number of stars</h5>
                </div>
                <span>
                    <input type="radio" id="age1" name="review_stars" value="1" checked="checked">
                    <label for="age1"><i class="fa-sharp fa-solid fa-star"></i></label><br>
                </span>
                <span>
                    <input type="radio" id="age2" name="review_stars" value="2">
                    <label for="age2"><?php for ($i = 1; $i <= 2; $i++) echo '<i class="fa-sharp fa-solid fa-star"></i>' ?></label><br>
                </span>
                <span>
                    <input type="radio" id="age3" name="review_stars" value="3">
                    <label for="age3"><?php for ($i = 1; $i <= 3; $i++) echo '<i class="fa-sharp fa-solid fa-star"></i>' ?></label><br>
                </span>
                <span>
                    <input type="radio" id="age1" name="review_stars" value="4">
                    <label for="age1"><?php for ($i = 1; $i <= 4; $i++) echo '<i class="fa-sharp fa-solid fa-star"></i>' ?></label><br>
                </span>
                <span>
                    <input type="radio" id="age2" name="review_stars" value="5">
                    <label for="age2"><?php for ($i = 1; $i <= 5; $i++) echo '<i class="fa-sharp fa-solid fa-star"></i>' ?></label><br>
                </span>
            </div>
        </div>
        <button class="review-btn btn">Post</button>
    </form>
</div>

<?php
require_once("./incl/footer.php");
?>