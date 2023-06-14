<?php if (!isset($_SESSION)) session_start(); ?>
<?php require_once './auth.php'; ?>
<?php if (requirePrivilege(1)) ?>
<?php require_once './AdDatabase.php'; ?>
<?php

if (!isset($_GET['listing_id'])) {
    header('Location: ./error.php');
    exit();
}

$listingId = $_GET['listing_id'];
$adDatabase = new AdDatabase();
$result = $adDatabase->deleteListing($listingId);

if ($_GET['back_to']) {
    header('Location: ./' . $_GET['back_to']);
} else if ($result) {
    header('Location: ./profile.php');
} else {
    var_dump($result);
}
exit();
