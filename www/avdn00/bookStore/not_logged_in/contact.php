<?php


if (isset($_POST['send'])) {
    $message[] = 'To send us a message you need to log in or register';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="heading">
        <h3>Contact us</h3>
        <p><a href="../index.php">home</a> / contact</p>
    </div>

    <section class="contact">
        <form action="" method="post">
            <h3>Send us a message</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box">
            <input type="email" name="email" required placeholder="enter your email" class="box">
            <input type="text" name="number" required placeholder="enter your number" class="box">
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
            <input type="submit" value="send message" name="send" class="button">
        </form>
    </section>

    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>