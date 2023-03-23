<?php $pageTitle = "Registered users"; ?>

<?php include '../php/utils.php'; ?>

<?php include '../php/header.php' ?>

<?php $users = fetchUsers(); ?>

<body>
    <div class="flex flex-col items-center content-center h-screen box-border font-serif py-20 px20 space-y-6">
        <h1 class=" text-5xl font-bold">Registered users:</h1>
        <p>email;name;password</p><br>
        <div class="flex flex-row  justify-between mt-2 mb-2 p-2 ">
            
            <?php foreach ($users as $user) :  ?>
                    <?php echo $user; ?><br>
            <?php endforeach; ?>
        </div>    
    </div>
</body>

<?php include '../php/footer.php' ?>