<?php

if(!empty($_POST)){
    $username = $_POST['username'];

    session_start();
    setcookie('username',$username,time() + 3600);
    header('Location: ./index.php');
    exit;
}

?>
<?php require './header.php'; ?>
        <section style="height:100%" class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
            <h1>Log in</h1>
                <form action="./login.php" method="POST">
                    <input name="username">
                    <button>Submit</button>
                </form>
            </div>
        </section>
<?php require './footer.php'; ?>