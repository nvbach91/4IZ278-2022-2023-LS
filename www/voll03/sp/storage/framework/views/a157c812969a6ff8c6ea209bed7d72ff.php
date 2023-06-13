<?php if(session()->has('message')): ?>
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 px-8 py-4 bg-gray-800 text-white">
        <p><?php echo e(session('message')); ?></p>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/components/flash-message.blade.php ENDPATH**/ ?>