<?php include './includes/head.php'; ?>

<?php
// var_dump($_POST);

$errors = [];

if (!empty($_POST)) {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $avatar = $_POST['avatar'];

    if (strlen($name) < 3) {
        array_push($errors, 'The name is not a valid name');
    }

    if (!in_array($gender, ['N', 'F', 'M'])) {
        array_push($errors, 'You are a hacker!');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, 'Invalid email address');
    }

    if (!preg_match('/^\+?\d{9,}$/', $phone)) {
        array_push($errors, 'Invalid Phone number');
    }

    if (!filter_var($avatar, FILTER_VALIDATE_URL)) {
        array_push($errors, 'Invalid Avatar URL!');
    }

    $file = file_get_contents("users.db");
    $lines = explode(PHP_EOL, $file);
    // $emails = [];
    foreach ($lines as $line) {
        // ['bara', 'F', ...]
        $credentials = explode(";", $line);
        if ($credentials[2] === $email) {
            array_push($errors, "Email  $email found");
            break;
        }
        // array_push($emails, $credentials[2]);
    }
    // if (!in_array($email, $emails))
    //     array_push($errors, "Email  $email not found");
    // nacteme soubor s uzivateli
    // vybereme vsechny emaily
    // porovnat emaily
    // pokud email byl nalezen, ulozime chybu
    // pokud nebyl nalezen neudelame nic



    if (!count($errors)) {
        // zapis do databaze

        $userRecord = implode(';', [$name, $gender, $email, $phone, $avatar]);
        // echo $userRecord;
        // 
        file_put_contents('users.db', $userRecord . PHP_EOL, FILE_APPEND);

        header('Location: ./registration-success.php');
        exit();
    }
}

?>

<main>
    <form action="." method="POST">
        <?php foreach ($errors as $error) : ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endforeach; ?>
        <div>
            <label for="name">Type you name</label>
            <input value="<?php echo isset($name) ? $name : ''; ?>" name="name" required>
        </div>
        <div>
            <label for="gender">Select your gender</label>
            <select name="gender">
                <option <?php echo isset($gender) && $gender === 'N' ? 'selected' : ''; ?> value="N">Neutral</option>
                <option <?php echo isset($gender) && $gender === 'F' ? 'selected' : ''; ?> value="F">Female</option>
                <option <?php echo isset($gender) && $gender === 'M' ? 'selected' : ''; ?> value="M">Male</option>
            </select>
        </div>
        <div>
            <label for="email">Your email*</label>
            <input value="<?php echo isset($email) ? $email : ''; ?>" name="email" required>
        </div>
        <div>
            <label for="phone">Your phone number*</label>
            <input value="<?php echo isset($phone) ? $phone : ''; ?>" name="phone" required>
        </div>
        <div>
            <label for="avatar">Avatar URL*</label>
            <input value="<?php echo isset($avatar) ? $avatar : ''; ?>" name="avatar" required>
        </div>
        <button>Submit</button>
    </form>
</main>

<?php include './includes/foot.php'; ?>