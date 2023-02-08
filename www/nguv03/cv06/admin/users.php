<?php require __DIR__ . '/../db/UsersDB.php'; ?>
<?php
// we create a new instance for each table (users, products) and 
// simply use its public methods
// to achieve this we need OOP
$usersDB = new UsersDB();
$users = $usersDB->fetchAll();
//$users = $usersDB->fetchBy('email', 'samuel@drake.net');
//$usersDB->deleteBy('email', 'nathan@drake.net');
//$usersDB->create(['email' => 'nathan@drake.net', 'name' => 'Nathan', 'age' => 45]);
//$usersDB->updateBy(['email' => 'nathan@drake.net'], ['name' => 'Nate']);
?>

<?php $contextPath = '..'; ?>
<?php require __DIR__ . '/../incl/header.php'; ?>

<main class="container">
    <h2>Users</h2>
    <?php foreach($users as $user): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user['name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
            <p class="card-text"><?php echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. De illis, cum volemus. Nescio quo modo praetervolavit oratio. Quid sequatur, quid repugnet, vident. Quo modo autem philosophus loquitur? Tum Quintus: Est plane, Piso, ut dicis, inquit. Duo Reges: constructio interrete.' ?></p>
            <a href="#" class="card-link">Visit website</a>
            <a href="#" class="card-link">GitHub profile</a>
        </div>
    </div>
    <?php endforeach; ?>
</main>

<?php require __DIR__ . '/../incl/footer.php'; ?>