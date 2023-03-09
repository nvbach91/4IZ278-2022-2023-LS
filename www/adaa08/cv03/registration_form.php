<?php
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
  $fullName = isset($_POST['name']) ? $_POST['name'] : '';

  $emailErr = '';
  $phoneErr = '';
  $nameErr = '';

  if (!empty($_POST)) {
    if (empty($email)) {
      $emailErr = 'Email je povinný';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'Neplatní formát emailu.';
    }

    if (empty($phone)) {
      $phoneErr = 'Tel.č. je povinný údaj.';
    } elseif (!preg_match('/^[0-9\+\-\(\)\/\s]*$/', $phone)) {
      $phoneErr = 'Neplatný formát tel.č.';
    }

    if (empty($fullName)) {
      $nameErr = 'Meno je povinné.';
    } elseif (!preg_match('/^[a-zA-Z ]*$/', $fullName)) {
      $nameErr = 'Iba písmena a voľné medzery sú povolené.';
    }

    if(empty($emailErr) && empty($phoneErr) && empty($nameErr)) {
      $email = '';
      $phone = '';
      $fullName = '';
    }
  }
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div>
    <label for="name">Meno:</label>
    <input type="text" id="name" name="name" value="<?php echo $fullName; ?>">
    <span class="error"><?php echo $nameErr; ?></span>
  </div>
  <div>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo $emailErr; ?></span>
  </div>
  <div>
    <label for="phone">Tel.č.:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
    <span class="error"><?php echo $phoneErr; ?></span>
  </div>
  <button type="submit">Registrovať sa</button>
</form>