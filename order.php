<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>E-shop</title>
    <?php include 'meta.php'; ?>
</head>
<body>
<?php include 'header.php'; ?>

<form action="process_order.php" method="post">
  <label for="city">Mesto:</label><br>
  <input type="text" id="city" name="city" required><br>
  <label for="postal_code">PSČ:</label><br>
  <input type="text" id="postal_code" name="postal_code" required><br>
  <label for="street_plus_number">Ulica a číslo domu:</label><br>
  <input type="text" id="street_plus_number" name="street_plus_number" required><br>
  <label for="country">Štát:</label><br>
  <input type="text" id="country" name="country" required><br>
  <input type="submit" value="Order">
</form>

<?php include 'footer.php'; ?>

</body>
</html>
