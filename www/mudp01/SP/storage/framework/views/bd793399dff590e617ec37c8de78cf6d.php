<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eGarden</title>
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('img/favicon.ico')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/style.css')); ?>">
    <script
  src="https://code.jquery.com/jquery-3.7.0.slim.min.js"
  integrity="sha256-tG5mcZUtJsZvyKAxYLVXrmjKBVLd6VpVccqz/r4ypFE="
  crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav>
            <div class="header-home">
                <a href="/"><img src="<?php echo e(asset('img/homepage_logo.png')); ?>" alt="Logo redirecting to homepage"></a>
            </div>
            <div class="header-goods">
                <a href="/goods/">Browse goods</a>
            </div>
            <?php if(session()->exists('id')): ?>
            <div class="header-other">
                <a href="/cart/">Cart</a>
            </div>
            <div id="account" class="header-other">
                <a href=".">Account</a>
            </div>
            <?php else: ?>
            <div class="header-other">
                <a href="/register/">Register</a>
            </div>
            <div class="header-other">
                <a id="account" href="/login/">Login</a>
            </div>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    <?php if(session('role')=='customer'): ?>
    <script src="<?php echo e(asset('js/layout.js')); ?>"></script>
    <?php elseif(session('role')=='admin'): ?>
    <script src="<?php echo e(asset('js/layout-admin.js')); ?>"></script>
    <?php else: ?>
    <script src="<?php echo e(asset('js/layout-logged-out.js')); ?>"></script>
    <?php endif; ?>
</body>
</html><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/layout.blade.php ENDPATH**/ ?>