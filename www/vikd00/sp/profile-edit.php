<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(1)) ?>
<?php require_once './UserDatabase.php'; ?>
<?php

$userDatabase = new UserDatabase();

if (isset($_GET['user_to_edit']) && isAdmin()) {
    $user = $userDatabase->getUserById($_GET['user_to_edit']);
} else {
    $user = $userDatabase->getUserById($_SESSION['user']['user_id']);
}


if (isset($_POST['update'])) {
    $xname = $_POST['xname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if (empty($xname) || empty($email)) {
        $message = 'Vyplňte všetky polia.';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Zadajte prosím valídnu emailovú adresu';
    } else if ($password !== $confirmPassword) {
        $message = 'Heslá sa nezhodujú';
    } else {
        $userDatabase->updateUser($_SESSION['user']['user_id'], $xname, $email, $password);
        $message = 'Profil úspešne upravený.';
        $user = $userDatabase->getUserById($_SESSION['user']['user_id']);
        $_SESSION['user'] = $user;
    }
}

if (!$user) {
    header('Location: ./index.php');
}
?>

<?php require './header.php'; ?>
<?php require './navbar.php'; ?>

<div class="m-5">
    <?php if (isset($message)) : ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>
    <h3>Úprava profilu</h3>
    <form method="POST" action="./profile-edit.php">
        <div class="form-group">
            <label for="xname">Prezývka</label>
            <input type="text" class="form-control" id="xname" name="xname" value="<?= htmlspecialchars($user['xname']) ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <div class="form-group">
            <label for="password">Nové heslo</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="confirmPassword">Potvrďte nové heslo</label>
            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
        </div>
        <button type="submit" class="btn btn-primary mt-2" name="update">Uložiť</button>
    </form>
</div>

<?php require './footer.php'; ?>