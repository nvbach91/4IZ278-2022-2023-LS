<?php
require('../includes/header.php');
require('../config/config.php');

$users = [];
$lines = file(DB_FILE_USERS);
foreach($lines as $line) {
    $line = trim($line);
    if (!$line) continue;
    $fields = explode(DELIMITER, $line);
    if (!count($fields)) { return null; }
    array_push($users, [
        'name' => $fields[0],
        'email' => $fields[1]
    ]);
}
?>

<body>
    <?php foreach($users as $user): ?>
        <div class = 'user'>
            <h4><?php echo $user['name']; ?> : <?php echo $user['email']; ?></h4>
        </div>
    <?php endforeach; ?>
</body>
</html>