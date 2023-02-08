<?php
//odeslani HTML mailu pres php
if (isset($_POST['save'])) {
    # http://php.net/manual/en/function.mail.php
    # SMTP auth, v php.ini: https://support.google.com/a/answer/176600?hl=cs
    $errors = "";
        
    if (!filter_var($_POST['to'], FILTER_VALIDATE_EMAIL)) {
        $errors = "To is invalid email!<br>";
    }
    if (empty($_POST['subject'])){
        $errors = $errors."Subject can't be blank!<br>";
    }
    
    if (empty($_POST['message'])){
        $errors = $errors."Message can't be blank!<br>";
    }
    
    if (!$errors){
        header('Location: sent.php');
        //exit();
    }
    $to      = $_POST['to'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    
    $html = "
    <html>
    <head>
      <title>Sweet Messages</title>
    </head>
    <body>
     
     $message
     
    </body>
    </html>
    ";
    
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-type: text/html; charset=UTF-8"; #pozor, musime mit text/html
    $headers[] = "From: Nguyen Viet Bach <nguv03@vse.cz>";
    $headers[] = "Reply-To: Nguyen Viet Bach <nguv03@vse.cz>";
    mail($to, $subject, $html, implode("\r\n", $headers));
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Mailing app</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/cosmo/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div style="color: red">
            <?php if (isset($errors)) { echo $errors; } ?>
        </div>
        <form action="" method="POST" id="myForm">
            <h2>Email app</h2>
            <div class="form-group">
                <label>To:</label>
                <input class="form-control" type="text" name="to" value="<?php if (isset($_POST['to'])){echo $_POST['to'];} ?>">
            </div>
            <div class="form-group">
                <label>Subject:</label>
                <input class="form-control" type="text" name="subject" value="<?php if (isset($_POST['subject'])){echo $_POST['subject'];} ?>">
            </div>
            <div class="form-group">
                <label>Message:</label>
                <textarea class="form-control" name="message"><?php if (isset($_POST['message'])){echo $_POST['message'];} ?></textarea>
            </div>
            <input type="hidden" name="save" value="1">
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
</body>
</html>
