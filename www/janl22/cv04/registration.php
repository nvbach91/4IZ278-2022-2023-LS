<?php

require_once __DIR__ . '/utils/functions.php';
require_once __DIR__ . '/classes/StatusMessage.php';
require_once __DIR__ . '/classes/User.php';

use classes\statusMessage;
use classes\User;

$formSubmitted = !empty($_POST);
$fieldStatuses = [];
$email = isset($_GET['email']) ? trim($_GET['email']) : null;

if ($formSubmitted) {

	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$gender = isset($_POST['gender']) ? trim($_POST['gender']) : null;
	$email = trim($_POST['email']);
	$phone = trim($_POST['phone']);
	$pass = trim($_POST['pass']);
	$pass_again = trim($_POST['pass_again']);
	$gdpr = isset($_POST['gdpr']) ? trim($_POST['gdpr']) === 'on' : null;

	if (!$name) $fieldStatuses['name'] = new statusMessage('Prosím zadejte jméno!', 'error');
	if (!$surname) $fieldStatuses['surname'] = new statusMessage('Prosím zadejte příjmení!', 'error');
	if (!in_array($gender, ['M', 'F', 'X'])) $fieldStatuses['gender'] = new statusMessage('Prosím zvolte pohlaví!', 'error');
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $fieldStatuses['email'] = new statusMessage('Prosím zadejte e-mail ve správném formátu!', 'error');
	if (!preg_match("/^\+420 [0-9]{3} [0-9]{3} [0-9]{3}$/", $phone)) $fieldStatuses['phone'] = new statusMessage('Prosím zadejte telefonní číslo ve správném formátu!', 'error');
	if (empty($pass)) $fieldStatuses['pass'] = new statusMessage('Prosím zadejte heslo!', 'error');
	if ($pass !== $pass_again) $fieldStatuses['pass'] = new statusMessage('Zadaná hesla nesouhlasí!', 'error');
	if (!$gdpr) $fieldStatuses['gdpr'] = new statusMessage('Musíte souhlasit se zpracováním osobních údajů!', 'error');

	if (empty($fieldStatuses)) {

		$response = registerUser(new User($email, password_hash($pass, PASSWORD_BCRYPT), $name, $surname, $gender, $phone));
		if ($response) {
			$fieldStatuses['registration'] = new statusMessage('Registrace byla úspěšná. Prosíme, <a href="login.php?email=' . $email . '">přihlaste se zde</a>.', 'success');
		} else {
			$fieldStatuses['registration'] = new statusMessage('Zadaný uživatel existuje! Prosíme, <a href="login.php?email=' . $email . '">přihlaste se zde</a>!', 'error');
		}


	}

}

?>
<?php $htmlTitle = 'Registrace';
require_once 'templates/htmlHeader.php'; ?>
    <main>
        <div class="d-flex justify-content-center align-items-center">
            <div class="container mt-4 mb-4">
                <div class="row animation fade-in">
                    <div class="col-xl-3"></div>
                    <div class="card col-xl-6">
                        <div class="card-body">
                            <h1 class="text-center mt-4">Registrace na turnaj</h1>
                            <div class="mt-4 d-flex justify-content-center">
                                <form id="registration" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
									<?php if ($formSubmitted): ?>
                                        <div class="mb-4">
											<?php foreach ($fieldStatuses as $fieldStatus): ?>
                                                <div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
                                                     role="alert"><?php echo $fieldStatus->message ?></div>
											<?php endforeach; ?>
                                        </div>
									<?php endif; ?>

									<?php if (!isset($fieldStatuses['registration'])): ?>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <input type="text" id="name" name="name"
                                                           class="form-control <?php echo isset($fieldStatuses['name']) ? 'is-invalid' : '' ?>"
                                                           value="<?php echo $name ?? '' ?>" tabindex="1">
                                                    <label class="form-label" for="name">Jméno *</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <input type="text" id="surname" name="surname"
                                                           class="form-control <?php echo isset($fieldStatuses['surname']) ? 'is-invalid' : '' ?>"
                                                           value="<?php echo $surname ?? '' ?>" tabindex="2">
                                                    <label class="form-label" for="surname">Příjmení *</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Pohlaví *: </label>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="gender" id="gender_male"
                                                       class="form-check-input <?php echo isset($fieldStatuses['gender']) ? 'is-invalid' : '' ?>"
                                                       value="M" <?php echo isset($gender) && $gender === 'M' ? 'checked' : '' ?>
                                                       tabindex="3">
                                                <label class="form-check-label" for="gender_male">Muž</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="gender" id="gender_female"
                                                       class="form-check-input <?php echo isset($fieldStatuses['gender']) ? 'is-invalid' : '' ?>"
                                                       value="F" <?php echo isset($gender) && $gender === 'F' ? 'checked' : '' ?>
                                                       tabindex="3">
                                                <label class="form-check-label" for="gender_female">Žena</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" name="gender" id="gender_unknown"
                                                       class="form-check-input <?php echo isset($fieldStatuses['gender']) ? 'is-invalid' : '' ?>"
                                                       value="X" <?php echo isset($gender) && $gender === 'X' ? 'checked' : '' ?>
                                                       tabindex="3">
                                                <label class="form-check-label" for="gender_unknown">Nechci
                                                    uvést</label>
                                            </div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email"
                                                   class="form-control <?php echo isset($fieldStatuses['email']) ? 'is-invalid' : '' ?>"
                                                   placeholder="someone@vse.cz" value="<?php echo $email ?? '' ?>"
                                                   tabindex="4">
                                            <label class="form-label" for="email">E-mail *</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="tel" id="phone" name="phone"
                                                   class="form-control <?php echo isset($fieldStatuses['phone']) ? 'is-invalid' : '' ?>"
                                                   placeholder="+420 XXX XXX XXX" value="<?php echo $phone ?? '' ?>"
                                                   tabindex="5">
                                            <label class="form-label" for="phone">Telefon *</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="pass" name="pass"
                                                   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
                                                   value="<?php echo $pass ?? '' ?>" tabindex="7">
                                            <label class="form-label" for="pass">Heslo *</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="pass_again" name="pass_again"
                                                   class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
                                                   value="<?php echo $pass_again ?? '' ?>" tabindex="8">
                                            <label class="form-label" for="pass_again">Heslo znovu *</label>
                                        </div>

                                        <div class="form-check d-flex justify-content-center mb-4">
                                            <input type="checkbox" id="gdpr" name="gdpr"
                                                   class="form-check-input me-2 <?php echo isset($fieldStatuses['gdpr']) ? 'is-invalid' : '' ?>" <?php echo isset($gdpr) && $gdpr ? 'checked' : '' ?>
                                                   tabindex="9">
                                            <label class="form-check-label" for="gdpr">
                                                Souhlasím se zpracováním osobních údajů
                                            </label>
                                        </div>

                                        <button type="submit" class="btn btn-primary btn-block mb-4" tabindex="8">
                                            Zaregistrovat se
                                        </button>

									<?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once 'templates/htmlFooter.php'; ?>