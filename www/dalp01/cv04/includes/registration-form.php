<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="mx-0">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" value="<?php echo $name ?>">
    </div>
    <div class="mx-0">
        <label class="form-label">Email address</label>
        <input name="email" class="form-control" value="<?php echo $email ?>">
    </div>
    <div class="mx-0">
        <label class="form-label">Password</label>
        <input name="password" class="form-control" value="<?php echo $password ?>">
    </div>
    <div class="mx-0">
        <label class="form-label">Check Password</label>
        <input name="cpassword" class="form-control" value="<?php echo $cpassword ?>">
    </div>
    <div class="mx-0">
        <label class="form-label">Gender</label>
        <select class="form-control" name="gender">
            <option value="F" <?php echo ( $gender == "F" )?"selected":"" ?>>Female</option>
            <option value="M" <?php echo ( $gender == "M" )?"selected":"" ?>>Male</option>
            <option value="O" <?php echo ( $gender == "O" )?"selected":"" ?>>Other</option>
            <option value="N" <?php echo ( $gender == "N" )?"selected":"" ?>>Choose</option>
        </select>
    </div>
    <div class="mx-0">
        <label class="form-label">Phone Number</label>
        <input name="phone" class="form-control" value="<?php echo $phone ?>">
    </div>
    <div class="mx-0">
        <label class="form-label">Avatar</label>
        <input name="avatar" class="form-control" value="<?php echo $avatar ?>">
        <?php if( !empty($avatar) ): ?>
            <div class="avatar" style="background-image: url(<?php echo $avatar?>)"></div>
        <?php endif; ?>
    </div>
    <label></label>
    <div class="d-grid gap-2">
        <input class="<?php echo empty($errors)?"btn btn-success":"btn btn-danger" ?>" type="submit" value=<?php echo empty($errors)?"Success!":"Submit" ?>>
    </div>
</form>