<footer class="bg-gray-900">
    <div class="lg:w-[1024px] py-8 m-auto text-white grid grid-cols-2">
        <div>
            <h2 class="mb-4">Rooms in cities:</h2>
            <?php $__currentLoopData = \App\Models\Address::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($address->city); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-right">
            <nav>
                <ul class="flex flex-col">
                    <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                    <li><a href="<?php echo e(url('/rooms')); ?>">Rehearsal rooms</a></li>
                    <li><a href="<?php echo e(url('/studios')); ?>">Studio rooms</a></li>
                    <li><a href="<?php echo e(url('/about')); ?>">About</a></li>
                    <li><a href="<?php echo e(url('/contact')); ?>">Contact</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="text-center text-sm text-white mb-8">Copyright &copy; 2023, SoundChecker</div>
</footer><?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/partials/_footer.blade.php ENDPATH**/ ?>