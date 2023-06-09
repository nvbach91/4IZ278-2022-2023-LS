<form method="POST" action="add-device.php">
    <div>
        <label>serial</label>
        <input name="serial" type="text" value="<?php echo $serial?>">
       <!-- <?php  if(!empty($_POST)) echo isset($usernameError)?$usernameError:"ok"?>-->
    </div>
    <div>
        <label >model</label>
        <input name="model" type="text" value="<?php echo $model?>">
        <?php  if(!empty($_POST)) echo  isset($emailError)?$emailError:"ok"?>
    </div>
    <div>
        <label >key</label>
        <input name="key" type="text">
    </div>
    <button>submit</button>
</form>