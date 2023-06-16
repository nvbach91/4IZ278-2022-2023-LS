
<?php $__env->startSection('content'); ?>
<?php if(isset($message)): ?>
    <div id="message" class="message">
        <p><?php echo e($message); ?></p>
    </div>
<?php endif; ?>
<div class="goods-display">
<?php $__currentLoopData = $goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productType =>$itemClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="goods-category-holder">
    <label class="goods-category-label">
        <?php echo e(ucfirst($productType)); ?>

    </label>
</div>
    <?php $__currentLoopData = $itemClass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="goods-product-holder">
        <div class="goods-product-item">
            <img class="goods-product-item-img" src="<?php echo e($item->img); ?>" alt="<?php echo e($item->alt); ?>">
            <p class="goods-product-item-name"><?php echo e($item->name); ?></p>
            <p class="goods-product-item-description"><?php echo e($item->description); ?></p>
            <div class="goods-product-item-priceHolder">
                <label class="goods-product-item-price"><?php echo e($item->price); ?> $</label>
                <form method="POST">
                    <?php echo csrf_field(); ?>
                    <input hidden value="<?php echo e($item->id); ?>" name="item_id">
                <input type="number" name="quantity" value="1" min="1" max="<?php echo e($item->available); ?>">
                <button type="submit" class="goods-product-item-add">Add to cart</button>
            </form>
                <label>In stock: <?php echo e($item->available); ?></label>

            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="admin-buttonHolder">
        <input hidden name="productType" value="<?php echo e($productType); ?>">
        <button  id="previous<?php echo e($productType); ?>" type="button">Previous <?php echo e($productType); ?></button>
        <?php if(isset($_GET[$productType])): ?>
            <?php if(intval($_GET[$productType])<=3): ?>
            <?php for($i = 1; $i < 5; $i++): ?>
            <?php if(intval($_GET[$productType])==$i): ?>
            <a class="admin-currentOrders" href="./goods/?<?php echo e($productType); ?>=<?php echo e($i); ?>"><?php echo e($i); ?></a>
            <?php else: ?>
            <a href="./goods/?<?php echo e($productType); ?>=<?php echo e($i); ?>"><?php echo e($i); ?></a>
            <?php endif; ?>            
            <?php endfor; ?>
            <?php else: ?>
            <a href="./goods/?<?php echo e($productType); ?>=1">1</a>
            <p>..</p>
            <a href="./goods/?<?php echo e($productType); ?>=<?php echo e(intval($_GET[$productType])-1); ?>"><?php echo e(intval($_GET[$productType])-1); ?></a>
            <a class="admin-currentOrders" href="./goods/?<?php echo e($productType); ?>=<?php echo e(intval($_GET[$productType])); ?>"><?php echo e(intval($_GET[$productType])); ?></a>
            <a href="./goods/?<?php echo e($productType); ?>=<?php echo e(intval($_GET[$productType])+1); ?>"><?php echo e(intval($_GET[$productType])+1); ?></a>
            <?php endif; ?>
        <?php else: ?>
        <?php for($i = 1; $i < 5; $i++): ?>
        <?php if($i==1): ?>
        <a class="admin-currentOrders" href="./goods/?<?php echo e($productType); ?>=<?php echo e($i); ?>"><?php echo e($i); ?></a>
        <?php else: ?>
        <a href="./goods/?<?php echo e($productType); ?>=<?php echo e($i); ?>"><?php echo e($i); ?></a>
        <?php endif; ?>            
        <?php endfor; ?>
        <?php endif; ?>
        <button id="next<?php echo e($productType); ?>"  type="button">Next <?php echo e($productType); ?></button>
</div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<script src="<?php echo e(asset('js/goods.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/goods.blade.php ENDPATH**/ ?>