<?php
function fetchUsers() {
    $users = array();
    $handle = fopen("users.db", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $fields = explode(",", rtrim($line));
            $name = $fields[0];
            $email = $fields[1];
            $password = $fields[2];
            $users[$email] = array('name' => $name, 'password' => $password);
        }
        fclose($handle);
    }
    return $users;
}
if (isset($_POST['logout'])){
    unset($_SESSION['logged']);
    header('Location: login.php');
}
if (isset($_POST['index'])){
    header('Location: ../index.php');
}
?>

<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
        }
        div{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        td:nth-child(2) {
            width: 40%;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
        }

        input[type="submit"]:active {
            background-color: #3e8e41;
            box-shadow: 0 5px #666;
            transform: translateY(4px);
        }

        th {
            background-color: lightseagreen;
            font-weight: bold;
        }
    </style>
</head>
<body>
<h1>User List</h1>
<div>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Password</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $users = fetchUsers();
    foreach ($users as $email => $user) {
        echo "<tr>";
        echo "<td>" . $user['name'] . "</td>";
        echo "<td>" . $email . "</td>";
        echo "<td>" . $user['password'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</div>
<div>
    <form method="post">
        <input type="submit" name="logout" value="logout">
        <input type="submit" name="index" value="index">
    </form>

</div>

</body>
</html>
