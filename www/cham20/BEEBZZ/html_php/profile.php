<?php
require './UsersDatabase.php';
// TITLE HANDLING ------
ob_start();
include("header.php");
$buffer = ob_get_contents();
ob_end_clean();

$buffer = str_replace("%TITLE%", "YOUR PROFILE BEEBZZ", $buffer);
echo $buffer;

if (!isset($_COOKIE['email'])) {
    header("Location: login.php");
} else {
    $userdatabase = new UsersDatabase();
    $users = $userdatabase->getUSer($_COOKIE['email']);
    foreach ($users as $user) {
        $adress_id = $user['adress_id'];
    }
    $adressdatabase = new AdressesDatabase();
    $adresses = $adressdatabase->fetchById($adress_id);
}
?>
<main>
    <div class="container profile-container">
        <div class="row">
            <div class="col-md-8 profile-info">
                <?php foreach ($users as $user) : ?>
                    <div>
                        <h2 class="profile-info-text"><?php echo $user['first_name'] ?> <?php echo $user['second_name'] ?></h2>
                    </div>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">Email: </span><?php echo $user['email'] ?></h4>
                    </div>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">Phone: </span><?php echo $user['phone'] ?></h4>
                    </div>
                <?php endforeach; ?>
                <?php foreach ($adresses as $adress) : ?>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">Country: </span><?php echo $adress['country'] ?></h4>
                    </div>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">City: </span><?php echo $adress['city'] ?></h4>
                    </div>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">Street: </span><?php echo $adress['street_plus_number'] ?></h4>
                    </div>
                    <div>
                        <h4 class="profile-info-text"><span style="color: darkgrey;">Postal: </span><?php echo $adress['postal_code'] ?></h4>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="col-md-4 profile-buttons">
                <div class="profile-btn">
                    <a href="./info_change.php?first_name=<?php echo $user['first_name'] ?>&second_name=<?php echo $user['second_name'] ?>&phone=<?php echo $user['phone'] ?>&country=<?php echo $adress['country'] ?>&city=<?php echo $adress['city'] ?>&street=<?php echo $adress['street_plus_number'] ?>&postal=<?php echo $adress['postal_code'] ?>&email=<?php echo $user['email'] ?>"><button class="btn btn-secondary">CHANGE PERSONAL INFORMATIONS</button></a>
                </div>
                <div class="profile-btn">
                    <a href="./logout.php"><button class="btn btn-primary" id="logout">LOGOUT</button></a>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include './footer.php'; ?>