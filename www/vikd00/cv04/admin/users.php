<?php


$filename = './../users.db';

$fileContent = file_get_contents($filename);
$splitedString = explode(PHP_EOL, $fileContent);

?>
<?php require './../src/head.php' ?>
<h1>Admin page</h1>
<h2>List of users</h2>
<div class="card-list">
    <?php foreach ($splitedString as $es) : ?>
        <?php if ($es != "") : ?>
            <?php $exploitedUserString = explode(';', $es); ?>
            <div class="card">
                <img src="<?php echo $exploitedUserString[5]; ?>" alt="avatar">
                <p><?php echo $exploitedUserString[0] ?></p>
                <p><?php echo $exploitedUserString[1] ?></p>
                <p><?php echo $exploitedUserString[2] ?></p>
                <p><?php echo $exploitedUserString[3] ?></p>
                <p><?php echo $exploitedUserString[4] ?></p>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>
<?php require './../src/foot.php' ?>