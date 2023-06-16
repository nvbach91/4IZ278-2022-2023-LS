<?php require_once './SpotlightDatabase.php'; ?>
<?php
$spotlightDB = new SpotlightDatabase();
$spotlightListings = $spotlightDB->fetchAll();
?>

<div id="carouselExampleIndicators" class="carousel slide">
    <ol class="carousel-indicators">
        <?php foreach ($spotlightListings as $index => $listing) : ?>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : '' ?>"></li>
        <?php endforeach; ?>
    </ol>
    <div class="carousel-inner">
        <?php foreach ($spotlightListings as $index => $listing) : ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : '' ?>">
                <div class="image-container">
                    <img src="<?php echo htmlspecialchars($listing["images"][0]["image_data"]) ?>" alt="Image for <?php echo htmlspecialchars($listing['model']); ?>" class="d-block w-100 image">
                </div>
                <div class="carousel-caption d-none d-md-block">
                    <h4><?php echo htmlspecialchars($listing['price']) . ' ' . ' € '; ?></h4>
                    <h5 class="fw-bold"><?php echo htmlspecialchars($listing['manufacturer']) . ' ' . htmlspecialchars($listing['model']); ?></h5>
                    <p><?php echo htmlspecialchars($listing['color']) . ' ' . htmlspecialchars($listing['year']) . ' ' . htmlspecialchars($listing['mileage']) . ' km, ' . htmlspecialchars($listing['fuel']) . ', ' . htmlspecialchars($listing['transmission']); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Predchadzajuci</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Nasledujuci</span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var myCarousel = document.querySelector('#carouselExampleIndicators')
        var carousel = new bootstrap.Carousel(myCarousel)
    });
</script>