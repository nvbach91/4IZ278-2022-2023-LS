<?php

// asociativní pole --- poznamky z hodiny
/*$person = [
    'name' => 'Kuba Kubikula',
    'age' => 56
];*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
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
    <h1>Validace formulářů</h1>
    <!--<h2><?php //echo $person['name']; 
            ?></h2>    poznamky  z  hodiny-->
    <?php include './registration-form.php' ?>
    <img src="<?php echo $avatar ?>" alt="avatar">
</body>

</html>