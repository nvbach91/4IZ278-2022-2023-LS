
<div class="w-1/2 m-auto relative">
    <div class="flex aspect-[4/3] overflow-auto snap-mandatory scroll-smooth rounded-lg">
        <?php foreach ($slides as $slide) : ?>
        <img id="<?php echo $slide["slide_id"] ?>" src="<?php echo $slide["img"] ?>" alt="<?php echo $slide["title"] ?>" class="flex-[1_0_100%] w-auto object-cover">
        <?php endforeach; ?>
    </div>
</div>
