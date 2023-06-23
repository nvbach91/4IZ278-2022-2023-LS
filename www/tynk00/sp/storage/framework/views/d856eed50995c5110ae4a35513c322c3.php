

<?php $__env->startSection('content'); ?>
	<div class="container">
		<h1>Detaily úkolu</h1>
		<div class="card">
			<div class="card-body">
				<h5 class="card-title"><?php echo e($task->name); ?></h5>
				<p class="card-text"><?php echo e($task->description); ?></p>
				<a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="btn btn-primary">Upravit</a>
				<form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" style="display: inline-block;">
					<?php echo csrf_field(); ?>
					<?php echo method_field('DELETE'); ?>
					<button type="submit" class="btn btn-danger">Odstanit</button>
				</form>
                
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shiro\Documents\GitHub\TaskShin\resources\views/tasks/show.blade.php ENDPATH**/ ?>