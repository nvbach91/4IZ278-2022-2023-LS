<?php
    $photoExists = $room->photo_file && Storage::disk('public')->exists('img/rooms/' . $room->photo_file);
?>

<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="flex flex-col flex-1 m-auto mt-4 py-8 lg:w-[1024px]">
        <h2 class="text-3xl text-center mb-8"><?php echo e($room->name); ?></h2>
        <section class="flex flex-row gap-4">
            <div class="min-h-[360px] min-w-[50%] mr-4 <?php echo e($photoExists ? 'bg-cover' : 'bg-gray-600'); ?>"
                style="<?php if($photoExists): ?> <?php echo e('background-image: url(\'' . asset('storage/img/rooms/' . $room->photo_file) . '\')'); ?> <?php endif; ?>">
            </div>
            <div class="ml-[-6px]">
                <p class="mb-8"><?php echo e($room->description); ?></p>
                <div class="grid grid-cols-2">
                    <div class="flex flex-col justify-between">
                        <div>
                            <p>Room size: <?php echo e($room->size); ?> m&sup2;</p>
                            <p>Hourly price rate: <strong><?php echo e($room->price); ?> &#163;</strong></p>
                        </div>
                        <a class="inline w-fit px-4 py-2 bg-gray-200 hover:underline"
                            href="<?php echo e($room->type === 'studio' ? url('/studios') : url('/rooms')); ?>">Back to listings</a>
                    </div>
                    <div>
                        <h3 class="font-semibold">Location</h3>
                        <p><?php echo e($room->city); ?></p>
                        <p><?php echo e($room->street); ?></p>
                        <p><?php echo e($room->zipcode); ?></p>
                        <p><?php echo e($room->country); ?></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="my-16">
            <h2 class="text-3xl text-center mt-4 mb-8">Booking</h2>
            <?php if(auth()->guard()->check()): ?>
                <p class="text-center">Work in progress...</p>
            <?php else: ?>
                <p class="text-center">You need to be <a class="text-blue-700" href="<?php echo e(url('/login')); ?>">logged in</a> in order to book sessions.</p>
            <?php endif; ?>
        </section>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/rooms/show.blade.php ENDPATH**/ ?>