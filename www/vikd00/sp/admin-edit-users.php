<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(2)) ?>
<?php require_once './UserDatabase.php' ?>
<?php
$userDatabase = new UserDatabase();
$users = $userDatabase->getAllUsers();

if (!$users) {
    header('Location: ./index.php');
}
?>

<?php require './header.php' ?>
<?php require './navbar.php'; ?>

<div class="p-5">
    <h3 class="mt-4">Všetci používatelia</h3>
    <?php foreach ($users as $user) : ?>
        <div class="card mt-4">
            <div class="card-body">
                <h3 class="card-title"><?php echo $user['xname'] ?></h3>
                <h5 class="card-subtitle mb-2 text-muted"><?php echo $user['email'] ?></h5>
                <p class="card-text"><?php echo ($user['role'] == 2 ? 'Admin' : 'Užívateľ') ?></p>
                <div class=" d-flex justify-content-end">
                    <form method="GET" action="./profile-edit.php">
                        <input type="hidden" name="user_to_edit" value="<?php echo $user['user_id'] ?>">
                        <button type="submit" class="btn btn-outline-dark">Upraviť profil</button>
                    </form>
                    <form method="GET" action="./admin-delete-user.php">
                        <input type="hidden" name="user_to_delete" value="<?php echo $user['user_id'] ?>">
                        <button type="submit" class="btn btn-danger ms-2" onclick="return confirmDelete()">Zmazať profil</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require './footer.php' ?>

<script>
    function confirmDelete() {
        var r = confirm("Ste si istý že chcete zmazať užívateľa?");
        if (r == true) {
            return true;
        } else {
            return false;
        }
    }
</script>