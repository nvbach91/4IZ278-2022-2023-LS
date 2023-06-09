<?php
include_once '../config.php';
session_start();

class AdminMessages
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function deleteMessage($messageId)
    {
        $query = "DELETE FROM `message` WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_bind_param($stmt, 'i', $messageId);
        mysqli_stmt_execute($stmt);
        header('Location: admin_messages.php');
        exit;
    }

    public function getMessages()
    {
        $messages = [];

        $query = "SELECT * FROM `message`";
        $stmt = mysqli_prepare($this->connection, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            while ($fetch_message = mysqli_fetch_assoc($result)) {
                $messages[] = $fetch_message;
            }
        }

        return $messages;
    }

    public function displayMessages()
    {
        $messages = $this->getMessages();

        if (!empty($messages)) {
            foreach ($messages as $message) {
                echo '<div class="box">';
                echo '<p>username: <span>' . htmlspecialchars($message['name']) . '</span></p>';
                echo '<p>number: <span>' . htmlspecialchars($message['number']) . '</span></p>';
                echo '<p>email: <span>' . htmlspecialchars($message['email']) . '</span></p>';
                echo '<p>message: <span>' . htmlspecialchars($message['message']) . '</span></p>';
                echo '<a href="admin_messages.php?delete=' . $message['id'] . '" onclick="return confirm(\'Delete this message?\')" class="delete-button">Delete</a>';
                echo '</div>';
            }
        } else {
            echo '<p class="empty">No messages</p>';
        }
    }
}

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('Location: ../login.php');
    exit;
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $adminMessages = new AdminMessages($connection);
    $adminMessages->deleteMessage($delete_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <!--font awesome cdn link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/admin_style.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <div class="window">
        <div class="logo-container">
            <div class="logo">
                <p><img alt="logo" src="../img/open-book.png"></p>
            </div>
        </div>
        <section class="messages">
            <h1 class="title">Messages</h1>
            <div class="box-container">
                <?php
                $adminMessages = new AdminMessages($connection);
                $adminMessages->displayMessages();
                ?>
            </div>
        </section>
        <section class="contact">
            <form action="email_script.php" method="post">
                <h3 class="title">Send a response!</h3>
                <label>From</label>
                <input disabled class="box" type="email" name="fromMail" id="fromMail" value="help.bookworms@gmail.com">

                <label>To</label>
                <input required autofocus class="box" type="email" name="toMail" id="toMail" value="" placeholder="enter email recipient">

                <label>Subject</label>
                <input required type="text" class="box" id="subject" name="subject" placeholder="enter message subject">

                <label>Email</label>
                <textarea required name="emailMessage" id="emailMessage" class="box" placeholder="enter your message" id="message" cols="30" rows="10"></textarea>

                <input type="submit" value="send email" name="sendEmail" class="button">
            </form>
        </section>
    </div>
    <script src="../js/admin_script.js"></script>
</body>

</html>