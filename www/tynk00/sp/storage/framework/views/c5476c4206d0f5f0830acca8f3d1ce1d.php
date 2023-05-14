

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row mb-3">
            <div class="col">
                <a href="<?php echo e(route('projects.create')); ?>" class="btn btn-primary">Přidat projekt</a>
            </div>
        </div>
        <div class="row">
            <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo e($project->name); ?></h5>
                            <p class="card-text"><?php echo e($project->description); ?></p>
                            <a href="<?php echo e(route('projects.show', $project->id)); ?>" class="btn btn-primary">Zobrazit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shiro\Documents\GitHub\TaskShin\resources\views/projects/index.blade.php ENDPATH**/ ?>