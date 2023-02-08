<?php require './utils.php' ?>
<?php
    $errors = [];
    if (!empty($_POST)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $users = getUsers();
        $userLogedIn = false;
        foreach($users as $user) {
            if ($user[2] === $email && $user[5] === $password) {
                $userLogedIn = true;
            }
        }

        if ($userLogedIn) {
            header('Location: ./dashboard.php');
            exit();
        } else {
            array_push($errors, 'Invalid credentials');
        }

    }
?>

<?php require './includes/head.php'; ?>
<main>
    <h1>Login page</h1>
    <form action="./login.php" method="POST">
        <label>Your email</label>
        <input placeholder="email" name="email" type="email" value="<?php echo @$email; ?>">
        <br>
        <label>Your password</label>
        <input placeholder="password" name="password" type="password">
        <button>Submit</button>
    </form>
</main>
<?php require './includes/foot.php'; ?>