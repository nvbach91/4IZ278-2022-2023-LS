
<?php $__env->startSection('content'); ?>
<h1 class="register-form-Heading">
    Login
</h1>
<form id="login-form" method="POST">
    <?php echo csrf_field(); ?>
    <?php if(empty($_POST)): ?>
    <input id='login-emailInput' class="register-formfield" type="email" placeholder="Email" name="email">
    <?php else: ?>
    <input id='login-emailInput' class="register-formfield" type="email" placeholder="Email" name="email" value="<?php echo e($_POST['email']); ?>">
    <?php endif; ?>
   <input id='login-passwordInput' class="register-formfield" type="password" placeholder="Password" name="password">
   <?php if(isset($Error)): ?>
   <input id="login-error" hidden name="errors" value="<?php echo e($Error); ?>">
   <?php endif; ?>
   <button class="register-formbutton" type="submit">Login</button>
</form>

<div class="login-formredirect">
    <label>Login with Google instead</label>
    <div id="buttonDiv"></div> 
</div>

<script src="https://accounts.google.com/gsi/client" async defer></script>
<script src="<?php echo e(asset('js/login.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/login.blade.php ENDPATH**/ ?>