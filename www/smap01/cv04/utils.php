<?php
function fetchUser($email)
{
    $users = fetchUsers();
    foreach ($users as $user) {
        if ($user['email'] == $email) {
            return $user;
        }
    }
    return null;
}
function fetchUsers()
{
    $userList = [];
    $usersFilePath = './users.db';
    $fileContents = file_get_contents($usersFilePath);
    $users = explode(PHP_EOL, $fileContents);
    foreach ($users as $user) {
        if (strlen($user) > 0) {
            $fields = explode(';', $user);
            $user = [
                'name' => $fields[0],
                'email' => $fields[2],
                'phone' => $fields[3],
                'gender' => $fields[1],
                'package' => $fields[5],
                'password' => $fields[7]
            ];
            array_push($userList, $user);
        }
    }
    return $userList;
}
function registerNewUser($errors)
{
    $formIsSubmitted = !empty($_POST);
    //Check if form is submitted 
    if ($formIsSubmitted) {
        $email = htmlspecialchars(trim($_POST['email']));
        $phone = htmlspecialchars(trim($_POST['phone']));
        $fullname = htmlspecialchars(trim($_POST['fullname']));
        $gender = htmlspecialchars(trim($_POST['gender']));
        $avatar = htmlspecialchars(trim($_POST['avatar']));
        $package = htmlspecialchars(trim($_POST['package']));
        $cardNum = htmlspecialchars(trim($_POST['cardNum']));
        $password = htmlspecialchars(trim($_POST['password']));
        $passwordVal = htmlspecialchars(trim($_POST['passwordVal']));


        $users = fetchUsers();
        foreach ($users as $user) {
            if ($user['email'] == $email) {
                return 'This email already exists';
            }
        }

        if (empty($errors)) {
            $record = "$fullname;$gender;$email;$phone;$avatar;$package;$cardNum;$password" . PHP_EOL;
            file_put_contents('./users.db', $record, FILE_APPEND);
            //  Redirect to login page
            header('Location: login.php?email=' . $email);
            exit;
        }
    }
}
