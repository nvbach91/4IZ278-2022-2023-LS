<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'classes/Database.php';
require_once 'classes/Address.php';

$db = new Database();
$addressObj = new Address($db);
$addresses = $addressObj->getUserAddresses($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <title>E-shop</title>
    <?php include 'meta.php'; ?>
    <script src="js/script.js"></script>
</head>
<body>
<?php include 'header.php'; ?>

<form action="process_order.php" method="post">
  <label for="city">Mesto:</label><br>
  <input type="text" id="city" name="city" pattern="^[A-Za-z\s\-\.áčďéěíľĺňóôřŕšťúůýžÁČĎÉĚÍĽĹŇÓŘŔŠŤÚŮÝŽ]{1,20}$" required><br>

  <label for="postal_code">PSČ:</label><br>
  <input type="text" id="postal_code" name="postal_code" pattern="^\d{1,6}$" required><br>

  <label for="street_plus_number">Ulica a číslo domu:</label><br>
  <input type="text" id="street_plus_number" name="street_plus_number" pattern="^[A-Za-z0-9\sáčďéěíľĺňóôřŕšťúůýžÁČĎÉĚÍĽĹŇÓŘŔŠŤÚŮÝŽ]{1,30}$" required><br>

  <label for="country">Štát:</label><br>
  <select id="country" name="country" required>
    <option value="">Vyber si štát</option>
    <option value="Slovensko">Slovensko</option>
    <option value="Česko">Česko</option>
  </select><br>

  <?php if (count($addresses) > 0): ?>
    <label for="previous_addresses">Alebo si vyberte predošlú adresu:</label><br>
    <select id="previous_addresses" name="previous_address" onchange="addressSelectChanged(this)">
  <option value="">Vyber si uloženú adresu</option>
  <?php foreach($addresses as $address): ?>
    <option value="<?php echo $address['address_id']; ?>">
      <?php echo htmlspecialchars($address['city'] . ', ' . $address['postal_code'] . ', ' . $address['street_plus_number'] . ', ' . $address['country'], ENT_QUOTES, 'UTF-8'); ?>
    </option>
  <?php endforeach; ?>
</select>

  <?php endif; ?>

  <input type="submit" value="Order">
</form>

<?php include 'footer.php'; ?>

</body>
</html>
