<?php

require_once __DIR__ . '/utils/functions.php';
require_once __DIR__ . '/classes/StatusMessage.php';

use classes\statusMessage;

$fieldStatuses = [];
$email = isset($_GET['email']) ? trim($_GET['email']) : null;
$password = isset($_GET['pass']) ? trim($_GET['pass']) : null;

$user = fetchUser($email);
if (is_null($user)) {

	$fieldStatuses['notExists'] = new statusMessage('Zadaný uživatel neexistuje! Můžete se <a href="registration.php?email=' . $email . '">zaregistrovat zde</a>!', 'error');

} else {

	if ($password !== $user->password) $fieldStatuses['wrongPassword'] = new statusMessage('Neplatné heslo! <a href="login.php">Zpět na přihlášení</a>.', 'error');

}

?>
<?php $htmlTitle = 'Seznam účastníků';
require_once 'templates/htmlHeader.php'; ?>
    <main>
        <div class="d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row animation fade-in">
                    <div class="col-xl-3"></div>
                    <div class="card col-xl-6 mt-4 mb-4" style="max-height: 90vh;">
                        <div class="card-body" style="overflow-y: auto;">

							<?php if (!empty($fieldStatuses)): ?>
                                <div>
									<?php foreach ($fieldStatuses as $fieldStatus): ?>
                                        <div class="alert alert-<?php echo $fieldStatus->type ?> mt-2 mb-2"
                                             role="alert"><?php echo $fieldStatus->message ?></div>
									<?php endforeach; ?>
                                </div>
							<?php endif; ?>

							<?php if (empty($fieldStatuses)): ?>
                                <p>Přihlášen: <?php echo $user->name . ' ' . $user->surname ?> (<a href="login.php">Odhlásit se</a>)</p>
                                <p class="h3 text-center mb-4">Softball championship - seznam účastníků</p>
                                <hr>
								<?php foreach (fetchUsers() as $attendees): ?>
                                    <p><?php echo $attendees->name . ' ' . $attendees->surname . ', ' . $attendees->email . ', ' . $attendees->phone ?></p>
								<?php endforeach; endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php require_once 'templates/htmlFooter.php'; ?>