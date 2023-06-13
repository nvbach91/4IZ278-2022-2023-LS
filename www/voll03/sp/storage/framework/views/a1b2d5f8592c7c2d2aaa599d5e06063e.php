<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="flex flex-col flex-1 m-auto mt-4 p-8 lg:w-[1088px]">
        <h2 class="text-3xl text-center mb-12">Rehearse and Record Easily</h2>
        <p>Unleash your musical potential with SoundChecker, the go-to platform for musicians in search of the perfect
            space to rehearse and fine-tune their sound. Whether you're an aspiring solo artist, a tight-knit band, or a
            dynamic musical ensemble, our cutting-edge app connects you with premium studio rooms designed to elevate
            your musical journey.</p>
        <div>Pictures of rehearsal rooms here</div>
        <p>Join a vibrant community of musicians, connect with fellow artists, and foster collaborations that push your
            music to new heights. SoundChecker provides a platform where you can exchange ideas, seek valuable advice,
            and celebrate shared triumphs together.</p>
        <a href="<?php echo e(url('/rooms')); ?>">Book a session</a>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/home.blade.php ENDPATH**/ ?>