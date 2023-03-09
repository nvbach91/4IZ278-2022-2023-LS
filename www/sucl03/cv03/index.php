<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('libs/post-controller.php');

require('libs/html-header.php');
?>
	<main class="container">
		<h1 class="text-center">LXSX registration form</h1>
		<h2 class="text-center">server based PHP validation</h2>
		<div class="row justify-content-center">
			<form class="form-signup" method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<?php if (!empty($cause_arr)): ?>
				<div class="alert <?php echo $alert_class; ?>"><?php echo implode('<br>', $cause_arr); ?></div>
				<?php endif; ?>
				<div class="form-group">
					<label>Full name</label>
					<input type="text" class="form-control<?php echo (in_array('name', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="name" value="<?php echo (isset($name) ? $name : '') ?>" placeholder="Darth Vader">
					<small class="text-muted">Example: Darth Vader</small>
				</div>
				<div class="form-group">
					<label>Gender</label>
					<select class="form-control" name="gender">
						<option value="F"<?php echo (isset($gender) && $gender === 'F' ? ' selected' : '') ?>>Female</option>
						<option value="M"<?php echo (isset($gender) && $gender === 'M' ? ' selected' : '') ?>>Male</option>
					</select>
				</div>
				<div class="form-group">
					<label>E-mail</label>
					<input type="text" class="form-control<?php echo (in_array('email', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="email" value="<?php echo (isset($email) ? $email : '') ?>" placeholder="user@company.tld">
					<small class="text-muted">Example: user@company.tld</small>
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input class="form-control<?php echo (in_array('phone', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="phone" value="<?php echo (isset($phone) ? $phone : '') ?>" placeholder="+420 800123456">
					<small class="text-muted">Example: +420 800123456</small>
				</div>
				<div class="form-group">
					<label>Avatar URL</label>
					<?php if (isset($avatar) && $avatar): ?>
					<img class="avatar" src="<?php echo $avatar; ?>" alt="avatar">
					<?php endif; ?>
					<input class="form-control<?php echo (in_array('avatar', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="avatar" value="<?php echo (isset($avatar) ? $avatar : '') ?>" placeholder="https://www.company.tld/img.jpg">
					<small class="text-muted">Example: https://www.company.tld/img.jpg</small>
				</div>
				<div class="form-group">
					<label>Card deck name</label>
					<input type="text" class="form-control<?php echo (in_array('cards_deck_name', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="cards_deck_name" value="<?php echo (isset($cards_deck_name) ? $cards_deck_name : '') ?>" placeholder="Casino Royale">
					<small class="text-muted">Example: Casino Royale</small>
				</div>
				<div class="form-group">
					<label>Cards deck count</label>
					<input type="number" class="form-control<?php echo (in_array('cards_deck_count', $invalid_inputs_arr) ? ' is-invalid' : '') ?>" name="cards_deck_count" value="<?php echo (isset($cards_deck_count) ? $cards_deck_count : '') ?>">
					<small class="text-muted">Example: 36</small>
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
require('libs/html-footer.php');
?>