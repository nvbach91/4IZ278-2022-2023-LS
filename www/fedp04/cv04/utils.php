<?php include './head.php'?>

<?php 
function getUser($nickname) {
    $databaseFilePath = './database.db';
    $usersData = file_get_contents($databaseFilePath);
    $users = explode(PHP_EOL, $usersData);
    foreach ($users as $user) {
        if (trim($user) == '') {
            continue;
        }
        $fields = explode(';', $user);
        $user = [
            'email' => $fields[0],
            'phone' => $fields[1],
            'nickname' => $fields[2],
            'password' => $fields[3],
            'gender' => $fields[4]

        ];
        if ($user['nickname'] == $nickname) {
            return $user;
        }
    }
    return null;
}


?>