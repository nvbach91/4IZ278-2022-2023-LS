<?php
require './UsersDatabase.php';
// TITLE HANDLING ------ konec 11:45
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "PERSONAL INFORMATION", $buffer);
echo $buffer;

if (isset($_GET['first_name'])) {
    $first_name = $_GET['first_name'];
    $second_name = $_GET['second_name'];
    $phone = $_GET['phone'];
    $country = $_GET['country'];
    $city = $_GET['city'];
    $street = $_GET['street'];
    $postal = $_GET['postal'];
    $email = $_GET['email'];


    $usersDatabase = new UsersDatabase();
    $response = $usersDatabase->getUSer($email);
    foreach ($response as $users) {
        $user = $users;
    }
    $last_modified_when_got = $user['last_modified'];
    $adress_id = $user['adress_id'];
}

$errors = [];
if (!empty($_POST)) {
    //ALL INPUTS

    $phoneA = htmlspecialchars(trim($_POST['phone']));
    $first_nameA = htmlspecialchars(trim($_POST['first_name']));
    $second_nameA = htmlspecialchars(trim($_POST['second_name']));
    $countryA = htmlspecialchars(trim($_POST['country']));
    $cityA = htmlspecialchars(trim($_POST['city']));
    $streetA = htmlspecialchars(trim($_POST['street']));
    $postal_codeA = htmlspecialchars(trim($_POST['postal_code']));
    $email = htmlspecialchars(trim($_POST['email']));
    $last_modified_when_got = htmlspecialchars(trim($_POST['last_modified_when_got']));
    $adress_id = htmlspecialchars(trim($_POST['adress_id']));

    if (strlen($phoneA) != 9) {
        $message = 'Phone has invalid number of digits';
        array_push($errors, $message);
    }
    if (empty($errors) && !empty($_POST)) {
        $usersDatabase = new UsersDatabase();
        $response_after = $usersDatabase->getUSer($email);
        foreach ($response_after as $users_after) {
            $user_after = $users_after;
        }
        $last_modified_when_changing = $user_after['last_modified'];
        if (($last_modified_when_changing == NULL && $last_modified_when_got == NULL) || $last_modified_when_changing == $last_modified_when_got) {
            $usersDatabase->alterUser($email, $first_nameA, $second_nameA, $phoneA, $countryA, $cityA, $streetA, $postal_codeA, $adress_id);
            header('Location: profile.php');
        } else {
            $message = 'Someone modified before you.';
            array_push($errors, $message);
        }
    }
}

?>
<div class="text-center registration-form">
    <form action="./info_change.php" method="POST">

        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="form-group row" style="visibility: hidden;">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="email" value="<?= $email ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="first_name" value="<?= $first_name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Second name:</label>
            <div class="col-sm-9">
                <input type="name" class="form-control" name="second_name" value="<?= $second_name ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Phone number:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="phone" value="<?= $phone ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Country:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="country" value="<?= $country ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">City:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="city" value="<?= $city ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label">Street plus house number:</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="street" value="<?= $street ?>">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Postal code:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="postal_code" value="<?= $postal ?>">
            </div>
        </div>
        <div class="form-group row" style="visibility: hidden;">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="last_modified_when_got" value="<?= $last_modified_when_got ?>">
            </div>
        </div>
        <div class="form-group row" style="visibility: hidden;">
            <label class="col-sm-2 col-form-label">First name:</label>
            <div class="col-sm-10">
                <input type="name" class="form-control" name="adress_id" value="<?= $adress_id ?>">
            </div>
        </div>
        <div>
            <button class="btn btn-info">SUBMIT</button>
        </div>
    </form>
</div>
<?php include './footer.php'; ?>