<?php

require_once('./SlidesDB.php');
$SlidesDB=new SlidesDB();
$slides=$SlidesDB->fetchAll();

?>
<h4 class="mb-4">Pick's of the day</h4>
<div id="topProducts" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
		<?php foreach ($slides as $slide): ?>
			<li data-target="#topProducts" data-slide-to="<?php echo $slide['id_slide'] ?>" class="<?php echo $slide['id_slide'] == 1 ? 'active' : '' ?>"></li>
		<?php endforeach; ?>
	</ol>
	<div class="carousel-inner" role="listbox">
		<?php foreach ($slides as $slide): ?>
			<div class="carousel-item slide <?php echo $slide['id_slide'] == 1 ? 'active' : '' ?>">
				<img class="d-block slide-image mb-xl-5" src="<?php echo $slide['img']; ?>" alt="Product: <?php echo $slide['title']; ?>">
				<div class="carousel-caption d-none d-md-block">
					<h3 class="slide-text"><?php echo $slide['title']; ?></h3>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<a class="carousel-control-prev" href="#topProducts" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#topProducts" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>