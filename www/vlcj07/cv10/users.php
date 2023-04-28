<?php 
require './db/db.php';
require 'authorization.php';

if ($current_user['privilege'] < 3) {
    header("Location: not-permitted.php");
    exit();
}

$query = "SELECT * FROM cv10_users";
$statement = $pdo->prepare($query);
$statement->execute();    
$users = $statement->fetchAll();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $userId = $_GET['user_id'];
    $privilege = $_POST['privilege'];

    $query2 = "UPDATE `cv10_users` SET privilege = :privilege WHERE user_id = :userId";
    $statement2 = $pdo->prepare($query2);
    $statement2->execute(['userId' => $userId, 'privilege' => $privilege]);

    header("Location: users.php");
    exit;
}

?>

<?php include './app/header.php'; ?>

<main class="max-w-4xl mx-auto">
    <section id="products" class="flex justify-center p-6 mb-12 scroll-mt-40 widescreen:section-min-height tallscreen:section-min-height">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-4xl font-bold text-center sm:text-5xl mb-7 text-slate-900 dark:text-white">All Users</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                <?php include './app/UsersDisplay.php' ?>
            </div>
        </div>
    </section>
</main>

<?php include './app/footer.php';
?>