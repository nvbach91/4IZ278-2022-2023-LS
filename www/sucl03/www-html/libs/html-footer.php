<?php
// crossmile @ LXSX file:www-html/libs/html-footer.php
?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div class="social-networks">
						<a href="https://www.facebook.com/skmilepraha/" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f fa-2x"></i></a>
						<a href="https://www.instagram.com/skmilepraha/" target="_blank" rel='noopener noreferrer'><i class="fab fa-instagram fa-2x"></i></a>
						<a href="https://skmile.rajce.idnes.cz/" target="_blank" rel='noopener noreferrer'><i class="far fa-images fa-2x"></i></a>
						<a href="https://www.youtube.com/channel/UCWj8hP7RnttijiykVq2iGrQ/" target="_blank" rel="noopener noreferrer"><i class="fab fa-youtube fa-2x"></i></a>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-copyright">
			<p>&copy; 2023–<?= date('Y'); ?> <a href="//www.lxsx.cz" target="_blank" rel="noopener">LXSX</a> <span class="text-muted"><?php $eta += hrtime(true); echo round($eta/1e+6, 2) . ' ms'; ?></span></p>		
		</div>
	</footer>
	<button id="back-to-top" class="btn btn-primary btn-lg back-to-top d-none" title="Klikni pro návrat nahoru" data-bs-toggle="tooltip" data-bs-placement="left"><i class="fas fa-arrow-up"></i></button>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script src="/js/main.js"></script>
	<?php if ($page == 'signup'): ?>
	<script src="https://www.google.com/recaptcha/api.js"></script>
	<?php endif; ?>
</body>
</html>