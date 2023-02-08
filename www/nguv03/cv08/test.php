<?php
/* Write your PHP code here */
$password = 'myseriouslystrongpassword';
$password_hash = password_hash($password, PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <input value="<?php echo $password_hash; ?>">
    <br>
    <input value="<?php echo password_verify($password, '$2y$10$t/lFLaHYVkc55DAQZGg7O.nJHvUojgAhebanPaHH2Bnd5a6Tw3nbi') ? 'TRUE' : 'FALSE'; ?>">
</body>
</html>

