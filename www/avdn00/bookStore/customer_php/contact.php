<?php

use function PHPUnit\Framework\isEmpty;

include '../config.php';
session_start();

$user_id = $_SESSION['user_id'];


if (!isset($user_id)) {
    header('location:../login.php');
}

if (isset($_POST['send'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $number =  $_POST['number'];
    $message_contact = mysqli_real_escape_string($connection, $_POST['message']);
    $message = array();

    if (empty($name)) {
        $message[] = 'Name is empty';
    }
    if (empty($email)) {
        $message[] = 'Email is empty';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message[] = 'Email is not valid';
    }
    if (empty($number)) {
        $message[] = 'Number is empty';
    } else if (strlen($number) != 9) {
        $message[] = 'Number does not have 9 digits';
    }
    if (empty($message_contact)) {
        $message[] = 'Message is empty';
    }

    if (empty($message)) {
        $query = "INSERT INTO `message` (user_id, name, number, email, message) 
        VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("sssss", $user_id, $name, $number, $email, $message_contact);
        $stmt->execute();
        $message[] = 'Message was sent successfully';
    } else {
        $message[] = 'Message was not sent';
    }
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
        <p><a href="./home.php">home</a> / contact</p>
    </div>

    <section class="contact">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <h3>Send us a message</h3>
            <input type="text" name="name" required placeholder="enter your name" class="box" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>">
            <input type="email" name="email" required placeholder="enter your email" class="box" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>">
            <input type="text" name="number" required placeholder="enter your number" class="box" value="<?php echo isset($number) ? htmlspecialchars($number) : ''; ?>">
            <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"><?php echo isset($message_contact) ? htmlspecialchars($message_contact) : ''; ?></textarea>
            <input type="submit" value="send message" name="send" class="button">
        </form>
    </section>

    <?php include 'footer.php'; ?>
    <script src="../js/script.js"></script>

</body>

</html>