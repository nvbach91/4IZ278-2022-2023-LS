<?php

$timezones = [
    "Europe/Prague" => "G:i:s j. n. Y",
    "Europe/London" => "G:i:s j F Y",
    "America/New_York" => "G:i:s n/j/y",
    "Asia/Tokyo" => "G:i:s Y年m月d日",
    "Australia/Sydney" => "G:i:s F j, Y",
];

$prague = new DateTime("now", new DateTimeZone("Europe/Prague"));

?>
<main class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <h2 class="mb-4">World Clock</h2>
            <table class="table">
                <tr>
                    <th>City</th>
                    <th>Time</th>
                    <th>Difference</th>
                </tr>
                <?php foreach ($timezones as $timezone => $format):
                    $dateTime = new DateTime("now", new DateTimeZone($timezone));
                    $offset = $prague->getOffset() - $dateTime->getOffset();
                    ?>
                    <tr>
                        <td><?php echo $timezone; ?></td>
                        <td><?php echo $dateTime->format($format); ?></td>
                        <td><?php echo $offset / 3600; ?> hours</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</main>
<?php
require('./footer.php');
?>