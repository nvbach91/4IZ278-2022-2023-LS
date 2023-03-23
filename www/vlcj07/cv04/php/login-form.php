<?php $pageTitle = "Login"; ?>

<?php include './header.php' ?>

<body>
    <?php include './login.php' ?>

    <div class="flex flex-col items-center content-center h-screen box-border font-serif py-20 px20 space-y-6">
        <h1 class=" text-5xl font-bold">Login</h1>
            <?php if (!empty($errors)):?>
                <div>
                    <?php foreach($errors as $error):?>
                        <p><?php echo $error?></p>
                    <?php endforeach?>
                </div>  
            <?php endif?>  
        <form class="flex flex-col border" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="flex flex-row  justify-between m-2 p-2 items-center">
                <label>E-mail</label>
                <input class="box-border border-2" name="email" type="email" value="<?php echo isset($email) ? $email : '';?>">
            </div>
            <div class="flex flex-row  justify-between m-2 p-2 items-center">
                <label>Password</label>
                <input class="box-border border-2" name="password" type="password" value="<?php echo isset($password) ?  $password : ''; ?>">
            </div>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Submit</button>
        </form>
    </div>
</body>

<?php include './footer.php' ?>