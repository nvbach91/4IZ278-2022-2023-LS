<?php include('head.php'); ?>
<?php
$name = isset($_GET['name'])?$_GET['name']:'';
?>
<div>
    <h1>Welcome <?php echo $name;?></h1>
</div>
