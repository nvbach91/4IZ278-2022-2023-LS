<div class="flex md:flex-row flex-col md:gap-8 gap-4">
    <?php if(auth()->guard()->check()): ?>
    <div class="flex md:flex-row flex-col gap-4">
        <a href="<?php echo e(url('/bookings')); ?>">Bookings</a>
        <a href="<?php echo e(url('/user')); ?>">Settings</a>
        <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit">Logout</button>
        </form>
    </div>
    <?php else: ?>
        <a href="<?php echo e(url('/login')); ?>">Login</a>
        <a href="<?php echo e(url('/register')); ?>">Register</a>
    <?php endif; ?>
</div>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/partials/_userpanel.blade.php ENDPATH**/ ?>