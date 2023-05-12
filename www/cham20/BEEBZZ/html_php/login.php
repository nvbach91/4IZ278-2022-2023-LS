<?php
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "LOGIN BEEBZZ", $buffer);
echo $buffer;

// LOGIN LOGIC
if (!empty($_POST)) {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    //find user

    //get password from db

    //encrypt it

    //validate it
}
?>
<div class="text-center login-form">
    <div class="inner">
        <form action="./login.php" method="POST">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" placeholder="E-mail">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password:</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
            </div>
            <div>
                <button class="btn btn-success">SUBMIT</button>
            </div>
        </form>
    </div>
</div>
<?php include './footer.php'; ?>