<body>
    <h1>Registration Form</h1>
    <form class='form' method='POST' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
        <div class = 'errors'>
            <?php foreach($errors as $error): ?>
                <a><?php echo $error; ?></a><br>
            <?php endforeach; ?>
        </div>
        <div class = 'successfull'>
            <?php foreach($successes as $success): ?>
                <a><?php echo $success; ?></a><br>
            <?php endforeach; ?>
        </div>

        <div class='input'>
            <label>Name*</label> 
            <br><input type='text' name='name' placeholder="Example: John Johnson" 
            value = <?php echo isset($name) ? $_POST['name'] : ''?>>
        </div>
        <div class='input'>
            <label>Gender*</label>
            <br><select class="form-control" name="gender">
                <option value="N" <?php echo isset($gender) && $gender === 'N' ? ' selected' : '' ?>>Neutral</option>
                <option value="F" <?php echo isset($gender) && $gender === 'F' ? ' selected' : '' ?>>Female</option>
                <option value="M" <?php echo isset($gender) && $gender === 'M' ? ' selected' : '' ?>>Male</option>
            </select>
        </div>
        <div class='input'>
            <label>E-mail*</label>
            <br><input type = 'text' name='email' placeholder="Example: J.Johnson@gmail.com" 
            value = <?php echo isset($email) ? $_POST['email'] : ''?>>
        </div>
        <div class='input'>
            <label>Phone Number*</label>
            <br><input type = 'text' name='phone' placeholder="Example: J.Johnson@gmail.com"
            value = <?php echo isset($phone) ? $_POST['phone'] : ''?>>
        </div>
        <div class='input'>
            <label>Avatar</label>
            <br><input type = 'text' name='avatar' placeholder="Example: https://esotemp.vse.cz/~nguv03/cv03/img/homer.jpg"
            value = <?php echo isset($avatar) ? $_POST['avatar'] : ''?>>
        </div>
        <?php if (isset($_POST['avatar'])): ?>
            <div class = 'photo'>
                <img src = '<?php echo $_POST['avatar']; ?>'>
            </div>
        <?php endif; ?>
        <div class='input'>
            <label>Package Name</label>
            <br><input type = 'text' name='packageName' placeholder="Example: Best Package"
            value = <?php echo isset($packageName) ? $_POST['packageName'] : ''?>>
        </div>
        <div class='input'>
            <label>Card Amount In Package</label>
            <br><input type = 'text' name='cardAmount' placeholder="Example: 52"
            value = <?php echo isset($cardAmount) ? $_POST['cardAmount'] : ''?>>
        </div>
        <div class = 'submit-button'>
            <input type = 'submit' placeholder = 'Submit'>
        </div>
    </form>
</body>

</html>