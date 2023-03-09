<?php

$formSubmited = !empty($_POST);
$validationErrors = [];
$imageData = null;

if ($formSubmited) {
    if (empty($_POST['full_name'])) {
        $validationErrors[] = 'Please enter your full name.';
    }

    if (empty($_POST['email'])) {
        $validationErrors[] = 'Please enter your email.';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = 'Please enter a valid email.';
    }

    if (empty($_POST['phone'])) {
        $validationErrors[] = 'Please enter your phone.';
    }

    if (empty($_FILES['profile_image']) || $_FILES['profile_image']['error'] === 4) {
        $validationErrors[] = 'Please upload your profile image.';
    } else {
        $path = $_FILES['profile_image']['tmp_name'];
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $imageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    if (empty($_POST['deck_name'])) {
        $validationErrors[] = 'Please enter your deck name.';
    }

    if (empty($_POST['deck_size'])) {
        $validationErrors[] = 'Please enter your deck size.';
    }
}

$gender = $_POST['gender'] ?? null;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration of POKEMON card game tournament</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.7.5/dist/css/foundation.min.css"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
          crossorigin="anonymous">
</head>

<body>
<div class="grid-container">
    <div class="grid-x grid-padding-x align-center">
        <div class="cell medium-6">
            <h1 class="text-center">Registration of POKEMON card game tournament</h1>

            <?php
                if ($formSubmited && !$validationErrors) {
                    ?>
                    <div class="callout success">
                        <h2 class="text-center">Registration successful!</h2>
                        <div class="text-center">
                            <b>Player name: <?= $_POST['full_name'] ?></b>
                        </div>

                        <div class="text-center">
                            <img src="<?= $imageData ?>" style="max-width: 200px; max-width: 200px;">
                        </div>
                    </div>
                    <?php
                }
            ?>

            <main>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                    <?php
                        if ($validationErrors) {
                            ?>
                                <div class="callout alert">
                                    <h5>Form contains theese errors:</h5>
                                    <ul>
                                        <?php foreach ($validationErrors as $error) { echo '<li>' . $error . '</li>'; } ?>
                                    </ul>
                                </div>
                            <?php
                        }
                    ?>

                    <div class="grid-x grid-padding-x">
                        <div class="cell">
                            <label>Full Name
                                <input value="<?= $_POST['full_name'] ?? null ?>" type="text" placeholder="Enter your full name" name="full_name">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Gender</label>
                            <fieldset>
                                <input type="radio" name="gender" value="male" id="male" <?= $gender === 'male' ? 'checked' : '' ?>><label for="male">Male</label>
                                <input type="radio" name="gender" value="female" id="female" <?= $gender === 'female' ? 'checked' : '' ?>><label for="female">Female</label>
                            </fieldset>
                        </div>

                        <div class="cell">
                            <label>Email
                                <input value="<?= $_POST['email'] ?? null ?>" type="email" placeholder="Enter your email" name="email">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Phone
                                <input value="<?= $_POST['phone'] ?? null ?>" type="tel" placeholder="Enter your phone number" name="phone">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Profile Image
                                <input type="file" name="profile_image">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Name of Deck of Cards
                                <input value="<?= $_POST['deck_name'] ?? null ?>" type="text" placeholder="Enter the name of your deck" name="deck_name">
                            </label>
                        </div>

                        <div class="cell">
                            <label>Number of Cards in Deck
                                <input value="<?= $_POST['deck_size'] ?? null ?>" type="number" placeholder="Enter the number of cards in your deck" name="deck_size">
                            </label>
                        </div>

                        <div class="cell">
                            <input type="submit" value="Submit registration" class="button button-primary">
                        </div>
                    </div>
                </form>
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/foundation/6.6.3/js/foundation.min.js"></script>
</body>
</html>
