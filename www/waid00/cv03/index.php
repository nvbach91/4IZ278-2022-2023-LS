<?php
include_once('static/header.php');
require_once('dynamic/util.php');
error_reporting(0);
$namesur = $_POST['name']." ".$_POST['surname'];
?>

<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="fields">
        <label>Name*</label>
        <input class="inputform" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <?php if (isset($errors['name'])) { ?><div class='text-danger'><?php echo $errors['name']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Surname*</label>
        <input class="inputform" name="surname" value="<?php echo isset($_POST['surname']) ? htmlspecialchars($_POST['surname']) : ''; ?>">
        <?php if (isset($errors['surname'])) { ?><div class='text-danger'><?php echo $errors['surname']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Email*</label>
        <input class="inputform" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <?php if (isset($errors['email'])) { ?><div class='text-danger'><?php echo $errors['email']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Phone*</label>
        <input class="inputform" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
        <?php if (isset($errors['phone'])) { ?><div class='text-danger'><?php echo $errors['phone']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Avatar URL*</label>
        <input class="inputform" name="avatar" value="<?php echo isset($_POST['avatar']) ? htmlspecialchars($_POST['avatar']) : ''; ?>">
        <?php if (isset($errors['avatar'])) { ?><div class='text-danger'><?php echo $errors['avatar']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Name of batch*</label>
        <input class="inputform" name="batch" value="<?php echo isset($_POST['batch']) ? htmlspecialchars($_POST['batch']) : ''; ?>">
        <?php if (isset($errors['batch'])) { ?><div class='text-danger'><?php echo $errors['batch']; ?></div><?php } ?>
    </div>
    <div class="fields">
        <label>Number of cards*</label>
        <input class="inputform" name="cards" value="<?php echo isset($_POST['cards']) ? htmlspecialchars($_POST['cards']) : ''; ?>">
        <?php if (isset($errors['cards'])) { ?><div class='text-danger'><?php echo $errors['cards']; ?></div><?php } ?>
    </div>
    <p><?php  if (!(isset($errors['name']) || isset($errors['surname']) || isset($errors['email']) || isset($errors['phone']) || isset($errors['avatar']) || isset($errors['batch'])
                || isset($errors['cards'])) and isset($_POST['submit'])) {echo "Form sent successfully!";}?></p>
    <button class="submit" type="submit" name="submit">Submit</button>
</form>


<?php
if (!(isset($errors['name']) || isset($errors['surname']) || isset($errors['email']) || isset($errors['phone']) || isset($errors['avatar']) || isset($errors['batch']) || isset($errors['cards'])) and isset($_POST['submit'])){
    ?>
    <div id="back">
        <div class="vizitka">
            <img src="<?php echo $_POST['avatar']; ?>" alt="Profile picture">
            <div class="leftSide">
                <h2 class="nameSur"><?php echo $_POST['name'] . " " . $_POST['surname']; ?></h2>
                <ul class="underLeftSide">
                    <li>name of batch: <?php echo $_POST['batch']; ?></li>
                    <li>number of cards: <?php echo $_POST['cards']; ?></li>
                </ul>
            </div>
            <div class="rightSide">
                phone: <?php echo $_POST['phone']; ?><br>
                :D<br>
                email: <?php echo $_POST['email']; ?>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php include_once('static/footer.php'); ?>
