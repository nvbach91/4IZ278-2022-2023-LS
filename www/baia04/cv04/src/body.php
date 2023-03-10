

<body>
    <form class = 'form' action = "<?php echo $page; ?>" method="post">
        <div class = 'main'>
            <p id = 'reg_menu'><?php echo $page === 'register.php' ? 'Registration' : 'Login' ?> menu</p>
            <?php if($page === 'register.php'): ?>
            <div class = 'field'>
                <p id = 'text'>Name and Surname*:</p>
                <input type='text' id = 'text' name = 'name' placeholder="Example: David Novak"" 
                    value = "<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                <?php if (in_array(0, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[0]; ?></p> </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
            <div class = 'field'>
                <p id = 'text'>Email*:</p>
                <input type = 'text' id = 'text' name = 'email' placeholder="Example: D.Novak@pixelwave.tech"
                value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <?php if (in_array(1, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[1]; ?></p> </div>
                <?php endif; ?>
            </div>
            <div class = 'field'>
                <p id = 'text'>Password*:</p>
                <input type = 'password' id = 'text' name = 'password' placeholder="Example: 123456"
                value = "<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
                <?php if (in_array(2, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[2]; ?></p> </div>
                <?php elseif (in_array(3, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[3]; ?></p> </div>   
                <?php endif; ?>
            </div>
            <?php if($page === 'register.php'): ?>
            <div class = 'field'>
                <p id = 'text'>Confirm password*:</p>
                <input type = 'password' id = 'text' name = 'passwordConfirmation' placeholder="Example: 123456"
                value = "<?php if (isset($_POST['passwordConfirmation'])) echo $_POST['passwordConfirmation']; ?>">
            </div>
            <?php endif; ?>

            <?php if ((!count($errors) && isset($_POST['name']) && $page === 'register.php')): ?>
                <div class = 'success'"> <a href = 'login.php'> <?php echo $messages[10]; ?> </a> </div>
            <?php endif; ?>
            <?php if ((!count($errors) && isset($_POST['email']) && $page === 'login.php')): ?>
                <div class = 'success'"> <?php echo $messages[11]; ?> </div>
            <?php endif; ?>
            <?php if (in_array(4, $errors)): ?>
                <div class = 'fault'"> <a href = 'login.php'> <?php echo $messages[4]; ?> </a> </div> 
            <?php elseif (in_array(5, $errors)): ?>
                <div class = 'fault'"> <a href = 'register.php'> <?php echo $messages[5]; ?> </a> </div> 
            <?php elseif (in_array(6, $errors)): ?>
                <div class = 'fault'"><?php echo $messages[6]; ?> </a> </div> 
            <?php endif; ?>
            <div class = 'submition'>
                <input type = 'submit' value = "Submit"> 
            </div>
        </div>
    </form> 
</body>
</html>