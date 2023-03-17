<?php

$title = "OOP Techniques";
require('./src/header.php');

$techniques = [
    'oopdatabase'
];
?>
<body>
    <h1> OOP Techniques </h1>
    <?php 
        for($i = 0; $i < count($techniques); $i++) {
            $technique = $techniques[$i];
            require('./src/techniqueDiv.php');
        }
    ?>
</body>