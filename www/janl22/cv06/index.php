<?php require_once __DIR__ . '/templates/header.php'; ?>
<?php require_once __DIR__ . '/components/navigation.php'; ?>
<div class="container px-4 px-lg-5 mt-5">
	<?php if(!isset($_GET['category'])) require_once __DIR__ . '/components/slidesDisplay.php'; ?>
	<?php require_once __DIR__ . '/components/productDisplay.php'; ?>
</div>
<?php require_once __DIR__ . '/templates/footer.php'; ?>