<?php
session_start();
error_reporting(0);
include_once('static/header.php');
if (!$_SESSION['logged']or isset($_POST['logout'])){
    unset($_SESSION['logged']);
    header('Location: ./dynamic/login.php');
}
if (isset($_POST['users'])){
    header('Location: ./dynamic/users.php');
}

?>
<style>

    form {
        display: flex;
        justify-content: center;
        margin: 20px;
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

</style>
    <form method="post">
        <input type="submit" name="logout" value="logout">
        <input type="submit" name="users" value="users">
    </form>

<?php
include_once('static/footer.php');

