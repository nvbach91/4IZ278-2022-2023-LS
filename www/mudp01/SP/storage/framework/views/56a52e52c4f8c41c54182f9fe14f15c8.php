
<?php $__env->startSection('content'); ?>
    <h1 class="register-form-Heading">
        Register
    </h1>
    <form method="POST">
         <?php echo csrf_field(); ?>
         <?php if(empty($_POST)): ?>
         <input id='register-firstNameInput' class="register-formfield" type="text" placeholder="First Name" name="firstName">
         <input id='register-lastNameInput' class="register-formfield" type="text" placeholder="Last Name" name="lastName">
         <input id='register-emailInput' class="register-formfield" type="email" placeholder="Email" name="email">
         <?php else: ?>
         <input id='register-firstNameInput' class="register-formfield" type="text" placeholder="First Name" name="firstName" value="<?php echo e($_POST['firstName']); ?>">
         <input id='register-lastNameInput' class="register-formfield" type="text" placeholder="Last Name" name="lastName" value="<?php echo e($_POST['lastName']); ?>">
         <input id='register-emailInput' class="register-formfield" type="email" placeholder="Email" name="email" value="<?php echo e($_POST['email']); ?>">
         <?php endif; ?>
        <input id='register-passwordInput1' class="register-formfield" type="password" placeholder="Password" name="password1">
        <input id='register-passwordInput2' class="register-formfield" type="password" placeholder="Repeat Password" name="password2">
        <?php if(isset($Error)): ?>
        <input id="register-error" hidden name="errors" value="<?php echo e($Error); ?>">
        <?php endif; ?>
        <button class="register-formbutton" type="submit">Register</button>
    </form>
    <a class="register-formredirect" href="/login/">Login instead</a>
    <script src="<?php echo e(asset('js/register.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/register.blade.php ENDPATH**/ ?>