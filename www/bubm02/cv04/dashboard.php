<?php include './head.php'; ?>
<?php include './utils.php'; ?>
<?php

if (isset($_GET["username"])) {
    $username = $_GET["username"];
} else {
    header("Location: login.php");
    exit;
}

$user = getUser($username);

$gender;

switch($user->gender) {
    case('F'):
        $gender = "Female";
        break;
    case('M'):
        $gender = "Male";
        break;
    case('O'):
        $gender = "Others";
        break;
}

?>

<main>
    <div class="fields">
        <div class="form-container">
            <h2>Name: <?php echo $user->name?></h2>
            <h2>Username: <?php echo $user->username?></h2>
            <p>Gender : <?php echo $gender?></p>
            <p>Email : <?php echo $user->email?></p>
            <p>Phone : <?php echo $user->phone?></p>
        </div>

        <div class="avatar-container">
            <img src="<?php echo $user->avatar ?>" alt="Avatar" />
        </div>
    </div>
</main>

<?php include './foot.php'; ?>