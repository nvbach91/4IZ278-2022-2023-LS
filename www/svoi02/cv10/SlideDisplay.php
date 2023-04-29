<?php require_once './SlidesDatabase.php'; ?>
<?php


$slidesDB = new SlidesDatabase();
$slides = $slidesDB->fetchAll();

?>

<div id="carouselExampleControls" class="carousel slide my-5" data-bs-ride="carousel">
    <div class="carousel-inner bg-dark">
        <?php foreach ($slides as $slide) : ?>
            <div class="carousel-item <?php echo $slide['slide_id'] == 1 ? 'active' : ''; ?>">
                <img src="<?php echo $slide['img']; ?>" class="d-block w-auto mx-auto" style="height: 300px" alt="<?php echo $slide['title']?>">
            </div>
        <?php endforeach; ?>

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
