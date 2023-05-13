<?php
session_start();

$username = $_COOKIE['username'];

?>
<?php require './header.php'; ?>
    <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>You are logged in</h1>
            <h2><?php echo $username;?></h2>
            <a href="./index.php">Back</a>
            </div>
        </section>
<?php require './footer.php'; ?>