

<?php $__env->startSection('content'); ?>
    <!-- Task List Heading -->
    <div class="row">
        <div class="col-md-6">
            <h1>Seznam úkolů</h1>
        </div>
        <div class="col-md-6">
            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#addTaskModal">Přidat úkol</a>
        </div>
    </div>

    <!-- Task List -->
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Název</th>
                <th>Popis</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($task->name); ?></td>
                    <td><?php echo e($task->description); ?></td>
                    <td>
                        <a href="<?php echo e(route('tasks.show', $task->id)); ?>" class="btn btn-sm btn-primary">Zobrazit</a>
                        <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="btn btn-sm btn-secondary">Upravit</a>
                        <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">Odstranit</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addTaskModalLabel">Přidat nový úkol</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo e(route('tasks.store')); ?>" method="POST">
						<?php echo csrf_field(); ?>
						<div class="form-group">
							<label for="name">Název</label>
							<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="form-group">
							<label for="description">Popis</label>
							<textarea class="form-control" id="description" name="description" rows="3" required></textarea>
						</div>
                        <input type="hidden" id="user_id" name="user_id" value="<?php echo e(Auth::id()); ?>">
						<button type="submit" class="btn btn-primary">Uložit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\shiro\Documents\GitHub\TaskShin\resources\views/tasks.blade.php ENDPATH**/ ?>