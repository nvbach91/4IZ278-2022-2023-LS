<?php include '../head.php';?>
<?php
$usersFilePath = '../users.db';
$usersData = file_get_contents($usersFilePath);
$lines = explode(PHP_EOL,$usersData);
$users = [];

foreach($lines as $line){
    $fields = explode(';',$line);
    if(isset($fields[0])&&isset($fields[1])){
        $user = [
            'name' => $fields[0],
            'email' => $fields[1],
        ];
        array_push($users,$user);
    }
}
?>
<div>
    <h1>Users</h1>
    <?php foreach($users as $user):?>
        <div class="users">
            <h3><?php echo $user['name'];?></h3>
            <p><?php echo $user['email'];?></p>
        </div>
    <?php endforeach; ?>
</div>