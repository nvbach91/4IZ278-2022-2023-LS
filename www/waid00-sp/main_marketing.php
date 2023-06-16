<?php
session_start();
include_once("by_detection.php");
include_once("by_database.php");
if ($_SESSION["privilege"] < 2){
  header("Location: main_news.php");
  exit();
}
if (isset($_POST["write_email"])) {
  header('Location: main_contacts.php');
}
if (isset($_POST['addMyWork'])) {
  $data = $conn->prepare("INSERT INTO `_dmp_marketing` (`ID`, `subject`, `obsah`, `username`, `time`, `_dmp_users_ID`) VALUES (NULL, ?, ?, ?, CURRENT_DATE, ?)");
  $data->execute([$_POST["subject"], $_POST["text_mail"], $_SESSION["user"], $_SESSION["iduser"]]);
  $_SESSION['subject'] = $_POST['subject'];
  $_SESSION['text_mail'] = $_POST['text_mail'];
  $data = $conn->prepare("SELECT `mail` FROM `_dmp_users` WHERE `confirmed` = '1'");
  $data->execute();
  foreach ($data as $mails) {
    $mail = $mails['mail'];
    $to = $mail;
    $subject = $_SESSION['subject'];
    $message =
    '<!DOCTYPE html>
    <html lang="cs" dir="ltr">
    <head>
    <meta charset="utf-8">
    <title>DwGym</title>
    </head>
    <body>
    <h1>DwGym</h1>
    '.$_SESSION['text_mail'].'
    <p style="  font-style: italic;">This is a business message (obchodní sdělení in Czech). You consented to the sending of an email when registering on this website. Click <a href="http://david.pohena.com/by_redirect_mail.php">here</a> to unsubscribe.</p>
    <p>David Wais, DwGym</p>
    </body>
    </html>';
    $headers = 'From: davidwais14@gmail.com'."\r\n".
    'Reply-to: davidwais14@gmail.com'."\r\n".
    'X-Mailer: PHP/'. phpversion()."\r\n".
    'Content-Type: text/html; charset=UTF-8';
    mail($to, $subject, $message, $headers);
  }
  unset($_SESSION['text_mail']);
  unset($_SESSION['subject']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DwGym - Marketing</title>
  <link rel="stylesheet" href="css/contacts.css">
  <link rel="icon" href="" type="image/x-icon"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
  <script src="https://cdn.tiny.cloud/1/j8x5icayo126hiktp7gtz58j31m7i1jxt67my9mwklbb6b3q/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
  tinymce.init({
    selector:'textarea',
    height: "325px",
  });</script>
  <?php
  include('main_header_style.php');
  ?>
</head>
<body>
  <?php include_once('main_header.php'); ?>
  <form method="post">
    <input type="Submit" name="write_email" value="Back to Contacts" class="write_email">
    <div class='news'>
      <label for="Title" class="titleText">Subject</label>
      <input type="text" name="subject" class="title" placeholder="Write a subject..">
      <label for="text" class="text_mailText">E-mail</label>
      <div class="text_marketing">
        <textarea name="text_mail" rows="8" cols="80"  placeholder="Write your interesting advertisement.."></textarea>
      </div>

      <input type="submit" name="addMyWork" value="Send it" class="addMyWork">
    </div>
  </form>
</div>
</body>
</html>
