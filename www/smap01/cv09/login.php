<?php require_once __DIR__ . '/incl/header.php'; ?>
<?php

if(!empty($_POST)){
    $name=$_POST['name'];
    setcookie('name', $name, time()+3600);
    header('Location: ./index.php');
    exit;
}

?>



<div style="margin-left:auto;margin-right:auto;width:60%;max-width:300px;">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <h1 style="text-align:center;padding-bottom:30px;">Login page</h1>
        <input class="form-control mr-sm-2" required style="display:block;margin-left:auto;margin-right:auto;margin-bottom:30px;" name="name" type="text" placeholder="Name">
        <button class="btn" style="display:block;margin-left:auto;margin-right:auto;">Login</button>
    </form>
</div>
<?php require_once __DIR__ . '/incl/footer.php'; ?>