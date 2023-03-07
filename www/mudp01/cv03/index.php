<?php
$errorMessages = [];

if (!empty($_POST)) {
    $name = htmlentities(trim($_POST['name']));
    $gender = htmlentities(trim($_POST['gender']));
    $email = htmlentities(trim($_POST['email']));
    $phone = htmlentities(trim($_POST['phone']));
    $profilePic = htmlentities(trim($_POST['profilePic']));
    $packName = htmlentities(trim($_POST['packName']));
    $packCardCount = htmlentities(trim($_POST['packCardCount']));

    if (!preg_match('/^\w{3}(.?+)*$/', $name)) {
        $error = 'Jméno musí mít alespoň 3 písmena či číslice!';
        array_push($errorMessages, $error);
    }

    if (preg_match('/^\w{10}(\w?+)*$/', $name)) {
        $error = 'Jméno může obsahovat maximálně 10 písmen či číslic!';
        array_push($errorMessages, $error);
    }

    if (!in_array($gender, ['F', 'M', 'O'])) {
        $error = 'Hodnota pohlaví je špatně zadaná, jsou možné pouze hodnoty muž, žena a jiné! ';
        array_push($errorMessages, $error);
    }

    if (!preg_match('/^\w{2}(\w?+)*\@\w{2}(\w?+)*\.\w{2}(\w?+)*$/', $email)) {
        $error = 'Zadejte validní e-mail!';
        array_push($errorMessages, $error);
    }

    if (!preg_match('/^\d{9}$/', $phone)) {
        $error = 'Zadejte validní telefoní číslo!';
        array_push($errorMessages, $error);
    }

    if (!preg_match('/^[https:\/\/,https\/\/]\w{2}(.?+)*\.\w{2}(\w?+)*$/', $profilePic)) {
        $error = 'Zadejte validní URL adresu profilového obrázku!';
        array_push($errorMessages, $error);
    }

    if ($packName == '') {
        $error = 'Zadejte validní název balíku karet!';
        array_push($errorMessages, $error);
    }

    if ($packCardCount < 1) {
        $error = 'Balík musí mít více karet!';
        array_push($errorMessages, $error);
    }

    if ($packCardCount > 100) {
        $error = 'Maximální počet karet v balíku je 100!';
        array_push($errorMessages, $error);
    }
}

$successAlt = '';

if (empty($errorMessages) && !empty($_POST)) {
    $successAlt = 'Profiový obrázek';
    $successMessage = 'Vážený/á ' . $name . ', Vaše registrace byla úspěšně podána, připravte si balík ' . $packName . ' se všemi ' . $packCardCount . ' kartami, protože s Vámi počítáme!';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace na turnaj BANG</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <h1>Registrační formulář pro účast v turnaji BANG 1. 4. 2023</h1>
    <div class="success">
        <?php echo isset($successMessage) ? $successMessage : ''; ?>
    </div>
    <?php if (empty($errorMessages) && !empty($_POST)) : ?>
        <img class="avatar" src="<?php echo $profilePic ?>" alt="<?php echo $successAlt ?>">
    <?php endif ?>
    <div class="error">
        <?php foreach ($errorMessages as $error) : ?>
            <div><?php echo $error; ?></div>
        <?php endforeach; ?>
    </div>
    <form method="POST" action=".">
        <div>
            <label>Jméno: </label>
            <input name="name" value="<?php echo isset($name) ? $name : ''; ?>">
        </div>
        <div class="gender">
            <label>Pohlaví: </label>
            <select class="genderInput" name="gender">
                <option value="M" <?php echo isset($gender) && $gender == 'M' ? ' selected' : "Muž" ?>>Muž</option>
                <option value="F" <?php echo isset($gender) && $gender == 'F' ? ' selected' : "Žena" ?>>Žena</option>
                <option value="O" <?php echo isset($gender) && $gender == 'O' ? ' selected' : "Jiné" ?>>Jiné</option>
            </select>
        </div>
        <div>
            <label>E-mail: </label>
            <input name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        </div>
        <div>
            <label>Telefon: </label>
            <input name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
        </div>
        <div>
            <label>Profiloví obrázek (uveďte URL odkaz): </label>
            <input name="profilePic" value="<?php echo isset($profilePic) ? $profilePic : ''; ?>">
        </div>
        <div>
            <label>Název balíku: </label>
            <input name="packName" value="<?php echo isset($packName) ? $packName : ''; ?>">
        </div>
        <div>
            <label>Počet karet v balíku: </label>
            <input name="packCardCount" value="<?php echo isset($packCardCount) ? $packCardCount : ''; ?>">
        </div>
        <button type="submit">Zaregistrovat</button>
    </form>
</body>

</html>