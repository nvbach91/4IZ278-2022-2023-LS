<?php if (isset($component)) { $__componentOriginal71c6471fa76ce19017edc287b6f4508c = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="m-auto mt-4 p-8 lg:w-[1024px] w-full flex flex-col items-center">
        <h2 class="text-3xl">Registration</h2>
        <form method="POST" action="<?php echo e(route('registration')); ?>" class="m-8 p-8 w-[400px] bg-gray-100">
            <?php echo csrf_field(); ?>
            <div class="flex items-center mt-2 mb-2">
                <label for="name" class="w-[128px]">Name</label>
                <input id="name" name="name" type="text" value="<?php echo e(old('name')); ?>" required
                    class="grow m-1 p-1 text-black">
            </div>
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="flex items-center mt-2 mb-2">
                <label for="email" class="w-[128px]">Email</label>
                <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                    class="grow m-1 p-1 text-black">
            </div>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <small class="opacity-70">Example: jack@oneill.com</small>
            <div class="flex items-center mt-2 mb-2">
                <label for="password" class="w-[128px]">Password</label>
                <input id="password" name="password" type="password" value="" required
                    class="grow m-1 p-1 text-black">
            </div>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="flex items-center mt-2 mb-2">
                <label for="password_check" class="w-[128px]">Password (repeat)</label>
                <input id="password_check" name="password_check" type="password" value="" required
                    class="grow m-1 p-1 text-black">
            </div>
            <?php $__errorArgs = ['password_check'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <hr class="mt-4 pt-2">
            <small class="opacity-70 text-[12px]">Password must contain at least one capital letter, one digit and must be at least 8 letters long.</small>
            <hr class="mt-4 pt-2">
            <button type="submit"
                class="block m-auto mt-4 py-2 px-4 border-2 text-white border-[#0c1435] bg-gray-900 hover:bg-gray-800 hover:border-gray-800">Submit</button>
        </form>
        <div class="flex flex-col items-center px-8">
            <p>Already have an account? <a href="<?php echo e(url('/login')); ?>"
                    class="text-gray-900 font-bold hover:underline">click here to login!</a></p>
            <a class="my-8 px-4 w-[200px] text-center rounded-md text-gray-900 hover:underline"
                href="<?php echo e(url('/')); ?>">Back to
                Homepage</a>
        </div>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal71c6471fa76ce19017edc287b6f4508c)): ?>
<?php $component = $__componentOriginal71c6471fa76ce19017edc287b6f4508c; ?>
<?php unset($__componentOriginal71c6471fa76ce19017edc287b6f4508c); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\www\voll03\sp\resources\views/users/register.blade.php ENDPATH**/ ?>