

<body>
    <form class = 'form' action = "submitted.php" method="post">
        <div class = 'main'>
            <p id = 'reg_menu'>Registration menu</p>
            <div class = 'field'>
                <p id = 'text'>Name and Surname*:</p>
                <input type='text' id = 'text' name = 'name' placeholder="Example: David Novak"" 
                    value = "<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                <?php if (in_array(0, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[0]; ?></p> </div>
                <?php endif; ?>
            </div>
            <div class = 'field'>
                <p id = 'text'>Sex*:</p>
                <div class = 'select'>
                    <select class="selection" name = 'sex'>
                        <option value="None" >-</option>
                        <option value="Male" <?php if (isset($_POST['sex']) && $sex === "Male") echo ' selected' ?>>Male</option>
                        <option value="Female" <?php if (isset($_POST['sex']) && $sex === "Female") echo ' selected' ?>>Female</option>
                    </select>
                </div>
                <?php if (in_array(1, $errors)): ?>
                <div class = 'error_sex'> <p><?php echo $messages[1]; ?></p> </div>
                <?php endif; ?>
            </div>
            <div class = 'field'>
                <p id = 'text'>Email*:</p>
                <input type = 'text' id = 'text' name = 'email' placeholder="Example: example@gmail.com"
                value = "<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                <?php if (in_array(2, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[2]; ?></p> </div>
                <?php endif; ?>
            </div>
            <div class = 'field'>
                <p id = 'text'>Phone*:</p>
                <input type = 'tel' id = 'text' name = 'phone' placeholder="Example: +420123456789"
                value = "<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>">
                <?php if (in_array(3, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[3]; ?></p> </div>
                <?php endif; ?>
            </div>
            <div class = 'field'>
                <p id = 'text'>Avatar:</p>
                <input type = 'text' id = 'text' name = 'url' placeholder="Example: https://esotemp.vse.cz/~baia04/cv03/img/homer.jpg"
                value = "<?php if (isset($_POST['url'])) echo $_POST['url']; ?>">
                <?php if (in_array(4, $errors)): ?>
                <div class = 'error'> <p><?php echo $messages[4]; ?></p> </div>
                <?php endif; ?>
            </div>

            <?php if (!count($errors) && isset($_POST['name'])): ?>
                <div class = 'success'"> <?php echo $messages[5]; ?> </div>
            <?php endif; ?>
            <div class = 'submition'>
                <input type = 'submit' value = "Submit"> 
            </div>
        </div>
    </form> 
</body>
</html>