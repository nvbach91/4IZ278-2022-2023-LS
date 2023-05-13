<?php
// crossmile @ LXSX file:www-html/pages/403_404.php

if (!empty($page) && $page == '403') {
	$err_number = '403';
	$err_text = 'K požadované stránce nemáte přístup.';
} else { //404
	$err_number = '404';
	$err_text = 'Požadovaná stránka neexistuje.';
}
?>
<main class="container">
	<div class="row">
		<div class="col-12">
			<h1 class="pb-2 mt-4 mb-4 border-bottom"><?= $err_number ?>
				<small class="text-muted"><?= $err_text ?></small>
			</h1>
		</div>
	</div><!-- /.row -->

	<div class="row">
		<div class="col-12">
			<p>
				Zde jsou některé užitečné odkazy, které vám pomohou zpátky na&nbsp;trať:
			</p>
			<ul>
				<li>
					<a href="//www.skmile.cz">SK Míle</a>
				</li>
				<li>
					<a href="/">Krosová míle</a>
				</li>
				<li>
					<a href="/event-sign-up">Přihlášení</a>
				</li>
			</ul>
		</div>
	</div><!-- /.row -->
</main>