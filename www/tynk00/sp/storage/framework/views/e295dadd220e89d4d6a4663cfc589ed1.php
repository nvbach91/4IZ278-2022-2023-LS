

<?php $__env->startSection('content'); ?>
	<div class="container">
		<h1>Upravit úkol</h1>
		<form action="<?php echo e(route('tasks.update', $task->id)); ?>" method="POST">
			<?php echo csrf_field(); ?>
			<?php echo method_field('PUT'); ?>
			<div class="form-group">
				<label for="name">Název</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo e($task->name); ?>" required>
			</div>
			<div class="form-group">
				<label for="description">Popis</label>
				<textarea class="form-control" id="description" name="description" rows="3" required><?php echo e($task->description); ?></textarea>
			</div>
			<input type="hidden" id="user_id" name="user_id" value="<?php echo e($task->user_id); ?>">
			<button type="submit" class="btn btn-primary">Uložit změny</button>
		</form>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shiro\Documents\GitHub\TaskShin\resources\views/tasks/edit.blade.php ENDPATH**/ ?>