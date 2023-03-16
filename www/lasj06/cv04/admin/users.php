<?php
$users = explode(PHP_EOL, file_get_contents('../users.db'));
?>

<?php include "../head.php" ?>
<h1>List of registered users:</h1>
<?php foreach($users as $user): ?>
    <p><?php echo $user; ?></p>
<?php endforeach; ?>
<?php include "../foot.php" ?>