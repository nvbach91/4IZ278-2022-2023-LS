
<?php $__env->startSection('content'); ?>
<h1>Your order was successfully placed!</h1>
<p>Thank you Mr/Ms <?php echo e($name); ?> for shopping with us. After your payment for the order of total <?php echo e($price); ?>$ is made, we start with shipping. Also we will notice you on your email <?php echo e($email); ?>.</p>
<p>Once again, thank you!</p>
<a href="./">Ok</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/confirmOrder.blade.php ENDPATH**/ ?>