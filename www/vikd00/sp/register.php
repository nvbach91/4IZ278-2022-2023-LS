<?php require_once './UserDatabase.php'; ?>
<?php

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password !== $password_confirm) {
        $error = "Heslá sa nezhodujú.";
    } else {
        $userDatabase = new UserDatabase();
        $userDatabase->registerUser($email, $password);

        header('Location: ./login.php');
        exit;
    }
}

?>

<?php require './header.php'; ?>
<?php require './navbar.php'; ?>

<div class="d-flex justify-content-center pt-4">
    <div class="card">
        <div class="card-body m-4 d-flex">
            <div>
                <h3 class="mb-4">Registrácia</h3>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="./register.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Sem napíšte email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Sem napíšte heslo" name="password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Potvrďte heslo" name="password_confirm" required>
                    </div>
                    <button class="btn btn-primary mt-2">Registrovať sa</button>
                </form>
                <p class="mt-2">Ak máte účet, <a href="./login.php">prejdite na prihlásenie</a>.</p>
            </div>
            <?php require './logo-large.php'; ?>
        </div>
    </div>
</div>

<?php require './footer.php'; ?>