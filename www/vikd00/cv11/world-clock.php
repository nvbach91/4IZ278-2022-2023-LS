<?php
session_start();
require_once 'auth.php';
requireLogin();

$timezones = [
    'Europe/Prague' => 'Prague',
    'America/New_York' => 'New York',
    'Asia/Tokyo' => 'Tokyo',
    'Australia/Sydney' => 'Sydney',
    'Europe/London' => 'London',
];

$datetimeFormat = 'Y-m-d H:i:s';
$pragueDateTime = new DateTime('now', new DateTimeZone('Europe/Prague'));

?>

<?php require __DIR__ . '/header.php'; ?>

<body class="container">
    <?php require __DIR__ . '/navbar.php'; ?>
    <h3 class="mb-4">World Clock</h3>
    <table class="table">
        <tr>
            <th>City</th>
            <th>Time</th>
            <th>Offset</th>
        </tr>
        <?php foreach ($timezones as $timezone => $city) : ?>
            <?php
            $dateTime = new DateTime('now', new DateTimeZone($timezone));
            $offset = $pragueDateTime->getOffset() - $dateTime->getOffset();
            $offsetString = sprintf('%+d hours', $offset / 3600);
            ?>
            <tr>
                <td><?php echo $city; ?></td>
                <td><?php echo $dateTime->format($datetimeFormat); ?></td>
                <td><?php echo $offsetString; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

<?php require __DIR__ . '/footer.php'; ?>
