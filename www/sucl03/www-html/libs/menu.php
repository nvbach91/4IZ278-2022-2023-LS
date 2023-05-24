<?php
// crossmile @ LXSX file:www-html/libs/menu.php
?>
<header>
	<nav id="lxsx-menu" class="navbar navbar-expand-md navbar-dark fixed-top" style="background-color: #343a40;">
		<div class="container">
			<a class="navbar-brand" href="https://www.skmile.cz"><img class="img-fluid" style="height:25px;min-width:102px;" src="https://www.skmile.cz/images/sk_mile_logo_inv.png" alt="SK Míle"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarCollapse">
				<ul class="navbar-nav me-auto">
					<li class="nav-item">
						<a class="nav-link <?= ($page == 'index' ? 'active' : '') ?>" href="/">Krosová míle</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($page == 'races' ? 'active' : '') ?>" href="/races">Seznam závodů</a>
					</li>
					<li class="nav-item <?= ($as->aclCheck($app_acl['users_r']) ? '' : 'd-none') ?>">
						<a class="nav-link <?= ($page == 'users' ? 'active' : '') ?>" href="/users">Správa uživatelů</a>
					</li>
					<li class="nav-item <?= ($as->isLogged() ? '' : 'd-none') ?>">
						<a class="nav-link <?= ($page == 'profile' ? 'active' : '') ?>" href="/profile">Uživatelský profil</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($page == 'login' ? 'active' : '') ?>" href="/<?= ($as->isLogged() ? 'logout' : 'login') ?>"><?= ($as->isLogged() ? 'Odhlásit' : 'Přihlásit') ?></a>
					</li>
					<li class="nav-item <?= ($as->isLogged() ? '' : 'd-none') ?>">
						<a class="nav-link disabled" href="#"><?= ($as->isLogged() ? $_SESSION['user_email'] : '') ?></a>
					</li>
					<li class="nav-item <?= ($as->isLogged() ? 'd-none' : '') ?>">
						<a class="nav-link <?= ($page == 'signup' ? 'active' : '') ?>" href="/signup">Vytvořit účet</a>
					</li>
				</ul> 
			</div>
		</div>
	</nav>
</header>