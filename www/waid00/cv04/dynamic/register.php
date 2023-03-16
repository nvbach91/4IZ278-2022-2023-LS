<?php
include_once('../static/header.php');
require_once('../dynamic/util.php');
error_reporting(0);

function fetchUsers() {
    $users = array();
    $handle = fopen("users.db", "r");
    if ($handle) {
        while (($line = fgets($handle)) !== false) {
            $fields = explode(",", $line);
            $users[$fields[1]] = array(
                "name" => $fields[0],
                "email" => $fields[1],
                "password" => $fields[2]
            );
        }
        fclose($handle);
    }
    return $users;
}

function registerNewUser($name, $email, $password) {
    $users = fetchUsers();
    if (isset($users[$email])) {
        return "Registration failed: email already exists";
    } else {
        $record = "$name,$email,$password\n";
        $handle = fopen("users.db", "a");
        fwrite($handle, $record);
        fclose($handle);
        $success = "The registration was successfully completed!";
        header("Location: login.php?name=" . urlencode($name) . "&success=" . urlencode($success));

        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['pass'] == $_POST['passAgain']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $users = fetchUsers();
    if (isset($users[$email])) {
        $errors['email'] = "Email already exists";
    } else {
        registerNewUser($name, $email, $password);
    }
}
?>
<p><a href="login.php">login</a></p>
<form class="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="fields">
        <label>Name*</label>
        <input class="inputform" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
        <?php if (isset($errors['name'])) { echo "<div class='text-danger'>" . $errors['name'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <label>Email*</label>
        <input class="inputform" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
        <?php if (isset($errors['email'])) { echo "<div class='text-danger'>" . $errors['email'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <label>Password*</label>
        <input class="inputform" type="password" name="pass">
        <?php if (isset($errors['pass'])) { echo "<div class='text-danger'>" . $errors['pass'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <label>Confirm Password*</label>
        <input class="inputform" type="password" name="passAgain">
        <?php if (isset($errors['passAgain'])) { echo "<div class='text-danger'>" . $errors['passAgain'] . "</div>"; } ?>
    </div>
    <div class="fields">
        <input type="submit" class="submit" name="submit" value="Register">
    </div>

</form>

<?php include_once('../static/footer.php'); ?>
