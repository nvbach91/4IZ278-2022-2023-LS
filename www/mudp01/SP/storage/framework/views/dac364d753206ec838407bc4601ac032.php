
<?php $__env->startSection('content'); ?>
<div class="homepage-div">
<h1 class="homepage-heading">Wellcome to eGarden!</h1>
<p>Discover the wonders of gardening at our Garden eShop. Immerse yourself in a world of lush plants,
     vibrant blooms, and thriving greenery. Explore our carefully curated selection of plants, seeds, tools,
      and accessories, designed to inspire and support your gardening journey. From beginners to seasoned enthusiasts,
       we are here to provide guidance, expert advice, and a platform for sharing your passion for nature.
        Let's cultivate beauty together!.</p>
        <div class="homepage-buttons">
            <a href="/goods/">Browse goods</a>
            <?php if(!session()->exists('id')): ?>
            <a href="/login/">Login</a>
            <a href="/register/">Register</a>
            <?php endif; ?>
        </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/homepage.blade.php ENDPATH**/ ?>