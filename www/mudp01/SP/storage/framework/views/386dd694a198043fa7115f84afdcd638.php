
<?php $__env->startSection('content'); ?>
<?php if(isset($message)): ?>
<div id="message" class="message">
    <label><?php echo e($message); ?></label>      
</div> 
<?php endif; ?>
<h1 class="admin-heading">Admin panel </h1>
<h2 class="admin-item-heading">Items</h2>
<div class="admin-items">
<div>
    <h2>Add item</h2>
    <form class="adminForm" method="POST">
       <?php echo csrf_field(); ?>
       <input hidden name="addItem" value="true">
       <label>Name:</label>
       <input name="name" placeholder="name">
       <label>Description:</label>
       <input name="description" placeholder="description">
       <label>Image URL:</label>
       <input name="imgUrl" placeholder="image url">
       <label>Image Alt:</label>
       <input name="imgAlt" placeholder="image alt">
       <label>Price:</label>
       <input name="price" placeholder="price">
       <label>Stock:</label>
       <input name="quantity" placeholder="stock">
       <label>Category:</label>
       <input name="category" placeholder="category">
       <button type="submit">Add item</button>
    </form>
</div>
    <?php if(isset($removeItem)): ?>
    <div>
        <h2>Delete item</h2>
    <form class="adminForm-delete" method="POST">
        <?php echo csrf_field(); ?>
        <input hidden name="removeItemConfirm" value="true">
        <div>
        <label>Id:</label>
        <input readonly name="id" value="<?php echo e($removeItem[0]->id); ?>">
        </div>
        <p>Name: <?php echo e($removeItem[0]->name); ?></p>
        <p>Description: <?php echo e($removeItem[0]->description); ?></p>
        <p>Image URL: <?php echo e($removeItem[0]->img_URL); ?></p>
        <p>Image Alt: <?php echo e($removeItem[0]->img_alt); ?></p>
        <p>Price: <?php echo e($removeItem[0]->price); ?></p>
        <p>Quantity: <?php echo e($removeItem[0]->quantity); ?></p>
        <p>Category: <?php echo e($removeItem[0]->category); ?></p>
        <div class="adminForm-buttons">
        <button type="submit">Pemanently delete item</button>
        <a href=".">Cancel deleting</a>
        </div>
    </form>
    </div>
    <?php else: ?>
    <div>
        <h2>Delete item</h2>
    <form class="adminForm" method="POST">
        <?php echo csrf_field(); ?>
        <input hidden name="removeItem" value="true">
        <input name="item" placeholder="Item name or ID">
        <select name="option">
            <option value="name">name</option>
            <option value="id">ID</option>
        </select>
        <button type="submit">Remove item</button>
    </form>
    </div>
    <?php endif; ?>

    <?php if(isset($editItem)): ?>
    <div>
        <h2>Edit item</h2>
        <form class="adminForm" method="POST">
            <?php echo csrf_field(); ?>
            <input hidden name="editedItem" value="true">
            <label>Id:</label>
            <input readonly name="id" value="<?php echo e($editItem[0]->id); ?>">
            <label>Name:</label>
            <input name="name" placeholder="name" value="<?php echo e($editItem[0]->name); ?>">
            <label>Description:</label>
            <input name="description" placeholder="description" value="<?php echo e($editItem[0]->description); ?>">
            <label>Image URL:</label>
            <input name="imgUrl" placeholder="image url" value="<?php echo e($editItem[0]->img_URL); ?>">
            <label>Image Alt:</label>
            <input name="imgAlt" placeholder="image alt" value="<?php echo e($editItem[0]->img_alt); ?>">
            <label>Price:</label>
            <input  name="price" placeholder="price" value="<?php echo e($editItem[0]->price); ?>">
            <label>Quantity:</label>
            <input name="quantity" placeholder="quantity" value="<?php echo e($editItem[0]->quantity); ?>">
            <label>Category:</label>
            <input name="category" placeholder="category" value="<?php echo e($editItem[0]->category); ?>">
            <div class="adminForm-buttons-edit">
            <button class="admiForm-cancelEdit" type="submit">Edit item</button>
            <a class="admiForm-cancelEdit" href=".">Cancel editing</a>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div>
        <h2>Edit item</h2>
    <form class="adminForm" method="POST">
        <?php echo csrf_field(); ?>
        <input hidden name="editItem" value="true">
        <input name="item" placeholder="Item name or ID">
        <select name="option">
            <option value="name">name</option>
            <option value="id">ID</option>
        </select>
        <button type="submit">Edit item</button>
    </form> 
    </div>
    <?php endif; ?>
</div>
<h2 class="admin-item-heading">Orders</h2>
<div class="admin-orders">
<?php if(isset($orders)): ?>
    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <form class="adminForm" method="POST">
                <?php echo csrf_field(); ?>
                <input hidden name="orderPaid" value="true">
                <label>Id: </label>
                <input readonly name="id" value="<?php echo e($order->id); ?>">
                <p>Created: <?php echo e($order->created); ?></p>
                <p class="admin-orders-state">State: <?php echo e($order->state); ?></p>
                <p>Customer: <?php echo e($order->email); ?> (ID: <?php echo e($order->customer); ?>)</p>
                <button type="submit">Order paid</button>
            </form>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
   <p>No orders found.</p>
<?php endif; ?>
</div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\dev\4iz278\SP\eGarden\resources\views/adminPanel.blade.php ENDPATH**/ ?>