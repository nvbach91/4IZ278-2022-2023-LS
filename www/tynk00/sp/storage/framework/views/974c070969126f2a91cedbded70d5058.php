

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header"><?php echo e($project->name); ?></div>

                    <div class="card-body">
                        <p><?php echo e($project->description); ?></p>

                        <h5><?php echo e(__('Úkoly')); ?></h5>
                        <?php if($project->tasks->count() > 0): ?>
                            <ul>
                                <?php $__currentLoopData = $project->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($task->description); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <p><?php echo e(__('Žádné úkoly nenalezeny.')); ?></p>
                        <?php endif; ?>

                        <div class="mt-3">
                            <a href="<?php echo e(route('projects.edit', $project->id)); ?>" class="btn btn-primary"><?php echo e(__('Edit')); ?></a>

                            <form action="<?php echo e(route('projects.destroy', $project->id)); ?>" method="POST" style="display: inline-block;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger"><?php echo e(__('Delete')); ?></button>
                            </form>

                            <a href="<?php echo e(route('projects')); ?>" class="btn btn-secondary"><?php echo e(__('Back to Projects')); ?></a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shiro\Documents\GitHub\TaskShin\resources\views/projects/show.blade.php ENDPATH**/ ?>