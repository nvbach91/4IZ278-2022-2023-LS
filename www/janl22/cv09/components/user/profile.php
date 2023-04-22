<?php if (!isLoggedIn()) header('Location: login.php'); ?>

<div class="d-flex justify-content-center align-items-center">
	<div class="container">
		<div class="row animation fade-in">
			<div class="col-xl-3"></div>
			<div class="card col-xl-6 mt-4 mb-4">
				<div class="card-body">

					<p class="h3 text-center mb-4">Customer profile</p>
					<hr>
					<p><b>E-mail:</b> <?php echo getUser()->mail ?></p>
					<p><b>Name:</b> <?php echo getUser()->name ?></p>
					<p><b>Surname:</b> <?php echo getUser()->surname ?></p>

				</div>
			</div>
		</div>
	</div>
</div>
