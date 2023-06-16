<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './UserDatabase.php'; ?>
<?php

if (!empty($_POST)) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userDatabase = new UserDatabase();
    $user = $userDatabase->getUserByEmail($email);
    if ($user && $user['password'] && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: ./index.php');
    } else {
        $error = "Nesprávny email alebo heslo";
    }
}
?>

<?php require './header.php'; ?>
<?php require './navbar.php'; ?>

<div class="d-flex justify-content-center pt-4">
    <div class="card">
        <div class="card-body m-4 d-flex">
            <div>
                <h3 class="mb-4">Prihlásenie</h3>
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="./login.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" type="email" placeholder="Sem napíšte email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Sem napíšte heslo" name="password" required>
                    </div>
                    <button class="btn btn-primary mt-2 mb-2 w-100">Prihlásiť</button>
                </form>
                <form method="POST" action="./fb-login.php">
                    <button class="btn btn-outline-primary d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook me-2" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                        </svg>
                        Prihláste sa cez facebook
                    </button>
                </form>
                <p class="mt-2">Ak nemáte účet, <a href="./register.php">vytvorte si nový</a>.</p>
            </div>
            <?php require './logo-large.php'; ?>
        </div>
    </div>
</div>

<?php require './footer.php'; ?>