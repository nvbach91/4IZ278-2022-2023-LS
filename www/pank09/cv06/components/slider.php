<?php if ($slides): ?>
<?php 
    $default_active_tab = 0;    
?>
<div id="slider" class="carousel slide my-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for($i = 0; $i < count($slides); $i++): ?>
        <li data-target="#slider" data-slide-to="<?php echo $i; ?>" <?php echo ($i === $default_active_tab) ? 'class="active"' : '' ?>></li>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php foreach($slides as $key => $slide): ?>
        <div class="carousel-item slide <?php echo ($key === $default_active_tab) ? 'active' : '' ?>">
            <img class="d-block img-fluid slide-image" src="<?php echo $slide['img']; ?>" alt="<?php echo $slide['title']; ?>">
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
<?php endif; ?>