<?php
$databaseFilePath = '../database.db';
$usersData = file_get_contents($databaseFilePath);
$users = explode(PHP_EOL, $usersData);
?>
<?php include '../header.php'?>
<main>
    <h1>All users registered:</h1>
    <div>
        <?php foreach($users as $user):?>
            <ul>
                <li><?php echo $user?></li>
            </ul>
        <?php endforeach;?>
    </div>
</main>
<?php include '../footer.php'?>