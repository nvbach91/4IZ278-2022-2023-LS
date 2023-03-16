<?php require './utils.php' ?>
<?php
$formIsSubmitted = !empty($_POST);
if ($formIsSubmitted) {
    // parse form data here
    // validation...
    $email = $_POST['email'];
    $user = getUser($email);
    if ($user == null) {
        echo "User is not registered";
    } else {
        echo "Login success";
        header('Location: dashboard.php');
        exit;
    }
}
?>

<?php include './head.php'; ?>

<main>
    <h1>Login</h1>
    <form method="POST" action="./login.php">
        <div>
            <label>Email</label>
            <input name="email">
        </div>
        <button>Login</button>
    </form>
</main>

<?php include './foot.php'; ?>