<?php

$timezones = [
    "Europe/Prague" => "G:i:s j. n. Y",
    "Europe/London" => "G:i:s j F Y",
    "America/New_York" => "G:i:s n/j/y",
    "Australia/Sydney" => "G:i:s F j, Y",
    "Asia/Tokyo" => "G:i:s Y年m月d日"
];

$prague = new DateTime("now", new DateTimeZone("Europe/Prague"));

include "components/header.php";
?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <h2 class="mb-4">World Clock</h2>
            <table class="table">
                <tr>
                    <th>Město</th>
                    <th>Čas</th>
                    <th>Rozdíl</th>
                </tr>
                <?php foreach ($timezones as $timezone => $format):
                    $dateTime = new DateTime("now", new DateTimeZone($timezone));
                    $offset = $prague->getOffset() - $dateTime->getOffset();
                    ?>
                    <tr>
                        <td><?php echo $timezone; ?></td>
                        <td><?php echo $dateTime->format($format); ?></td>
                        <td><?php echo $offset / 3600; ?> hodin</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</main>
<?php include "components/footer.php" ?>
