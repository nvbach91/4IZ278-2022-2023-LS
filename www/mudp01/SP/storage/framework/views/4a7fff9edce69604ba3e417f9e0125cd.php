
<?php $__env->startSection('content'); ?>
<div class="homepage-div">
<h1>Orders</h1>
<?php if(count($orders)>0): ?>
<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div>
    <h2>Order ID: <?php echo e($order->id); ?></h2>
<p>Created: <?php echo e($order->created); ?></p>
<p>State: <?php echo e($order->state); ?></p>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
No orders found.    
<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/myOrders.blade.php ENDPATH**/ ?>