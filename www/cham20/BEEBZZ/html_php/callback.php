<?php
require './UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "REGISTRATION PAGE BEEBZZ", $buffer);
echo $buffer;

//REGISTRATION LOGIC
$errors = [];

if (!empty($_POST)) {
    //ALL INPUTS
    $value = $_POST['first_name'];
    echo $value;
}



?>
<div class="text-center registration-form">
    <form action="./callback.php" method="POST">

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <?php if (!empty($_POST)) : ?>
                <div class="alert alert-success">Registration was successful!</div>
            <?php endif; ?>
        <?php endif; ?>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="first_name" placeholder="Your name" value="ADAM">
            </div>
        </div>
        <div>
            <button class="btn btn-info">SUBMIT</button>
        </div>
    </form>
</div>
<?php include './footer.php'; ?>