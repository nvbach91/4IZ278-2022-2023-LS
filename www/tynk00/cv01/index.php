<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<?php

$avatar = "https://preview.redd.it/y1iefuo4x1u71.png?width=640&crop=smart&auto=webp&s=030d66ba40d8d851566df053e47491e28cbdf1eb";
$logo = "./logo.png";
$surname = "Tynek";
$name = "Karel";
$position = "CEO";
$company = "Dummy Company";
$email = "tynk00@vse.cz";
$website = "Dummycompany.com";
$seekingjob = false;
$city = "Ústí nad Labem";
$telNumber = "123456789";
$birthDate = "11/12/2000";
$age = 0;
$birthDate = explode("/", $birthDate);
$age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
    ? ((date("Y") - $birthDate[2]) - 1)
    : (date("Y") - $birthDate[2]));

$houseNumber = "11";
$street = "Ulice"




?>

<body>
    <div class="bis-card" id="page-1" style="display: block">
        <div id="bis-card-content">

            <div class="row">
                <div class="col-3">
                    <img id="avatar" src="<?php echo $avatar ?>" alt="" srcset="">
                    
                </div>
                <div class="col-9" style="border-left: 5px #ffffff solid">
                    <h1><?php echo $name . " " . $surname ?></h1>
                    <h5><?php echo $position ?> společnosti Dummy Company</h5>
                    <ul>
                        <li>Věk: <?php echo $age ?></li>
                        <li>Email: <?php echo $email ?></li>
                        <li>Telefonní číslo: <?php echo $telNumber ?></li>
                        <li>Adresa: <?php echo $street . " " . $houseNumber . " " . $city ?></li>
                    </ul>
                </div>
                
                

            </div>
        </div>
    </div>
    <div class="bis-card" id="page-2" style="display: none">
        <div id="bis-card-content">
            <div class="row">
            <div class="col-12">
                <img id="logo" src="<?php echo $logo ?>" alt="aa" srcset="">
                    <h3 style="text-align: center"><?php echo $company ?></h3>
                    <h6 style="padding-top: 10px; text-align: center">
                        <?php echo $website ?>
                    </h6>
                    <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">
                        <img id="qr-code" src="https://i.pinimg.com/736x/60/c1/4a/60c14a43fb4745795b3b358868517e79.jpg" alt="aa" srcset="">
                    </a>
                    
                </div>
            </div>
            
        </div>
    </div>

    <button type="button" class="btn btn-light" style="margin: auto; display: block; margin-top: 50px" onclick="otoc()">Otočit</button>



</body>

<script>
    var page = 1;
    var page1 = document.getElementById("page-1");
    var page2 = document.getElementById("page-2");
    function otoc(){
        if(page == 1){
            page1.style.display = "none"; 
            page2.style.display = "block";
            page = 2;
            console.log(page);
        }
        else{
            page1.style.display = "block";
            page2.style.display = "none"; 
            page = 1;
        }
    }
</script>

</html>