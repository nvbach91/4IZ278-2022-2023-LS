<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['room']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['room']); ?>
<?php foreach (array_filter((['room']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php
    $photoExists = $room->photo_file && Storage::disk('public')->exists('img/rooms/' . $room->photo_file);
?>

<a href="<?php echo e(url('/rooms/' . $room->id)); ?>">
    <span class="flex flex-col items-center mb-8 md:mb-0">
        <div class="min-h-[200px] w-full <?php echo e($photoExists ? 'bg-cover' : 'bg-gray-600'); ?>"
            style="<?php if($photoExists): ?> <?php echo e('background-image: url(\'' . asset('storage/img/rooms/' . $room->photo_file) . '\')'); ?> <?php endif; ?>">
        </div>
        <h3 class="text-center mt-4"><?php echo e($room->name); ?></h3>
    </span>
</a>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/components/room-card.blade.php ENDPATH**/ ?>