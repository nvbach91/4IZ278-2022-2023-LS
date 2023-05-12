<?php
if (!isset($_SESSION)) {
    session_start();
}; 
require ('index.php');
require ('header.php');
?>
<body>
    <div class="">
        <a href="?category_id=2">babyleaf</a></h2>
        <a href="?category_id=1">microgreens</a>
    </div>

<div class="containerOurProducts">
    <?php 
require ('productBox.php');
?>
</div>
<div class = "pagesOurProducts">
<?php include ('pagination.php')?>
</div>
</body>
