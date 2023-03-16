<?php 

require("./utils.php");

$errors = [];
$invalidInputs = [];

// check if form is submitted
if (!empty($_POST)) {


    $mail =  htmlspecialchars(trim($_POST['mail']));
    $password =  htmlspecialchars($_POST['password']);



    if ($mail == '') {
        $message = "What's your mail?";
        array_push($errors, $message);
        array_push($invalidInputs, 'mail');
        
    }
    
    if ($password == '') {
        $message = "Pls enter password";
        array_push($errors, $message);
        array_push($invalidInputs, 'password');
    }

    $user = getUser($mail);

    if (!$user["mail"]==$mail || !$user["password"]==$password)
    {
        $message = "wrong mail or password!";
        array_push($errors, $message);
        
    } else {
        header('Location: users.php');
        exit;
    };

}





?>

<?php include "./head.php"?>

<main>
<div class="container w-50">
<form method="POST">
    <?php if (!empty($errors)) : ?>

        <ul class="list-group">
            <?php foreach ($errors as $error) : ?>
                <li class="list-group-item list-group-item-danger m-2"><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <div class="text-center m-5">Welcome</div>
    <?php endif; ?>

    <div class="form-group row">
        <div class="col-sm">
            <label>Mail</label>
            <input name="mail" class="form-control <?php echo in_array('mail', $invalidInputs) ? ' is-invalid' : '' ?>" id="mail" placeholder="Enter your mail" value="<?php echo isset($mail) ? $mail : ''; ?>">
        </div>
        <div class="col-sm">
            <label>Password</label>
            <input name="password" class="form-control <?php echo in_array('password', $invalidInputs) ? ' is-invalid' : '' ?>" id="password" placeholder="Enter your password" value="<?php echo isset($password) ? $password : ''; ?>">
        </div>
    </div>
    <div class="text-center pt-3">
        <button class="btn btn-primary btn-lg">Submit</button>
    </div>
   

</form>
</div>
</main>
<?php include './foot.php'; ?>