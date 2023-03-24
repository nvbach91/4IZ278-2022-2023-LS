<?php require_once __DIR__ . '/../db/SlidesDB.php'; ?>

<?php 
$slidesDB = new SlidesDB();
$slides = $slidesDB->fetchAll();

// $slides = [
//     ['slide_id' => 1, 'img' => 'https://listaka.com/wp-content/uploads/2015/06/Langra.jpg', 'alt' => 'First slide'],
//     ['slide_id' => 2, 'img' => 'https://upload.wikimedia.org/wikipedia/commons/e/ee/Mango_and_cross_section_edit.jpg', 'alt' => 'Second slide'],
//     ['slide_id' => 3, 'img' => 'https://img-aws.ehowcdn.com/877x500p/cpi.studiod.com/www_ehow_com/photos.demandstudios.com/getty/article/228/233/124812932.jpg', 'alt' => 'Third slide']
// ];
?>

<div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php foreach($slides as $index=>$slide): ?>
        <li data-target="#slider" data-slide-to="<?php echo $index; ?>" class="<?php echo $index == 0 ? 'active' : ''; ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $index=>$slide): ?>
        <div class="carousel-item slide <?php echo $index == 0 ? 'active' : ''; ?>">
            <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['alt']; ?>">
        </div>
        <?php endforeach; ?>
    </div>
    <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>