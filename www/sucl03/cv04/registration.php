<?php
// file:cv04/registrations.php
require_once(__DIR__ . '/libs/init.php');
require_once(__DIR__ . '/controllers/registration.php');

require_once(__DIR__ . '/libs/html-header.php');
?>
	<main class="container">
		<h1 class="text-center">LXSX registration form</h1>
		<div class="row justify-content-center">
			<form class="form-signup" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<?php if (!empty($errors_arr)): ?>
				<div class="alert <?php echo $alert_class; ?>"><?php echo implode('<br>', array_values($errors_arr)); ?></div>
				<?php endif; ?>
				<div class="form-group">
					<label>Full name</label>
					<input type="text" class="form-control<?php echo is_invalid($errors_arr, 'name'); ?>" name="name" value="<?php echo (isset($name) ? $name : ''); ?>" placeholder="Darth Vader">
					<small class="text-muted">Example: Darth Vader</small>
				</div>
				<div class="form-group">
					<label>Gender</label>
					<select class="form-control<?php echo is_invalid($errors_arr, 'gender'); ?>" name="gender">
						<option value="–">–</option>
						<option value="F"<?php echo (isset($gender) && $gender === 'F' ? ' selected' : ''); ?>>Female</option>
						<option value="M"<?php echo (isset($gender) && $gender === 'M' ? ' selected' : ''); ?>>Male</option>
					</select>
				</div>
				<div class="form-group">
					<label>E-mail</label>
					<input type="text" class="form-control<?php echo is_invalid($errors_arr, 'email'); ?>" name="email" value="<?php echo (isset($email) ? $email : ''); ?>" placeholder="user@example.tld">
					<small class="text-muted">Example: user@example.tld</small>
				</div>
				<div class="form-group">
					<label>Password (at least 8 chars)</label>
					<input type="password" class="form-control<?php echo is_invalid($errors_arr, 'password'); ?>" name="password" value="<?php echo (isset($password) ? htmlspecialchars($password, ENT_QUOTES) : ''); ?>" placeholder="@**%$&*@^(^%($%(!">
					<small class="text-muted">Example: @**%$&*@^(^%($%(!</small>
				</div>
				<div class="form-group">
					<label>Confirm password</label>
					<input type="password" class="form-control<?php echo is_invalid($errors_arr, 'confirm_password'); ?>" name="confirm_password" value="<?php echo (isset($confirm_password) ? htmlspecialchars($confirm_password, ENT_QUOTES) : ''); ?>" placeholder="@**%$&*@^(^%($%(!">
					<small class="text-muted">Example: @**%$&*@^(^%($%(!</small>
				</div>
				<div class="text-center">
					<button class="btn btn-primary" type="submit">Submit</button>
					&nbsp;
					<a class="btn btn-warning" href="<?php echo $_SERVER['REQUEST_URI']; ?>">Reset</a>
				</div>
			</form>
		</div>
	</main>
<?php
require(__DIR__ . '/libs/html-footer.php');
?>