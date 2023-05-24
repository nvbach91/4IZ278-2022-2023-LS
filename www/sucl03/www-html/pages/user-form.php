<?php
// crossmile @ LXSX file:www-html/pages/user-form.php
?>
	<!-- user-form -->
	<div class="row d-flex justify-content-center">
		<div class="<?= ($page == 'signup' ? '' : '') ?> col-xs-12">
			<form class="form" id="user-form" method="post" action="<?= $_SERVER['REQUEST_URI']; ?>">
				<input type="hidden" id="user_form" name="user_form" value="1">
				<input type="hidden" id="user_id" name="user_id" value="0">
				<?php if (!empty($errors_arr)): ?>
				<div class="alert <?= $alert_class; ?>"><?= implode('<br>', array_values((array)$errors_arr)); ?></div>
				<?php endif; ?>
				<div class="form-group mb-3">
					<label for="email">E-mail</label>
					<input type="email" class="form-control <?= isInvalid($errors_arr, 'email'); ?>" id="email" name="email" autocomplete="email" value="<?= (isset($user_arr['email']) ? $user_arr['email'] : ''); ?>" placeholder="platný e-mail" required <?= ($page == 'profile' ? 'readonly' : ''); ?>>
				</div>
				<div class="form-group mb-3">
					<label for="password">Heslo</label>&nbsp;<span class="cursor-pointer" id="passwd-toggle" title="Zobrazit/Skrýt heslo"><i class="far fa-eye"></i></span>
					<input type="password" class="form-control <?= isInvalid($errors_arr, 'password'); ?>" id="password" name="password" autocomplete="new-password" value="<?= (isset($user_arr['password']) ? $user_arr['password'] : ''); ?>" placeholder="heslo, nejméně 6 znaků" minLength="6" maxLength="32" required>
				</div>
				<div class="form-group mb-3">
					<label for="confirm_password">Heslo pro kontrolu</label>
					<input type="password" class="form-control <?= isInvalid($errors_arr, 'confirm_password'); ?>" id="confirm_password" name="confirm_password" value="<?= (isset($user_arr['confirm_password']) ? $user_arr['confirm_password'] : ''); ?>" placeholder="heslo pro kontrolu" minLength="6" maxLength="32" required>
				</div>
				<div class="form-group mb-3">
					<label for="last_name">Příjmení</label>
					<input type="text" class="form-control <?= isInvalid($errors_arr, 'last_name'); ?>" id="last_name" name="last_name" autocomplete="family-name" value="<?= (isset($user_arr['last_name']) ? $user_arr['last_name'] : ''); ?>" placeholder="příjmení, 2–32 znaků" minLength="2" maxLength="32" required>
				</div>
				<div class="form-group mb-3">
					<label for="first_name">Jméno</label>
					<input type="text" class="form-control <?= isInvalid($errors_arr, 'first_name'); ?>" id="first_name" name="first_name" autocomplete="given-name" value="<?= (isset($user_arr['first_name']) ? $user_arr['first_name'] : ''); ?>" placeholder="jméno, 2–32 znaků" minLength="2" maxLength="32" required>
				</div>
				<div class="form-group mb-3">
					<label for="gender">Pohlaví</label>
					<select class="form-select <?= isInvalid($errors_arr, 'gender'); ?>" id="gender" name="gender">
						<option value="X" <?= (!isset($user_arr['gender']) ? 'selected' : ''); ?> disabled>- vyberte -</option>
						<option value="1" <?= (isset($user_arr['gender']) && $user_arr['gender'] == '1' ? 'selected' : ''); ?>>žena</option>
						<option value="2" <?= (isset($user_arr['gender']) && $user_arr['gender'] == '2' ? 'selected' : ''); ?>>muž</option>
					</select>
				</div>
				<div class="form-group mb-3">
					<label for="birthday">Datum narození</label>
					<input type="date" class="form-control <?= isInvalid($errors_arr, 'birthday'); ?>" id="birthday" name="birthday" autocomplete="bday" value="<?= (isset($user_arr['birthday']) ? $user_arr['birthday'] : ''); ?>" min="1900-01-01" max="2099-12-31" required>
				</div>
				<div class="form-group mb-3">
					<label for="club">Klub / tým</label>
					<input type="text" class="form-control <?= isInvalid($errors_arr, 'club'); ?>" id="club" name="club" list="club_suggests" autocomplete="off" value="<?= (isset($user_arr['club']) ? $user_arr['club'] : ''); ?>" placeholder="vyberte jméno klubu z nabídky" minLength="2" maxLength="64" required>
					<datalist id="club_suggests">
						<option value="Neregistrovaný">
						<?php foreach ($clubs_cas_arr as $club_cas): ?>
						<option value="<?= $club_cas; ?>">
						<?php endforeach; ?>
					</datalist>
				</div>
				<?php if ($page == 'profile'): ?>
				<div class="input-group input-group mb-3">
					<input type="text"
						class="form-control"
						aria-label="skmile"
						aria-describedby="lg-skmile"
						value="Přihlášení pomocí SK Míle <?= (!empty($_SESSION['user_oauth2']) && $_SESSION['user_oauth2'] == 'SKMILE' ? 'aktivní' : ''); ?>" disabled>
					<a href="<?= (!empty($user_arr['oauth2_skmile']) ? '/oauth2-unpair-skmile' : $skmile_client->createAuthUrl()); ?>"
						class="oauth2-pairing btn btn-<?= (!empty($user_arr['oauth2_skmile']) ? 'danger' : 'success'); ?> input-group-text"
						id="lg-skmile">
						<?= (!empty($user_arr['oauth2_skmile']) ? 'Odpárovat' : '&nbsp;Spárovat&nbsp;&nbsp;'); ?>
					</a>
				</div>
				<div class="input-group input-group mb-3">
					<input type="text"
						class="form-control"
						aria-label="google"
						aria-describedby="lg-google"
						value="Přihlášení pomocí GOOGLE <?= (!empty($_SESSION['user_oauth2']) && $_SESSION['user_oauth2'] == 'GOOGLE' ? 'aktivní' : ''); ?>" disabled>
					<a href="<?= (!empty($user_arr['oauth2_google']) ? '/oauth2-unpair-google' : $google_client->createAuthUrl()); ?>"
						class="oauth2-pairing btn btn-<?= (!empty($user_arr['oauth2_google']) ? 'danger' : 'success'); ?> input-group-text"
						id="lg-google">
						<?= (!empty($user_arr['oauth2_google']) ? 'Odpárovat' : '&nbsp;Spárovat&nbsp;&nbsp;'); ?>
					</a>
				</div>
				<div class="input-group input-group mb-3">
					<input type="text"
						class="form-control"
						aria-label="github"
						aria-describedby="lg-github"
						value="Přihlášení pomocí GITHUB <?= (!empty($_SESSION['user_oauth2']) && $_SESSION['user_oauth2'] == 'GITHUB' ? 'aktivní' : ''); ?>" disabled>
					<a href="<?= (!empty($user_arr['oauth2_github']) ? '/oauth2-unpair-github' : $github_client->createAuthUrl()); ?>"
						class="oauth2-pairing btn btn-<?= (!empty($user_arr['oauth2_github']) ? 'danger' : 'success'); ?> input-group-text"
						id="lg-github">
						<?= (!empty($user_arr['oauth2_github']) ? 'Odpárovat' : '&nbsp;Spárovat&nbsp;&nbsp;'); ?>
					</a>
				</div>
				<?php endif; ?>
				<?php if ($page == 'signup' && empty($_SESSION['oauth2_email'])): ?>
				<div class="form-group mb-3" id="re-captcha">
					<div class="g-recaptcha" data-sitekey="<?= $config['GRECAPTCHA_SITEKEY'] ; ?>"></div>
				</div>
				<?php endif; ?>
				<?php if ($page == 'users'): $_disabled = ($as->aclCheck($app_acl['admin']) ? '' : 'disabled'); ?>
				<div class="form-group mb-3">
					<label>Uživatelská práva</label><br>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_admin" value="4" <?= $_disabled ?>><label class="form-check-label" for="acl_admin">Admin</label></div><br>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_login" value="1" <?= $_disabled ?>><label class="form-check-label" for="acl_login">Login</label></div>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_register" value="2" <?= $_disabled ?>><label class="form-check-label" for="acl_register">Register</label></div><br>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_users_r" value="8" <?= $_disabled ?>><label class="form-check-label" for="acl_users_r">Users R</label></div>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_users_w" value="16" <?= $_disabled ?>><label class="form-check-label" for="acl_users_w">Users W</label></div><br>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_races_r" value="32" <?= $_disabled ?>><label class="form-check-label" for="acl_races_r">Races R</label></div>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_races_w" value="64" <?= $_disabled ?>><label class="form-check-label" for="acl_races_w">Races W</label></div><br>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_registrations_r" value="128" <?= $_disabled ?>><label class="form-check-label" for="acl_registrations_r">Registrations R</label></div>
					<div class="form-check form-check-inline"><input class="form-check-input" type="checkbox" id="acl_registrations_w" value="256" <?= $_disabled ?>><label class="form-check-label" for="acl_registrations_w">Registrations W</label></div>
				</div>
				<?php endif; ?>
				<div class="text-center">
					<button class="btn btn-primary" type="submit"><?= ($page == 'signup' ? 'Registrovat' : 'Uložit'); ?></button>
					&nbsp;
					<?php if ($page == 'users'): ?>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<?php else: ?>
					<button class="btn btn-warning" type="button">Reset</button>
					<?php endif; ?>
				</div>
			</form>
		</div>
	</div><!-- /.row -->