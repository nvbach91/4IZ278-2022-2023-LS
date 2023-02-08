<?php 

require __DIR__ . '/utils/utils.php';

$email = $_GET['email'];
$user = fetchUser($email);

if (!$user) {
    header('Location: login.php');
    exit();
}

?>

<?php require __DIR__ . '/incl/header.php'; ?>

<main class="container">
    <br>
    <h1 class="text-center">Profile</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $user['name']; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $user['email']; ?></h6>
            <p class="card-text"><?php echo file_get_contents('http://loripsum.net/api/1/short/plaintext'); ?></p>
            <a href="#" class="card-link">Visit website</a>
            <a href="#" class="card-link">GitHub profile</a>
        </div>
    </div>
</main>

<?php require __DIR__ . '/incl/footer.php'; ?>