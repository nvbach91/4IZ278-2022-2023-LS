<?php
  $logo = "logo.jpeg";
  $avatar = "avatar.png";

  $name = "Aatami";
  $surname = "Mercia";
  $fullName = "$name $surname";

  $birthdate = "20-11-1274";
  $today = date("Y-m-d");
  $age = date_diff(date_create($birthdate), date_create($today));
  $age = $age -> format('%y');

  $position = "SEO";
  $firm = "Illuminati org.";
  $occupation = "$position at $firm";

  $street = "Morintou Passage";
  $house = "856";
  $house2 = "1";
  $adress = "$street $house/$house2";

  $city = "Kinderboia";
  $phone = "+32 009 304 239";
  $email = "aatami-mercia@illuminati.org";
  $web = "illuminati.org";

  $job = false;
  if ($job==true) {
    $status = "Available";
  } else {
    $status = "Not available";
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Business Card</title>
    <link rel="stylesheet" href="card.css">
  </head>
  <body>
    <div class="card-front">
        <div class="logo" style="background-image: url(./img/<?php echo $logo; ?>)"></div>
        <div class="company"><?php echo $firm; ?></div>    
      </div>

    <div class="card-back">
        <div class="avatar" style="background-image: url(./img/<?php echo $avatar; ?>)"></div>

        <div class="details">
          <div class="name"><?php echo $fullName; ?></div>
          <div class="occupation"><?php echo $occupation; ?></div>

          <div class="card-info">
            <div class="info">
              <span class="value"><?php echo $city; ?></span>
              <span class="label">City</span>
            </div>
            <div class="info">
              <span class="value"><?php echo $adress;?></span>
              <span class="label">Adress</span>
            </div> 
          </div>
          
          <div class="card-info">
            <div class="info">
                <span class="value"><?php echo $age; ?></span>
                <span class="label">Age</span>
            </div>
            <div class="info">
              <span class="value"><?php echo $status; ?></span>
              <span class="label">Contract work</span>
            </div>
          </div>

          <div class="contacts">
            <div class="info">
              <span class="value"><?php echo $phone; ?></span>
              <span class="label">Phone number</span>
            </div>
            <div class="info">
              <span class="value"><?php echo $email; ?></span>
              <span class="label">E-mail adress</span>
            </div>
            <div class="info">
              <span class="value"><?php echo $web; ?></span>
              <span class="label">Web site</span>
            </div>
          </div>
      </div>
    </div>
  </body>
  </html>