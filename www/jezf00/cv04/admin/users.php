<?php 

require __DIR__ . '/../utils/utils.php';

$users = fetchUsers();

?>

<?php require __DIR__ . '/../incl/header.php'; ?>

<main class="container">
    <section>
        <br>
        <h1 class="text-center">Users</h1>
        <?php foreach ($users as $user): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $user['name']; ?></h5>
                    <h6 class="card-subtitle mb-2"><?php echo $user['email']; ?></h6>
                </div>
            </div>
            <br>
        <?php endforeach; ?>
    </section>
</main>

<?php require __DIR__ . '/../incl/footer.php'; ?>