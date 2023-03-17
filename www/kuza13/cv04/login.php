<?php
require ('./utils.php');
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $user = getUser($email);


   
    if ($user['email'] == $email && $user['password'] == $password) {
        echo $loginSuccsess = 'Log-in successful';
    }else{
        echo $unsuccessLogin="Email or Password are wrong";
    }
}
?>
<?php include './head.php' ?>
<main>
    <h1>Login</h1>
    <form method="POST" action="login.php" enctype="multipart/form-data">
        <div>
            <label>E-mail</label>
            <input name="email">

        </div>
        <div>
            <label>Password</label>
            <input name="password">
        </div>
            <button>Submit</button>


</main>