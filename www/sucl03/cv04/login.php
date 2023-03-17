<?php
// file:cv04/login.php
require_once(__DIR__ . '/libs/init.php');
require_once(__DIR__ . '/controllers/login.php');

require_once(__DIR__ . '/libs/html-header.php');
?>
	<main class="container">
		<h1 class="text-center">LXSX login form</h1>
		<div class="row justify-content-center">
			<form class="form-signup" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<?php if (!empty($errors_arr)): ?>
				<div class="alert <?php echo $alert_class; ?>"><?php echo implode('<br>', array_values($errors_arr)); ?></div>
				<?php endif; ?>
				<div class="form-group">
					<label>E-mail</label>
					<input type="text" class="form-control<?php echo is_invalid($errors_arr, 'email'); ?>" name="email" value="<?php echo (isset($email) ? $email : ''); ?>">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control<?php echo is_invalid($errors_arr, 'password'); ?>" name="password" value="<?php echo (isset($password) ? htmlspecialchars($password, ENT_QUOTES) : ''); ?>">
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