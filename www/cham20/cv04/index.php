<?php

// asociativní pole --- poznamky z hodiny
/*$person = [
    'name' => 'Kuba Kubikula',
    'age' => 56
];*/

?>
<?php include './header.php'?>
    <style>
        img {
            width: 200px;
            float: right;
            margin-right: 50px;
        }
        .form-group{
            margin-bottom: 20px;
        }
        form{
            margin-left: 50px;
            margin-right: 50px;
        }
        h1{
            text-align: center;
        }
    </style>
    <h1>Registration</h1>
    <!--<h2><?php //echo $person['name']; 
            ?></h2>    poznamky  z  hodiny-->
    <?php include './registration-form.php' ?>
<?php include './footer.php'?>