<?php

require_once __DIR__ . '/utils/functions.php';
require_once __DIR__ . '/classes/StatusMessage.php';

$formSubmitted = !empty($_POST);
$fieldStatuses = [];
$email = isset($_GET['email']) ? trim($_GET['email']) : null;

if ($formSubmitted) {

	$email = isset($_POST['email']) ? trim($_POST['email']) : null;
	$password = isset($_POST['pass']) ? trim($_POST['pass']) : null;

	$fieldStatuses = authenticateUser($email, $password);

}

?>
<?php $htmlTitle = 'Přihlášení';
require_once 'templates/htmlHeader.php'; ?>
    <main>
        <div class="d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row animation fade-in">
                    <div class="col-xl-3"></div>
                    <div class="card col-xl-6 mt-4 mb-4">
                        <div class="card-body">

                            <p class="h3 text-center mb-4">Softball championship</p>

                            <form id="login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

								<?php if ($formSubmitted): ?>
                                    <div class="mb-4">
										<?php foreach ($fieldStatuses as $fieldStatus): ?>
                                            <div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
                                                 role="alert"><?php echo $fieldStatus->message ?></div>
										<?php endforeach; ?>
                                    </div>
								<?php endif; ?>

                                <div class="form-outline mb-4">
                                    <input type="email" id="email" name="email"
                                           class="form-control <?php echo isset($fieldStatuses['email']) ? 'is-invalid' : '' ?>"
                                           placeholder="someone@vse.cz" value="<?php echo $email ?? '' ?>" tabindex="1">
                                    <label class="form-label" for="email">E-mail *</label>
                                </div>

                                <div class="form-outline mb-4">
                                    <input type="password" id="pass" name="pass"
                                           class="form-control <?php echo isset($fieldStatuses['pass']) ? 'is-invalid' : '' ?>"
                                           value="<?php echo $password ?? '' ?>" tabindex="2">
                                    <label class="form-label" for="pass">Heslo *</label>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block mb-4" tabindex="3">Přihlásit se</button>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once 'templates/htmlFooter.php'; ?>