<?php 
require './validation.php'
?>

<form class="form-signup" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
     
    <?php include './registration.php' ?>
    
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" value="<?php echo isset($name) ?  $name : ''; ?>">
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select class="form-control" name="gender">
            <option value="F"<?php echo (isset($gender) && $gender == 'F') ? 'selected' : ''; ?>>Female</option>
            <option value="M"<?php echo (isset($gender) && $gender == 'M') ? 'selected' : ''; ?>>Male</option>
            <option value="O"<?php echo (isset($gender) && $gender == 'O') ? 'selected' : ''; ?>>Other</option>
            <option value="I"<?php echo (isset($gender) && $gender == 'I') ? 'selected' : ''; ?>>I prefer not to say </option>
        </select>
    </div>
    <div class="form-group">
        <label>E-mail</label>
        <input class="form-control" name="email" type="email" value="<?php echo isset($email) ? $email : '';?>">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input class="form-control" name="phone" type="text" value="<?php echo isset($phone) ?  $phone : ''; ?>">
    </div>
    <div class="form-group">
        <label>Avatar URL</label>
        <input class="form-control" name="avatar" type="url" placeholder="https://esotemp.vse.cz/~vlcj07/cv01/Pizza-logo-transparent-PNG.png" value="<?php echo isset($avatar) ?  $avatar : ''; ?>">
    </div>
    <div class="form-group">
        <label>Card deck name</label>
        <input class="form-control" name="deck" value="<?php echo isset($deck) ?  $deck : ''; ?>">
    </div>
    <div class="form-group">
        <label>Number of cards in deck</label>
        <input class="form-control" name="count" value="<?php echo isset($count) ?  $count : ''; ?>">
    </div>
    <button class="btn" type="submit">Submit</button>
</form>