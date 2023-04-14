<?php require_once './SlidesDatabase.php';?>
<?php

$slidesDatabase = new SlidesDatabase();
$slides = $slidesDatabase->fetchAll();

?>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <?php foreach ($slides as $slide): ?>
		<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $slide['slides_id']; ?>" class="<?php echo $slide['slides_id'] == 2 ? 'active' : ''; ?>"></li>
	<?php endforeach; ?>
  </ol>
  <div class="carousel-inner">
    <?php foreach ($slides as $slide): ?>
		<div class="carousel-item <?php echo $slide['slides_id'] == 2 ? 'active' : ''; ?>">
            <img class="d-block w-50 m-auto" src="<?php echo $slide['image']; ?>" alt="<?php echo $slide['title']; ?>">
        </div>
	<?php endforeach; ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>