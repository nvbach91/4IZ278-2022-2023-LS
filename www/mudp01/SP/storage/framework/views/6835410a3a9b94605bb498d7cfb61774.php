
<?php $__env->startSection('content'); ?>
<h1 class="cart-heading">Cart contents</h1>
<?php if(!is_null(session('cart')) && !empty($items)): ?>
<?php
$totalPrice = 0;
?>
<form method="POST" id="remove-item"><?php echo csrf_field(); ?></form>
<form method="POST">
    <?php echo csrf_field(); ?>
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="cart-item">
    <input hidden name="id[]" value="<?php echo e($item['id']); ?>">
    <label>Item:</label><input class="cart-item-name" readonly name="name[]" value="<?php echo e($item['name']); ?>">
    <input readonly name="priceEach[]" value="<?php echo e($item['price']); ?> $">
    <label> each</label>
        <?php if($item['quantity']>1): ?>
        <input type="number" min="1" max="<?php echo e($item['stock']); ?>" name="quantity[]" value="<?php echo e($item['quantity']); ?>">
        <label>pieces</label>
        <button form="remove-item" name="remove_id" value="<?php echo e($item['id']); ?>" type="submit">Remove item</button>
        <?php else: ?>
        <input type="number" min="1" max="<?php echo e($item['stock']); ?>" name="quantity[]" value="<?php echo e($item['quantity']); ?>">
        <label>piece</label>
        <button form="remove-item" name="remove_id" value="<?php echo e($item['id']); ?>" type="submit">Remove item</button>
        <?php endif; ?>

    </div>
        <?php
            $totalPrice += $item['price'] * $item['quantity'];
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="cart-item-total">
    <label>Total price: </label>
    <input readonly name="totalPrice" value="<?php echo e($totalPrice); ?> $">
    </div>
    <div class="cart-item-confirm">
    <button name="confirm-order" value="true" type="submit">Place order</button>
    </div>
</form>
    
<?php else: ?>
    The cart is empty

<?php endif; ?>
<script src="<?php echo e(asset('js/cart.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/cart.blade.php ENDPATH**/ ?>