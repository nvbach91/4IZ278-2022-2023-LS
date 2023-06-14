
<?php $__env->startSection('content'); ?>
<?php if(isset($message)): ?>
    <div id="message" class="message">
        <p><?php echo e($message); ?></p>
    </div>
<?php endif; ?>
<div class="goods-display">
<?php
    $productType = null;
?>
<?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $good): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($good->product_type != $productType): ?>
<div class="goods-category-holder">
    <label class="goods-category-label">
        <?php echo e($good->product_type); ?>

    </label>
</div>
<?php
    $productType = $good->product_type;
?>
<?php endif; ?>


    <div class="goods-product-holder">
        <div class="goods-product-item">
            <img class="goods-product-item-img" src="<?php echo e($good->img); ?>" alt="<?php echo e($good->alt); ?>">
            <p class="goods-product-item-name"><?php echo e($good->name); ?></p>
            <p class="goods-product-item-description"><?php echo e($good->description); ?></p>
            <div class="goods-product-item-priceHolder">
                <label class="goods-product-item-price"><?php echo e($good->price); ?> $</label>
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <input hidden value="<?php echo e($good->id); ?>" name="item_id">
                <button type="submit" class="goods-product-item-add">Add to cart</button>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo e($good->available); ?>">
                <label>In stock: <?php echo e($good->available); ?></label>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/goods.blade.php ENDPATH**/ ?>