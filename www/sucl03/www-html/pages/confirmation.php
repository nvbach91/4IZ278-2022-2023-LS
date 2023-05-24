<?php
// crossmile @ LXSX file:www-html/pages/confirmation.php

require_once(__DIR__ . '/../classes/Format.php');
require_once(__DIR__ . '/../classes/Emails.php');
$em = new Emails($config, $db);

$errors_arr = [];
$alert_class = 'alert-danger';

if (!empty($_GET['hash']))
	$hash = filter_input(INPUT_GET, 'hash', FILTER_VALIDATE_REGEXP, array('options' => array('default' => '', 'regexp' => '/^[a-zA-Z0-9]{6,80}$/')));

if (!empty($hash)) {
	try {
		$db->beginTransaction();
		$sql = sprintf('SELECT t1.id, t1.user ' .
			'FROM users_confirmation_hashes t1 ' .
			'JOIN users t2 ON t2.id = t1.user ' .
			'WHERE t1.hash = ? AND t2.status = 0 ' .
			'LIMIT 1');
		$stmt = $db->prepare($sql);
		$stmt->bindParam(1, $hash, PDO::PARAM_STR);
		$stmt->execute();
		$row = $stmt->fetchAll();
		$stmt = null;
		if (!empty($row[0]['id'])) {
			$sql = sprintf('DELETE FROM users_confirmation_hashes WHERE id = ?');
			$stmt = $db->prepare($sql);
			$stmt->bindParam(1, $row[0]['id']);
			$stmt->execute();
			$count = $stmt->rowCount();
			$stmt = null;
			if (!empty($count)) {
				$sql = sprintf('UPDATE users SET status = 2, acl = 3 WHERE id = ?');
				$stmt = $db->prepare($sql);
				$stmt->bindParam(1, $row[0]['user'], PDO::PARAM_INT);
				$stmt->execute();
				$count = $stmt->rowCount();
				$stmt = null;
				if (!empty($count)) {
					$db->commit();
					$success = true;
					$class = 'text-success';
					$confirmation_title = 'Váš nový účet byl potvrzen a na e-mail Vám byly zaslány přihlašovací údaje.';
					$confirmation_text = 'Nyní se můžete <a href="/login">přihlásit do systému</a> a poté registrovat na vybraný závod.';
					$em->userId = $row[0]['user'];
					if (!$em->emailUserReady())
						$errors_arr = ['db' => 'E-mail se nepodařilo odeslat'];
				} else {
					$db->rollBack();
					$errors_arr = ['db' => 'Účet se nepodařilo potvrdit. Zksute to za chvilku znovu.'];
				}
			}
		}
	} catch (PDOException $e) {
		$db->rollBack();
		print 'DB confirmation update failed: ' . $e->getMessage() . "<br>\n";
	}
}

if (empty($success)) {
	sleep(1);
	$class = 'text-danger';
	$confirmation_title = 'Neplatný hash.';
	$confirmation_text = 'Buď jste použili neplatný hash, nebo jste na správný neklikli v požadovaném čase.' .
		'Na potvrzení registrace máte 3 hodiny.';
}

?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom">Potvrzení registrace
				<small class="text-muted">do systému Krosové míle</small>
			</h1>
		</div>
	</div><!-- /.row -->
	<div class="row">
		<div class="col-12">
			<?php if (!empty($errors_arr)): ?>
			<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values($errors_arr)); ?></div>
			<?php endif; ?>
			<h3 class="page-header <?= $class ?>"><?= $confirmation_title ?></h3>
			<p><?= $confirmation_text ?></p>
		</div>
	</div><!-- /.row -->
</main>