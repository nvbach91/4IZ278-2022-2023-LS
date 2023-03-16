<?php
var_dump($_POST);

?>

<form method = "POST" action = ".">
    <?php foreach($errors as $error):?>
        <p><?php echo $error?></p>
    <?php endforeach?>
<div>
        <label>Full Name</label>
        <input name = "Full Name" value = "<?php echo isset($fullName) ? $fullName : '';?>">
    </div>
    <div>
        <label> Email </label>
        <input name = "email" value = "<?php echo isset($email) ?
        $email: ''; ?>">
    <div>
        <label> Phone </label>
        <input name = "phone" value = "<?php echo isset($phone) ?
        $phone : ''; ?>">
    </div>
    <div>
        <label for="">Gender</label>
        <select name="gender" id=""></select>
        <option value="man"></option>
        <option value="female"></option>
        <option value="you"></option>
    </div>
    <button>Submit</button>
</form>