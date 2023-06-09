<?php require_once 'UsersDatabase.php';?>
<?php
$usersDatabase = new UsersDatabase();

$errors = [];

$email = isset($_GET['email'])?$_GET['email']:'';

if(!empty($_POST)){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    if($email == ''){
        $message = 'Email is empty!';
        array_push($errors, $message);
    }

    if($password == ''){
        $message = 'Password is empty!';
        array_push($errors, $message);
    }

    if(empty($errors)){
        $existingUser = $usersDatabase->getUser($email);
        if($existingUser != null){
            if (password_verify($password,$existingUser['password'])) {
                $username = $existingUser['username'];
                $admin = $existingUser['admin'];
                $user_id = $existingUser['user_id'];
                session_start();
                setcookie('username',$username,time() + 3600);
                setcookie('admin',$admin,time() + 3600);
                setcookie('user_id',$user_id,time()+3600);
                header('Location: index.php?name='.$existingUser['username']);
                exit;
            } else {
                $message = 'Invalid password.';
                array_push($errors,$message);
            }
        }else{
            $message = 'Nnonexisting user.';
            array_push($errors,$message);
        }
    }
}

?>
<?php require 'header.php'; ?>
        <section style="width: 40%;display: table;margin: auto;" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1 style="text-align: center;">Login page</h1>
            <form action="login.php" method="POST">
                <?php if(isset($_GET['email'])):?>
                    <div class="success"><p>Yeah! You have successfully signed up!</p></div>
                <?php endif; ?>
                <?php foreach($errors as $error):?>
                    <div class="error"><p><?php echo $error; ?></p></div>
                <?php endforeach; ?>
                <div>
                    <label for="">Email</label>
                    <input name="email" value="<?php echo $email;?>">
                </div>
                <div>
                    <label for="">Password</label>
                    <input name="password" type="password">
                </div>
                <button>Login</button>
            </form>
            </div>
        </section>
<?php require 'footer.php'; ?>